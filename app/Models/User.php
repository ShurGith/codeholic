<?php
    
    namespace App\Models;
    
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    
    class User extends Authenticatable implements MustVerifyEmail
    {
        use HasFactory, Notifiable;
        
        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
          'name',
          'email',
          'password',
          'email_verified_at'
        ];
        
        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        protected $hidden = [
          'password',
          'remember_token',
        ];
        
        public function isOauthUser(): bool
        {
            return !$this->password;
        }
        
        public function favouriteCars(): BelongsToMany
        {
            return $this->belongsToMany(Car::class, 'favourite_cars');
        }
        
        public function cars(): HasMany
        {
            return $this->hasMany(Car::class);
        }
        
        /**
         * Get the attributes that should be cast.
         *º
         * @return array<string, string>
         */
        protected function casts(): array
        {
            return [
              'email_verified_at' => 'datetime',
              'password' => 'hashed',
            ];
        }
        
    }