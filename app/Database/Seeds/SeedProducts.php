<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Product;

class SeedProducts extends Seeder
{
    public function run()
    {
        $product = new Product();
        $faker = \Faker\Factory::create();

        for($i=0;$i<100;$i++){
            $product->save([
                'nama_produk' => $faker->name,
                'deskripsi' => $faker->sentence,
                'harga' => $faker->numberBetween(1000,100000),
                'jumlah_stok' => $faker->numberBetween(1,100),
            ]);
        }

    }
}
