<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\Car;
    use Illuminate\Support\Facades\Auth;
    
    class WatchlistController extends Controller
    {
        public function index()
        {
            $cars = Auth::user()
              ->favouriteCars()
              ->with(['primaryImage', 'city', 'carType', 'fuelType', 'maker', 'modelo'])
              ->paginate(15);
            
            return view('watchlist.index', ['cars' => $cars]);
        }
        
        public function storeDestroy(Car $car)
        {
            $user = Auth::user();
            
            $carExists = $user->favouriteCars()->where('car_id', $car->id)->exists();
            
            if ($carExists) {
                $user->favouriteCars()->detach($car);
                
                return response()->json([
                  'added' => false,
                  'message' => 'Car was removed from watchlist'
                ]);
            }
            
            $user->favouriteCars()->attach($car);
            return response()->json([
              'added' => true,
              'message' => 'Car was added to watchlist'
            ]);
        }
    }