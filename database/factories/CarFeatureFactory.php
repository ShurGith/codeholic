<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Car;
use App\Models\CarFeature;

class CarFeatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CarFeature::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'car_id' => Car::factory(),
            'abs' => $this->faker->boolean(),
            'air_conditioning' => $this->faker->boolean(),
            'power_windows' => $this->faker->boolean(),
            'cruise_control' => $this->faker->boolean(),
            'bluetooth_connectivity' => $this->faker->boolean(),
            'remote_start' => $this->faker->boolean(),
            'gps_navigation' => $this->faker->boolean(),
            'heated_seats' => $this->faker->boolean(),
            'climate_control' => $this->faker->boolean(),
            'rear_parking_sensors' => $this->faker->boolean(),
            'leather_seats' => $this->faker->boolean(),
        ];
    }
}
