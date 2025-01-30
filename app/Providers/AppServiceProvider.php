<?php
    
    namespace App\Providers;
    
    use Illuminate\Pagination\Paginator;
    use Illuminate\Support\ServiceProvider;
    
    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         */
        public function register(): void
        {
            //
        }
        
        /**
         * Bootstrap any application services.
         */
        public function boot(): void
        {
            Paginator::defaultView('pagination');
            
            /*            Gate::before(function (User $user, string $ability) {
                            //  return false;
                            if (!$user->isAdmin()) {
                                return true;
                            }
                            
                            if ($user->isGuest()) {
                                return false;
                            }
                        });
                        Gate::after(function (User $user, string $ability) {
                            // Decide to give permission or not
                        });
                        
                        Gate::define('update-car', function (User $user, Car $car) {
                            return $user->id === $car->user_id;
                        });*/
        }
        
    }
