<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    
    class Maker extends Model
    {
        use HasFactory;
        
        /**
         * Indicates if the model should be timestamped.
         *
         * @var bool
         */
        public $timestamps = false;
        
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
          'name',
        ];
        
        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
          'id' => 'integer',
        ];
        
        public function cars(): HasMany
        {
            return $this->hasMany(Car::class);
        }
        
        public function models(): HasMany
        {
            return $this->hasMany(Modelo::class);
        }
    }
