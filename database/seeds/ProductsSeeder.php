<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 0; $i < 10; $i++) {
            App\Product::create([
                'category_id' => 1,
                'name' => $faker->name,
                'price' => 1000.00,
                'quantityonhand' => $faker->randomDigit,
                'weight' => $faker->randomDigit,
                'image' => $faker->image('public/Product_images',640,480, null, false),
                'description' => $faker->text,
                'type' => 'New',
                'status' => 'Active'
            ]);
        }
    }
}
