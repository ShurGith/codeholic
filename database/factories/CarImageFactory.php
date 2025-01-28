<?php
    
    namespace Database\Factories;
    
    use App\Models\Car;
    use App\Models\CarImage;
    use Illuminate\Database\Eloquent\Factories\Factory;
    
    class CarImageFactory extends Factory
    {
        protected $model = CarImage::class;
        
        public function definition(): array
        {
            //    $id = rand(30, 99);
            //  $lrand = rand('A', 'F');
            //  $clave = Modelo::find(rand(1, 100))->name;
            
            return [
              'car_id' => 1, // We have to provide for which car we are creating an image during creation process
              'image_path' => 'https://ui-avatars.com/api/?size=512&background=random&name='.$this->iniciales(),
                /**/
                //'"https://picsum.photos/2600/1900?random=".rand(1, 130),
              'position' => function (array $attributes) {
                  return Car::find($attributes['car_id'])->images()->count() + 1;
              }
            ];
        }
        
        public function iniciales()
        {
            $letra = chr(rand(ord("A"), ord("Z")));
            return chr(rand(ord("A"), ord("Z"))).$letra;
        }
        
        /**
         * Define the model's default state.
         */
        public function randomHex()
        {
            $chars = 'ABCDEF0123456789';
            $color = '';
            for ($i = 0; $i < 6; $i++) {
                $color .= $chars[rand(0, strlen($chars) - 1)];
            }
            return $color;
        }
    }
