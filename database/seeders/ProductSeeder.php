<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductData;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 200; $i++) {
            $product = Product::create([
                'category_id' => rand(4, 12),
                'vendor_code' => $i . $i . $i,
                'alias' => Str::slug('Product number ' . $i, '-'),
                'search_string' => 'продуктru' . $i . '_продуктua' . $i
            ]);
            $id = $product->id;
            foreach (['ua', 'ru'] as $lang){
                ProductData::create([
                    'product_id' => $id,
                    'lang' => $lang,
                    'name' => 'Продукт номер '. $i .' на ' . $lang . ' языке',
                    'short_description' => 'Короткое описание '. $i .' продукта на '. $lang . ' языке',
                    'description' => 'Большое и полное писание на '. $lang . ' языке'
                ]);
            }
        }
    }
}
