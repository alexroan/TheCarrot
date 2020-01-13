<?php

use App\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTableUseWoodKeyring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Product::where('in_stock', true)->update(['in_stock' => false]);
        Product::create([
            'name' => 'Wooden Keyring','product_id' => '31161632620646','image' => config('app.url').'/popups/images/keyring-wood.jpg','in_stock' => true, 'colour_code'=> '#007bff'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Product::where('product_id', '31161632620646')
            ->delete();
        Product::where('in_stock', false)->update(['in_stock' => true]);
    }
}
