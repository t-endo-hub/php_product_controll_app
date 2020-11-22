<?php

use Illuminate\Database\Seeder;

class ProductItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productItems = ['テストアイテム１','テストアイテム２','テストアイテム３','テストアイテム４','テストアイテム５','テストアイテム６'];
        foreach ($productItems as $productItem) {
            DB::table('product_items')->insert([
                'item_name' => $productItem,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
    }
}
