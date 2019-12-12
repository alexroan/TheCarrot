<?php

use App\Product;
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
        Product::create(['name' => 'Black','product_id' => '11','image' => '/popups/images/keyring-black.png','in_stock' => true]);
        Product::create(['name' => 'Blue','product_id' => '12','image' => '/popups/images/keyring-blue.png','in_stock' => true]);
        Product::create(['name' => 'Burgundy','product_id' => '13','image' => '/popups/images/keyring-burgundy.png','in_stock' => true]);
        Product::create(['name' => 'Green','product_id' => '14','image' => '/popups/images/keyring-green.png','in_stock' => true]);
        Product::create(['name' => 'Orange','product_id' => '15','image' => '/popups/images/keyring-orange.png','in_stock' => true]);
        Product::create(['name' => 'Pink','product_id' => '16','image' => '/popups/images/keyring-pink.png','in_stock' => true]);
        Product::create(['name' => 'Purple','product_id' => '17','image' => '/popups/images/keyring-purple.png','in_stock' => true]);
        Product::create(['name' => 'Red','product_id' => '18','image' => '/popups/images/keyring-red.png','in_stock' => true]);
    }
}
