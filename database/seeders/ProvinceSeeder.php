<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for provinces and cities
        $provincesData = [
            ['province_id' => 1, 'province' => 'Province A'],
            ['province_id' => 2, 'province' => 'Province B'],
            // ... more province data
        ];

        $citiesData = [
            ['province_id' => 1, 'city_name' => 'City X', 'type' => 'Type 1', 'postal_code' => '12345'],
            ['province_id' => 1, 'city_name' => 'City Y', 'type' => 'Type 2', 'postal_code' => '67890'],
            ['province_id' => 2, 'city_name' => 'City Z', 'type' => 'Type 1', 'postal_code' => '54321'],
            // ... more city data
        ];

        foreach ($provincesData as $province) {
            $provinceResult = Province::create(['name' => $province['province']]);

            $cities = array_filter($citiesData, function ($city) use ($province) {
                return $city['province_id'] === $province['province_id'];
            });

            foreach ($cities as $city) {
                City::create([
                    'province_id' => $provinceResult['id'],
                    'name' => $city['city_name'],
                    'type' => $city['type'],
                    'postal_code' => $city['postal_code'],
                ]);
            }
        }



    }
}
