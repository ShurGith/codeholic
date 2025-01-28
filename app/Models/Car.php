<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\Storage;
    
    class Car extends Model
    {
        use HasFactory, SoftDeletes;
        
        protected $fillable = [
          'maker_id',
          'modelo_id',
          'year',
          'price',
          'vin',
          'mileage',
          'car_type_id',
          'fuel_type_id',
          'user_id',
          'city_id',
          'address',
          'phone',
          'description',
          'published_at',
          'email_verified_at',
        ];
        
        protected $casts = [
          'id' => 'integer',
          'maker_id' => 'integer',
          'modelo_id' => 'integer',
          'year' => 'integer',
          'car_type_id' => 'integer',
          'fuel_type_id' => 'integer',
          'user_id' => 'integer',
          'city_id' => 'integer',
          'published_at' => 'timestamp',
        ];
        
        public static function getMinYear(): int
        {
            return date('Y') - 30;
        }
        
        public static function getCarFeatures(): array
        {
            $options = Schema::getColumnListing('car_features');
            $options = array_splice($options, 2, count($options));
            sort($options);
            return $options;
        }
        
        public static function getImgSrc($car): string
        {
            $pathF = $car->primaryImage->image_path ?? '';
            if (!str_starts_with($pathF, 'http') && $pathF !== '') {
                $pathF = Storage::url($pathF);
            }
            return $pathF !== '' ? $pathF : '/img/no_image.jpg';
        }
        
        public function maker(): BelongsTo
        {
            return $this->belongsTo(Maker::class);
        }
        
        public function modelo(): BelongsTo
        {
            return $this->belongsTo(Modelo::class);
        }
        
        public function carType(): BelongsTo
        {
            return $this->belongsTo(CarType::class);
        }
        
        public function fuelType(): BelongsTo
        {
            return $this->belongsTo(FuelType::class);
        }
        
        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
        
        public function city(): BelongsTo
        {
            return $this->belongsTo(City::class);
        }
        
        public function features(): HasOne
        {
            return $this->hasOne(CarFeature::class);
        }
        
        public function images(): HasMany
        {
            return $this->hasMany(CarImage::class)->orderBy('position');
        }
        
        public function favouredUsers(): BelongsToMany
        {
            return $this->belongsToMany(User::class, 'favourite_cars');
        }
        
        public function getCreateDate(): string
        {
            return (new Carbon($this->created_at))->format('d-m-Y');
        }
        
        public function getTitle(): string
        {
            return $this->year.' - '.$this->maker->name.' '.$this->modelo->name;
        }
        
        public function primaryImage(): HasOne
        {
            return $this->hasOne(CarImage::class)->orderBy('position')->limit(1);
        }
    }
