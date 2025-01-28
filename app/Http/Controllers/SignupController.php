<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\SignupUserRequest;
    use App\Models\User;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    
    class SignupController extends Controller
    {
        /**
         * Handle the incoming request.
         */
        public function __invoke(Request $request)
        {
            //
        }
        
        public function store(SignupUserRequest $request)
        {
            // Create user out of validated request data. Hash password
            $user = User::create([
              'name' => $request->name,
              'email' => $request->email,
              'phone' => $request->phone,
              'password' => Hash::make($request->password)
            ]);
            event(new Registered($user));
            Auth::login($user);
            // Redirect to home page with flash message
            return redirect()->route('home')
              ->with('success', 'Account created Successfully. Please check your email
        to verify your account');
        }
        
        public function create()
        {
            return view('auth.signup');
        }
    }