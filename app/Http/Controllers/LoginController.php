<?php
    
    namespace App\Http\Controllers;
    
    use App\Http\Requests\LoginUserRequest;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    
    class LoginController extends Controller
    {
        /**
         * Handle the incoming request.
         */
        public function __invoke(Request $request)
        {
            //
        }
        
        public function store(LoginUserRequest $request)
        {
            // Get Validated data
            $credentials = [
              'email' => $request->email,
              'password' => $request->password,
            ];
            
            // Try to authenticate with given email and password
            if (Auth::attempt($credentials)) {
                // If that was successful, regenerate session
                $request->session()->regenerate();
                
                // and redirect user to home page. But if user is coming from another page to login page, redirect to that
                // intended page
                return redirect()->intended(route('home'))
                  ->with('success', 'Welcome Back');
            }
            
            // If attempt was not successful, redirect back into login form with error on email and with email input data
            return redirect()->back()->withErrors([
              'email' => 'The provided credentials do not match our records'
            ])->onlyInput('email');
        }
        
        public function create(Request $request)
        {
            return view('auth.login');
        }
        
        public function logout(Request $request)
        {
            // Logout user
            Auth::logout();
            // Regenerate session
            $request->session()->regenerate();
            // Regenerate CSRF Token
            $request->session()->regenerateToken();
            // Redirect to home page
            return redirect()->route('home');
        }
    }
