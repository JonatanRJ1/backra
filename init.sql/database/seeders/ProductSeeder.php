<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');

        foreach (range(1, 1000) as $index) {
            Product::create([
                'name' => $faker->word(2, true),
                'description' => $faker->paragraph(1),
                'price' => $faker->randomFloat(2, 1, 100),
                'stock' => $faker->numberBetween(0, 100),
                'sku' => strtoupper($faker->bothify('???-#####')),
                'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
