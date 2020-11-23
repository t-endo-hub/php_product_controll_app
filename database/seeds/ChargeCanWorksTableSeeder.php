<?php

use Illuminate\Database\Seeder;

class ChargeCanWorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('charge_can_works')->insert([
            'product_item_id' => '1',
            'charge_id' => '1',
            'time_required' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('charge_can_works')->insert([
            'product_item_id' => '1',
            'charge_id' => '2',
            'time_required' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('charge_can_works')->insert([
            'product_item_id' => '1',
            'charge_id' => '3',
            'time_required' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('charge_can_works')->insert([
            'product_item_id' => '2',
            'charge_id' => '1',
            'time_required' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('charge_can_works')->insert([
            'product_item_id' => '2',
            'charge_id' => '2',
            'time_required' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
