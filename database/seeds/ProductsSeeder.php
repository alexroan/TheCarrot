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
        Product::create(['name' => 'Black','product_id' => '31161632620646','image' => getenv('BASE_URL').'/popups/images/keyring-black.png','in_stock' => true, 'colour_code'=> '#181715']);
        Product::create(['name' => 'Blue','product_id' => '31161632620646','image' => getenv('BASE_URL').'/popups/images/keyring-blue.png','in_stock' => true, 'colour_code'=> '#245CA4']);
        Product::create(['name' => 'Burgundy','product_id' => '31161632620646','image' => getenv('BASE_URL').'/popups/images/keyring-burgundy.png','in_stock' => true, 'colour_code'=> '#722448']);
        Product::create(['name' => 'Green','product_id' => '31161632620646','image' => getenv('BASE_URL').'/popups/images/keyring-green.png','in_stock' => true, 'colour_code'=> '#449158']);
        Product::create(['name' => 'Orange','product_id' => '31161632620646','image' => getenv('BASE_URL').'/popups/images/keyring-orange.png','in_stock' => true, 'colour_code'=> '#D85729']);
        Product::create(['name' => 'Pink','product_id' => '31161632620646','image' => getenv('BASE_URL').'/popups/images/keyring-pink.png','in_stock' => true, 'colour_code'=> '#C34D83']);
        Product::create(['name' => 'Purple','product_id' => '31161632620646','image' => getenv('BASE_URL').'/popups/images/keyring-purple.png','in_stock' => true, 'colour_code'=> '#5F458A']);
        Product::create(['name' => 'Red','product_id' => '31161632620646','image' => getenv('BASE_URL').'/popups/images/keyring-red.png','in_stock' => true, 'colour_code'=> '#C42D25']);
    }
}
