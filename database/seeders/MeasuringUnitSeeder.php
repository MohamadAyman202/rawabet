<?php

namespace Database\Seeders;

use App\Models\MeasuringUnit;
use Illuminate\Database\Seeder;

class MeasuringUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Please do not modify the name, please modify the value only | برجاء عدم تعديل علي الاسم يرجي العديل علي القيمه فقط
        MeasuringUnit::query()->create([
            'title' => ['en' => 'value1', 'ar' => 'قيمه1'],
            'slug' => 'value1',
            'admin_id' => 1
        ]);
    }
}
