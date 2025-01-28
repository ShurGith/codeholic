<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\StoreCarRequest;
    use App\Models\Car;
    use Carbon\Carbon;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;
    
    
    class CarController extends Controller
    {
        
        public function index(Request $request)
        {
            $user = Auth::user();
            $cars = Auth::user()
              ->cars()
              ->with(['maker', 'modelo', 'primaryImage'])
              ->orderBy('created_at', 'desc')
              ->paginate(15);
            return view('car.index', ['cars' => $cars, 'user' => $user]);
        }
        
        public function show(Request $request, Car $car)
        {
            if (!$car->published_at) {
                abort(404);
            }
            $fromDate = Carbon::parse($car->published_at);
            $difDays = floor($fromDate->diffInDays(now()));
            $totals = Car::where('user_id', '=', $car->user_id)->count();
            $options = Car::getCarFeatures();
            return view('car.show', [
              'car' => $car,
              'difDays' => $difDays,
              'options' => $options,
              'totals' => $totals,
            ]);
        }
        
        public function edit(Car $car)
        {
            if ($car->user->id !== Auth::id()) {
                abort(403);
            }
            $options = Car::getCarFeatures();
            $imagenes = $car->images()//CarImage::where('car_id', $car->id)
            ->orderBy('position')
              ->get();
            return view('car.edit',
              [
                'car' => $car,
                'options' => $options,
                'imagenes' => $imagenes
              ]);
        }
        
        public function destroy(Car $car)
        {
            $car->user->id !== Auth::id() ? abort(403) : '';
            $car->delete();
            return redirect()->route('car.index')
              ->with('success', 'This car was removed from system and Data Base');
        }
        
        public function search(Request $request)
        {
            $maker = $request->integer('maker_id');
            $model = $request->integer('model_id');
            $carType = $request->integer('car_type_id');
            $fuelType = $request->integer('fuel_type_id');
            $state = $request->integer('state_id');
            $city = $request->integer('city_id');
            $yearFrom = $request->integer('year_from');
            $yearTo = $request->integer('year_to');
            $priceFrom = $request->integer('price_from');
            $priceTo = $request->integer('price_to');
            $mileage = $request->integer('mileage');
            $sort = $request->input('sort', '-published_at');
            
            // Get the query builder instance with conditions
            $query = Car::with(['city', 'carType', 'fuelType', 'maker', 'modelo', 'primaryImage'])
              ->where('published_at', '<', now());
            /*$query = Car::where('published_at', '<', now())
              ->orderBy('published_at', 'desc');*/
            if (str_starts_with($sort, '-')) {
                $sortBy = substr($sort, 1);
                $query->orderBy($sortBy, 'desc');
            } else {
                $query->orderBy($sort);
            }
            if ($maker) {
                $query->where('maker_id', $maker);
            }
            if ($model) {
                $query->where('modelo_id', $model);
            }
            if ($state) {
                $query->join('cities', 'cities.id', '=', 'cars.city_id')
                  ->where('cities.state_id', $state);
            }
            if ($city) {
                $query->where('city_id', $city);
            }
            if ($carType) {
                $query->where('car_type_id', $carType);
            }
            if ($fuelType) {
                $query->where('fuel_type_id', $fuelType);
            }
            if ($yearFrom) {
                $query->where('year', '>=', $yearFrom);
            }
            if ($yearTo) {
                $query->where('year', '<=', $yearTo);
            }
            if ($priceFrom) {
                $query->where('price', '>=', $priceFrom);
            }
            if ($priceTo) {
                $query->where('price', '<=', $priceTo);
            }
            if ($mileage) {
                $query->where('mileage', '<=', $mileage);
            }
            
            $cars = $query->paginate(15);
            //   ->withQueryString();
            $carCount = $query->count();
            //  dd($query);
            return view('car.search',
              ['cars' => $cars, 'carCount' => $carCount]);
        }
        
        public function watchlist()
        {
            $cars = Auth::user()
              ->favouriteCars()->with([
                'city', 'carType', 'fuelType', 'maker', 'modelo', 'primaryImage'
              ])
              ->orderBy('created_at', 'desc')
              ->paginate(15);
            return view('car.watchlist', ['cars' => $cars]);
        }
        
        public function carImages(Car $car)
        {
            $car->user->id !== Auth::id() ? abort(403) : '';
            $images = $car->images()// DB::table('car_images')
            //  ->where('car_id', '=', $car->id)
            ->orderBy('position')
              ->get();
            
            return view('car.images', ['car' => $car, 'images' => $images]);
        }
        
        public function updateImages(Request $request, Car $car)
        {
            $car->user->id !== Auth::id() ? abort(403) : '';
            // Get Validated data of delete images and positions
            $data = $request->validate([
              'delete_images' => 'array',
              'delete_images.*' => 'integer',
              'positions' => 'array',
              'positions.*' => 'integer',
            ]);
            
            $deleteImages = $data['delete_images'] ?? [];
            $positions = $data['positions'] ?? [];
            
            // Select images to delete
            $imagesToDelete = $car->images()->whereIn('id', $deleteImages)->get();
            
            // Iterate over images to delete and delete them from file system
            foreach ($imagesToDelete as $image) {
                if (Storage::exists($image->image_path)) {
                    Storage::delete($image->image_path);
                }
            }
            
            // Delete images from the database
            $car->images()->whereIn('id', $deleteImages)->delete();
            
            // Iterate over positions and update position for each image, by its ID
            foreach ($positions as $id => $position) {
                $car->images()->where('id', $id)->update(['position' => $position]);
            }
            
            return redirect()->back()
              ->with('success', 'Car images were updated');
        }
        
        public function update(Request $request, Car $car)
        {
            $car->user->id !== Auth::id() ? abort(403) : '';
            $data = $request->all();
            $antesDatos = $data['features'];
            foreach (Car::getCarFeatures() as $option) {
                $data['features'][$option] = 0;
            }
            $features = [...$data['features'], ...$antesDatos];
            $car->update($data);
            $car->features()->update($features);
            return redirect()->route('car.index');
        }
        
        public function addImages(Request $request, Car $car)
        {
            $car->user->id !== Auth::id() ? abort(403) : '';
            // Get images from request
            $images = $request->file('images') ?? [];
            
            // Select max position of car images
            $position = $car->images()->max('position') ?? 0;
            foreach ($images as $image) {
                // Save it on the file system
                $path = $image->store('public/images');
                // Save it in the database
                $car->images()->create([
                  'image_path' => $path,
                  'position' => $position + 1
                ]);
                $position++;
            }
            
            return redirect()->back()
              ->with('success', 'New images were added');
        }
        
        public function store(StoreCarRequest $request): RedirectResponse
        {
            
            //  $request->user->id !== Auth::id() ? abort(403) : '';
            $data = $request->validated();
            $featuresData = $data['features'] ?? [];// Set user ID
            $data['user_id'] = Auth::id();
            //dd($data);
            $car = Car::create($data);
            // Create features
            $car->features()->create($featuresData);
            // Get images
            $images = $request->file('images') ?: [];
            // Iterate and create images
            foreach ($images as $i => $image) {
                // Save image on file system
                $path = $image->store('public/images');
                $car->images()->create(['image_path' => $path, 'position' => $i + 1]);
            }
            return redirect()
              ->action([CarController::class, 'show'], ['car' => $car])
              ->with('success', 'New Car created successfully.');
            
        }
        
        public function create(Request $request)
        {
            $options = Car::getCarFeatures();
            
            return view('car.create', compact('options'));
        }
        
        public function mus()
        {
            return "<div style='width:100%; align-content: center;justify-content: center; display: flex; height: 200px; background: #20c8c8; margin-top: 75px'>
                    <p style='display:flex; align-items:center;background:#252d6f; color:white; font-size: 34px; max-width: fit-content ; padding-block: 12px;padding-inline: 48px; border-radius: 12px;'>Pasamos la condición del Middleware.<br> 🚘 Día:
                    ".now()->dayOfWeek."</p>
                    </div>";
        }
        
    }
