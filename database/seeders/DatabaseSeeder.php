<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1000)->create();
        $this->call(PermissionTableSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(MeasuringUnitSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(CountriesStatesCitiesTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
