<?php

use Illuminate\Database\Seeder;

class ChargesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $charges = ['担当者１','担当者２','担当者３','担当者４'];
        foreach ($charges as $charge) {
            DB::table('charges')->insert([
                'charge_name' => $charge,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
    }
}
