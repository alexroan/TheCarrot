<?php

use App\DiscountCode;
use Illuminate\Database\Seeder;

class DiscountCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 100; $i++) { 
            $number = str_pad($i, 4, '0', STR_PAD_LEFT);
            $code = 'CRT' . $number;
            DiscountCode::create([
                'code' => $code
            ]);
        }
    }
}
