<?php
    
    namespace Database\Seeders;
    
    use App\Models\Car;
    use App\Models\CarImage;
    use App\Models\CarType;
    use App\Models\City;
    use App\Models\FuelType;
    use App\Models\Maker;
    use App\Models\Modelo;
    use App\Models\State;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Sequence;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    
    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            $state_cities = [
              'Alabama' => ['Mobile', 'Dothan', 'Gadsden', 'Madison', 'Leeds'],
              'California' => [
                'Los Angeles', 'San Francisco', 'San Diego', 'San Jose', 'Sacramento', 'Adelanto', 'Burbank',
                'Capitola', 'Carson', 'Saratoga'
              ],
              'Florida' => [
                'Miami', 'Tampa', 'Naples', 'Orlando', 'Pensacola', 'Daytona', 'Sarasota', 'Jacksonville',
                'St. Petersburg'
              ],
              'Georgia' => ['Atlanta', 'Augusta', 'Columbus', 'Savannah', 'Athens'],
              'Illinois' => ['Chicago', 'Aurora', 'Naperville', 'Joliet', 'Rockford'],
              'Iowa' => ['Adel', 'Baxter', 'Benton', 'Coin', 'Gibson', 'Primghar'],
              'Maryland' => ['Aberdeen', 'Barton', 'Baltimore', 'Catonsville', 'Mayo', 'Potomac', 'Riva', 'Riverside'],
              'Michigan' => ['Detroit', 'Grand Rapids', 'Warren', 'Sterling Heights', 'Ann Arbor'],
              'Nebraska' => ['Chadron', 'Chester', 'Hadar', 'Hampton', 'Merna', 'Monroe', 'Stanford', 'Stanton'],
              'New York' => ['Albany', 'Búfalo', 'Corning', 'Nueva York', 'Norwich', 'Yonkers'],
              'North Carolina' => ['Charlotte', 'Raleigh', 'Greensboro', 'Durham', 'Winston-Salem'],
              'Ohio' => ['Columbus', 'Cleveland', 'Cincinnati', 'Toledo', 'Akron'],
              'Oklahoma' => ['Buffalo', 'Byron', 'Calera', 'Dodge', 'Dover', 'Glenpool', 'MacAlester', 'Ravia'],
              'Pennsylvania' => ['Philadelphia', 'Pittsburgh', 'Allentown', 'Erie', 'Reading'],
              'Texas' => ['Houston', 'San Antonio', 'Dallas', 'Laredo', 'El Paso', 'Austin', 'Pasadena'],
              'Virginia' => ['Alexandria', 'Basye', 'Hollins', 'Leesburg', 'Norfolk', 'Vinton'],
              'Washington' => ['Aberdeen', 'Benton', 'Camas', 'Granger', 'Kamala', 'Lakewood', 'Vancouver'],
            ];
            $a = 0;
            foreach ($state_cities as $state => $cities) {
                State::factory()->create(['name' => $state]);
                $a++;
                for ($i = 0; $i < count($cities); $i++) {
                    City::factory()->create(['name' => $cities[$i], 'state_id' => $a,]);
                }
            }
            
            $fuels = ['Gas', 'Diesel', 'Electric', 'Hybrid', 'Plug-in Hybrid'];
            sort($fuels);
            
            foreach ($fuels as $f) {
                FuelType::factory()->create(['name' => $f,]);
            }
            $cartypes = [
              'Sedan', 'Hatchback', 'SUV', 'Crossover', 'Coupe',
              'Minivan', 'Pickup Truck', 'Sports Car', 'Truck',
              'Wagon', 'Convertible',
            ];
            sort($cartypes);
            foreach ($cartypes as $c) {
                CarType::factory()->create(['name' => $c,]);
            }
            
            $makers_modelos = [
              'Toyota' => [
                'Camry', '4Runner', 'Sienna', 'Yaris', 'Sequoia', 'RAV4', 'Highlander', 'Tacoma', 'Tundra', 'Prius',
                'Corolla'
              ],
              'Honda' => [
                'Accord', 'Civic', 'CR-V', 'Pilot', 'Odyssey', 'Ridgeline', 'HR-V', 'Fit', 'Insight', 'Passport'
              ],
              'Ford' => [
                'F-150', 'Fusion', 'Edge', 'Taurus', 'Flex', 'Mustang', 'Escape', 'Escort', 'Explorer', 'Expedition',
                'Ranger', 'Maverick'
              ],
              'Chevrolet' => [
                'Malibu', 'Impala', 'Cruze', 'Colorado', 'Corvette', 'Silverado', 'Tahoe', 'Suburban', 'Camaro',
                'Equinox', 'Traverse'
              ],
              'Volkswagen' => ['Golf', 'Jetta', 'Passat', 'Tiguan', 'Atlas'],
              'Nisan' => [
                'Altima', 'Sentra', 'Maxima', 'Rogue', 'Pathfinder', 'Murano', 'Armada', 'Frontier', 'Titan', 'Versa',
                '370Z'
              ],
              'Hyundai' => ['Sonata', 'Elantra', 'Tucson', 'Santa Fe', 'Palisade', 'Kona', 'Nexo'],
              'Kia' => ['Optima', 'Forte', 'K5', 'Sportage', 'Sorento', 'Telluride', 'Niro'],
              'Subaru' => ['Outback', 'Impreza', 'Legacy', 'Forester', 'Crosstrek', 'Ascent', 'BRZ'],
              'Mercedes-Benz' => ['S-Class', 'C-Class', 'E-Class', 'GLC', 'GLE', 'GLS', 'GLA', 'A-Class'],
              'BMW' => ['350', 'X3', 'X5', '525', '730', 'X7', 'iX'],
              'Audi' => ['A4', 'A3', 'A6', 'Q3', 'Q5', 'Q7', 'e-tron'],
              'Lexus' => [
                'RX400', 'RX450', 'RX350', 'ES350', 'LS500', 'IS300', 'GX460', 'GS350', 'NX300', 'LX570', 'UX200',
                'RC350'
              ],
              'Cadillac' => ['Escalade', 'XT4', 'XT5', 'XT6', 'CT4', 'CT5', 'Lyriq'],
              'Infinity' => ['Q50', 'QX50', 'QX55', 'QX60', 'QX80'],
              'Volvo' => ['XC90', 'XC40', 'XC60', 'S60', 'S90', 'V60', 'V90'],
              'Land Rover' => ['Range Rover', 'Range Rover Sport', 'Velar', 'Evoque', 'Defender'],
              'Ferrari' => ['488 GTB', 'F8 Tributo', '812 Superfast', 'Roma', ' SF90 Straale'],
              'Chrysler' => ['Pacifica', '300', 'Voyager'],
              'Mazda' => ['MX-5 Miata', 'Mazda3', 'Mazda6', 'CX-3', 'CX-5', 'CX-9'],
              'Tesla' => ['MOdel S', 'Model 3', 'Model X', 'Model Y', 'Cybertruck'],
              'Porche' => ['911', '718 Boxster', '718 Cayman', 'Panamera', 'Cayenne', 'Macan', 'Taycan'],
              'Maserati' => ['Ghibli', 'Quattroporte', 'Levante', 'MC20'],
              'Bentley' => ['Continental GT', 'Flying Spur', 'Bentayga']
            ];
            
            $a = 0;
            foreach ($makers_modelos as $maker => $models) {
                Maker::factory()->create(['name' => $maker]);
                $a++;
                for ($i = 0; $i < count($models); $i++) {
                    Modelo::factory()->create([
                      'name' => $models[$i],
                      'maker_id' => $a,
                    ]);
                }
            }
            
            User::factory()->create([
              'name' => 'JuanJota',
              'email' => 'esnola@gmail.com',
              'password' => Hash::make('PpopsswqLLord@1LL4'),
            ]);
            //  User::factory(10)->create();
            //Car::factory(20)->create();
            //CarFeature::factory(24)->create();
            
            // Create 3 users
            User::factory()
              ->count(3)
              ->create();

// Create 2 more users and 50 new cars, each added to their favouriteCars. Each Car will have 5 images
            User::factory()
              ->count(6)
              ->has(
                Car::factory()
                  ->count(50)
                  ->has(
                    CarImage::factory()
                      ->count(5)
                      ->sequence(fn(Sequence $sequence) => ['position' => ($sequence->index) % 5 + 1]),
                    'images'
                  )
                  ->hasFeatures(),
                'favouriteCars'
              )
              ->create();
        }
    }
