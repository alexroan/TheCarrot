<?php

use App\DiscountCode;
use App\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertProductsAndDiscountCodes extends Migration
{
    private $discounts = [
        "CRT-56E2436E",
        "CRT-3F45C189",
        "CRT-47A06A98",
        "CRT-6115B3D3",
        "CRT-6F67941D",
        "CRT-8271306A",
        "CRT-E1AC1184",
        "CRT-0B2E7098",
        "CRT-19939D7F",
        "CRT-365A2452",
        "CRT-D66A3925",
        "CRT-60C38E0A",
        "CRT-90349B2C",
        "CRT-9AA0D6F2",
        "CRT-9038FA95",
        "CRT-D3C44FCA",
        "CRT-CB874EBF",
        "CRT-844DFC4C",
        "CRT-922FF796",
        "CRT-F2803943",
        "CRT-C86F9220",
        "CRT-87F02D35",
        "CRT-AC10D450",
        "CRT-FAAB534D",
        "CRT-A86E9B15",
        "CRT-CB7BCA16",
        "CRT-C5C65881",
        "CRT-7032467C",
        "CRT-32A1669A",
        "CRT-E588FA9F",
        "CRT-82EDFE06",
        "CRT-07BED4DA",
        "CRT-B0ABDEE1",
        "CRT-FA6E9536",
        "CRT-F6F92DEB",
        "CRT-FCE8E77B",
        "CRT-9CA01CA7",
        "CRT-531D9DCE",
        "CRT-29145B9D",
        "CRT-26CE456C",
        "CRT-A6A5DFA7",
        "CRT-6D13F536",
        "CRT-F9A56C08",
        "CRT-0721CD62",
        "CRT-58C78CEB",
        "CRT-7DFFDD91",
        "CRT-7B41A06B",
        "CRT-5C762357",
        "CRT-DCC5C748",
        "CRT-74ADA4E9",
        "CRT-B09A76BC",
        "CRT-7688EC8B",
        "CRT-9932D372",
        "CRT-FBD85704",
        "CRT-E8BEA655",
        "CRT-213D8783",
        "CRT-15E8D640",
        "CRT-874CABB6",
        "CRT-614CCACD",
        "CRT-67A64513",
        "CRT-F847D6A6",
        "CRT-BA6F2C17",
        "CRT-B5EAACE2",
        "CRT-DE33C0F9",
        "CRT-42999B4B",
        "CRT-145EB30F",
        "CRT-4C6A8AD4",
        "CRT-614936E6",
        "CRT-B7A699D9",
        "CRT-B068F8AB",
        "CRT-224C98C7",
        "CRT-581F176F",
        "CRT-AD30AAE3",
        "CRT-F5E5EA91",
        "CRT-7C0926F6",
        "CRT-9E049E10",
        "CRT-2C5AB6E3",
        "CRT-CF5A44E6",
        "CRT-8FFE771A",
        "CRT-E73D5835",
        "CRT-F8C88DBD",
        "CRT-95B5CC8C",
        "CRT-CFF66D60",
        "CRT-B8338352",
        "CRT-60FD5B1C",
        "CRT-8D8F33E5",
        "CRT-08EDE944",
        "CRT-494BC79C",
        "CRT-752D299B",
        "CRT-C1B27F09",
        "CRT-C0E4A2AA",
        "CRT-45FC3F1B",
        "CRT-854B5E9C",
        "CRT-11CC01B0",
        "CRT-AA8464F9",
        "CRT-077B2802",
        "CRT-40AD69AA",
        "CRT-F2E319E1",
        "CRT-0DB6EE91",
        "CRT-4BE56F78",
        "CRT0001",
    ];

    private $products;

    public function __construct()
    {
        $this->products = [];
        $this->products[] = ['name' => 'Black','product_id' => '31280555884646','image' => getenv('BASE_URL').'/popups/images/keyring-black.png','in_stock' => true, 'colour_code'=> '#181715'];
        $this->products[] = ['name' => 'Blue','product_id' => '31280555524198','image' => getenv('BASE_URL').'/popups/images/keyring-blue.png','in_stock' => true, 'colour_code'=> '#245CA4'];
        $this->products[] = ['name' => 'Burgundy','product_id' => '31280559587430','image' => getenv('BASE_URL').'/popups/images/keyring-burgundy.png','in_stock' => true, 'colour_code'=> '#722448'];
        $this->products[] = ['name' => 'Green','product_id' => '31280549134438','image' => getenv('BASE_URL').'/popups/images/keyring-green.png','in_stock' => true, 'colour_code'=> '#449158'];
        $this->products[] = ['name' => 'Orange','product_id' => '31280549658726','image' => getenv('BASE_URL').'/popups/images/keyring-orange.png','in_stock' => true, 'colour_code'=> '#D85729'];
        $this->products[] = ['name' => 'Pink','product_id' => '31280548544614','image' => getenv('BASE_URL').'/popups/images/keyring-pink.png','in_stock' => true, 'colour_code'=> '#C34D83'];
        $this->products[] = ['name' => 'Purple','product_id' => '31280571023462','image' => getenv('BASE_URL').'/popups/images/keyring-purple.png','in_stock' => true, 'colour_code'=> '#5F458A'];
        $this->products[] = ['name' => 'Red','product_id' => '31280540811366','image' => getenv('BASE_URL').'/popups/images/keyring-red.png','in_stock' => true, 'colour_code'=> '#C42D25'];
        $this->products[] = ['name' => 'Teal','product_id' => '31280566927462','image' => getenv('BASE_URL').'/popups/images/keyring-teal.png','in_stock' => true, 'colour_code'=> '#25554E'];
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Insert discount Codes
        foreach ($this->discounts as $discount) {
            DiscountCode::create([
                'code' => $discount
            ]);
        }
        // Insert products
        foreach ($this->products as $product) {
            Product::create($product);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
