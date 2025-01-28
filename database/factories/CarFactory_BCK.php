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
            $makerId = rand(1, Maker::count());
            return [
              'maker_id' => rand(1, Maker::count()),
              'modelo_id' => rand(1, Modelo::count()),
              'year' => $this->faker->dateTime(),
              'price' => rand(12500, 12700),
              'vin' => $this->faker->randomNumber(),
              'mileage' => rand(25000, 248000),
              'car_type_id' => rand(1, CarType::count()),
              'fuel_type_id' => rand(1, FuelType::count()),
              'user_id' => User::factory(),
              'city_id' => rand(1, City::count()),
              'address' => $this->faker->address(),
              'phone' => $this->faker->phoneNumber(),
              'description' => $this->faker->paragraphs(8, true),
              'published_at' => $this->faker->dateTimeBetween('-3 month', 'now'),
            ];
        }
    }
