<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Product::factory(20)->create();
        // Category::factory(6)->create();

        // User::factory()->create([
        //     'email' => 'islam@example.com',
        //     'password' => '1410',
        // ]);
        //link between category and product table
        // $categories = Category::all();
        // Product::all()->each(function($product) use ($categories){
        //    $product->categories()->attach(
        //     $categories->random(2)->pluck('id')->toArray()
        //    ); 
        // });
    }
}
