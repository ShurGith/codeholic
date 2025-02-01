<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\Car;
    use Illuminate\Support\Facades\Auth;
    
    class HomeController extends Controller
    {
        public function index()
        {
            /*
            //Sin Eager Loading
            $cars = Car::where('published_at', '<', now())
              ->inRandomOrder()
              ->limit(30)
              ->paginate(20);
            */
            //  /***Con Eager Loading ***/
            $cars = Car::where('published_at', '<', now())
              ->with([
                'primaryImage', 'city', 'carType', 'fuelType',
                'maker', 'modelo', 'favouredUsers'
              ])
              ->orderBy('published_at', 'desc')
              ->limit(30)
              ->get();
            $sliderLink = Auth::user() ? 'car.create' : 'car.search';
            $sliderText = Auth::user() ? 'Add Your Car' : 'Find the Car
            ';
            return view('home.index', ['cars' => $cars, 'sliderLink' => $sliderLink, 'sliderText' => $sliderText]);
        }
    }
