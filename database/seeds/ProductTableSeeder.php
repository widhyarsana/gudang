<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Gabah',
                'type' => 1,
                'stock' => 0,
                'price' => 0
            ],
            [
                'name' => 'Putri',
                'type' => 2,
                'stock' => 0,
                'price' => 1200
            ],
            [
                'name' => 'Dedak',
                'type' => 3,
                'stock' => 0,
                'price' => 1200
            ],
            [
                'name' => 'Menir',
                'type' => 4,
                'stock' => 0,
                'price' => 1200
            ],
            [
                'name' => 'Broken',
                'type' => 5,
                'stock' => 0,
                'price' => 1200
            ],
        ];

        foreach($data as $item){
            Product::create($item);
        }
    }
}
