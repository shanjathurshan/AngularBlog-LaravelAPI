<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('products')->insert([
            // 'name' => 'test',
            // 'slug' => 'test',
            // 'description' => 'test',
            // 'price' => '20'
        // ]);

        Product::factory()->count(2)->create([
            'name' => $this->faker->title(),
            'slug' => 'test',
            'description' => 'test',
            'price' => '20'
        ]);
        
    }
}
