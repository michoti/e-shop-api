<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\City;
use App\Models\Finance;
use App\Models\MerchantAccount;
use App\Models\Product;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProvinceSeeder::class);

        $province = Province::factory()->create();

        City::factory()
            ->for($province)
            ->create();

        foreach (['ADMIN', 'STAFF', 'MERCHANT'] as $role)
            $user[strtolower($role)] = User::factory()->create(['role' => $role]);
        
        $this->call([
            CategorySeeder::class,
            BankingSeeder::class,
        ]);   
        
        $merchantAccount = MerchantAccount::factory()
            ->for($user['merchant'])
            ->hasCoupons(2)
            ->create();

        Product::factory()
            ->count(5)
            ->for($merchantAccount)
            ->hasProductImages(1)
            ->create(); 
    }
}
