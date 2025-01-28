<?php
    
    namespace App\Http\Middleware;
    
    use Closure;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;
    
    class EnsureTodayIsWeekend
    {
        /**
         * Handle an incoming request.
         *
         * @param  Closure(Request): (Response)  $next
         */
        public function handle(Request $request, Closure $next): Response
        {
            // Get what week day it is today
            $dayOfWeek = now()->dayOfWeek;
            
            // Check if today is Saturday or Sunday we call $next()
            if ($dayOfWeek === 2) {
                return $next($request);
            }
            
            // Otherwise we restrict access
            abort(403, 'The website can only be accessed on weekends');
        }
    }
