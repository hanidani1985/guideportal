<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::where('email', 'admin@example.com')->first();
        
        if (!$user) {
            return;
        }

        // Sample locations in Sumba
        $locations = [
            [
                'name' => 'Weekuri Lake',
                'short_description' => 'A stunning natural lagoon with crystal-clear turquoise water, perfect for swimming and snorkeling.',
                'long_description' => 'Weekuri Lake is a natural saltwater lagoon surrounded by dramatic limestone cliffs. The water is incredibly clear and calm, making it ideal for swimming and snorkeling. The lake is connected to the ocean through underground channels, creating a unique brackish water ecosystem. Best visited during low tide when the water is clearest.',
                'latitude' => -9.5833,
                'longitude' => 119.3167,
                'entry_price' => 50000,
                'currency' => 'IDR',
                'best_time_year' => 'April to October',
                'best_hours' => '8AM - 4PM',
                'best_tide_level' => 'Low tide',
                'suitable_vehicles' => ['bike', 'car', 'motorcycle'],
                'is_approved' => true,
            ],
            [
                'name' => 'Wairinding Hill',
                'short_description' => 'Spectacular panoramic viewpoint offering sunrise views over rolling hills and traditional villages.',
                'long_description' => 'Wairinding Hill is famous for its breathtaking sunrise views. From the top, you can see the iconic savannah landscape of Sumba with its rolling hills and traditional thatched-roof villages. The best time to visit is early morning to catch the sunrise. Bring a camera to capture the stunning golden hour light.',
                'latitude' => -9.7167,
                'longitude' => 119.4333,
                'entry_price' => 25000,
                'currency' => 'IDR',
                'best_time_year' => 'May to September',
                'best_hours' => '5AM - 7AM',
                'best_tide_level' => null,
                'suitable_vehicles' => ['car', 'motorcycle', 'bike'],
                'is_approved' => true,
            ],
            [
                'name' => 'Mandorak Beach',
                'short_description' => 'Pristine white sand beach with unique rock formations and crystal-clear waters.',
                'long_description' => 'Mandorak Beach is a hidden gem featuring powdery white sand and dramatic rock formations rising from the turquoise water. The beach is relatively secluded, making it perfect for those seeking tranquility. The unique limestone formations create natural pools during low tide. Great for photography and peaceful relaxation.',
                'latitude' => -9.4500,
                'longitude' => 119.2833,
                'entry_price' => null,
                'currency' => 'IDR',
                'best_time_year' => 'All year',
                'best_hours' => '9AM - 5PM',
                'best_tide_level' => 'Low to mid tide',
                'suitable_vehicles' => ['car', 'offroader'],
                'is_approved' => true,
            ],
            [
                'name' => 'Traditional Village Ratenggaro',
                'short_description' => 'Ancient village with traditional peaked-roof houses and megalithic tombs on a coastal cliff.',
                'long_description' => 'Ratenggaro is one of Sumba\'s most iconic traditional villages, featuring the distinctive peaked-roof houses (uma) and ancient megalithic tombs. The village sits dramatically on a coastal cliff overlooking the Indian Ocean. Visitors can learn about Marapu culture, traditional weaving, and see the unique architecture. Please dress respectfully and consider making a donation to the village.',
                'latitude' => -9.6833,
                'longitude' => 119.2500,
                'entry_price' => 50000,
                'currency' => 'IDR',
                'best_time_year' => 'All year',
                'best_hours' => '8AM - 5PM',
                'best_tide_level' => null,
                'suitable_vehicles' => ['car', 'offroader', 'motorcycle'],
                'is_approved' => true,
            ],
            [
                'name' => 'Walakiri Beach',
                'short_description' => 'Iconic beach famous for its silhouetted mangrove trees during sunset.',
                'long_description' => 'Walakiri Beach is world-famous for its stunning sunset views with mangrove trees creating dramatic silhouettes. The trees seem to grow directly out of the shallow water, creating a surreal and photogenic landscape. This is one of the most photographed locations in Sumba. Arrive before sunset to find the best spot for photography.',
                'latitude' => -9.6000,
                'longitude' => 119.4000,
                'entry_price' => 10000,
                'currency' => 'IDR',
                'best_time_year' => 'April to October',
                'best_hours' => '5PM - 6:30PM',
                'best_tide_level' => 'Mid to low tide',
                'suitable_vehicles' => ['bike', 'car', 'motorcycle', 'offroader'],
                'is_approved' => true,
            ],
        ];

        foreach ($locations as $location) {
            $location['user_id'] = $user->id;
            \App\Models\Location::create($location);
        }
    }
}
