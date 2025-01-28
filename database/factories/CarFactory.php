<?php
    
    namespace Database\Factories;
    
    use App\Models\Car;
    use App\Models\CarType;
    use App\Models\City;
    use App\Models\FuelType;
    use App\Models\Maker;
    use App\Models\Modelo;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Str;
    
    class CarFactory extends Factory
    {
        /**
         * The name of the factory's corresponding model.
         *
         * @var string
         */
        protected $model = Car::class;
        
        /**
         * Define the model's default state.
         */
        public function definition(): array
        {
            $makerId = rand(1, Maker::count() - 1);
            $maxModel = Modelo::where('maker_id', '=', $makerId)->count();
            $minId = Modelo::where('maker_id', '=', $makerId)->first()->id;
            $minYear = Car::getMinYear();
            //$yearNow = intval(date('Y'));
            //   dd($makerId, $maxModel, $minId, $minId + $maxModel);
            //dd($yearNow);
            return [
              'maker_id' => $makerId,
              'modelo_id' => rand($minId, $minId + $maxModel),
              'year' => rand($minYear, intval(date('Y'))),
              'price' => rand(7500, 127000),
              'vin' => strtoupper(Str::random(17)),
              'mileage' => ((int) $this->faker->randomFloat(2, 5, 500)) * 1000,
              'car_type_id' => rand(1, CarType::count()),
              'fuel_type_id' => rand(1, FuelType::count()),
              'user_id' => rand(1, User::count()),
              'city_id' => rand(1, City::count()),
              'address' => $this->faker->address(),
              'phone' => $this->faker->phoneNumber(),
              'description' => $this->faker->text(2000),//$this->faker->paragraphs(8, true),
              'published_at' => $this->faker->dateTimeBetween('-3 month', 'now'),
            
            ];
        }
    }
