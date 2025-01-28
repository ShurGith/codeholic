<?php
    
    use App\Http\Controllers\CarController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\SocialiteController;
    use App\Http\Controllers\WatchlistController;
    use Illuminate\Support\Facades\Route;
    
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    Route::get('/car/search', [CarController::class, 'search'])->name('car.search');
    
    Route::middleware(['auth'])->group(callback: function () {
        Route::middleware(['verified'])->group(function () {
            Route::get('/watchlist', [WatchlistController::class, 'index'])
              ->name('watchlist.index');
            Route::post('/watchlist/{car}', [WatchlistController::class, 'storeDestroy'])
              ->name('watchlist.storeDestroy');
            
            Route::resource('car', CarController::class)->except(['show']);
            
            Route::get('/car/{car}/images', [CarController::class, 'carImages'])
              ->name('car.images');
            Route::put('/car/{car}/images', [CarController::class, 'updateImages'])
              ->name('car.updateImages');
            Route::post('/car/{car}/images', [CarController::class, 'addImages'])
              ->name('car.addImages');
        });
        
        Route::get('/login/oauth/{provider}', [SocialiteController::class, 'redirectToProvider'])
          ->name('login.oauth');
        Route::get('/callback/oauth/{provider}', [SocialiteController::class, 'handleCallback']);
        
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
          ->name('profile.updatePassword');
    });
    
    Route::get('/car/{car}', [CarController::class, 'show'])->name('car.show');
    
    /*
    Route::get('login-google', function () {
        return Socialite::driver('google')->redirect();
    });*/
    
    /*    Route::get('/google-calback', function () {
            $user = Socialite::driver('google')->user();
            dd($user);
        });
            */
    
    Route::get('/login/oauth/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('login.oauth');
    Route::get('/callback/oauth/{provider}', [SocialiteController::class, 'handleCallback']);
    
    
    require_once __DIR__.'/auth.php';