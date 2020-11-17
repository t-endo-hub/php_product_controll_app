<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargeCanWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_can_works', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->bigInteger('charge_id')->unsigned();
            $table->foreign('charge_id')->references('id')->on('charges')
                  ->onDelete('cascade');

            $table->bigInteger('product_item_id')->unsigned();
            $table->foreign('product_item_id')->references('id')->on('product_items')
                ->onDelete('cascade');

            $table->float('time_required');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charge_can_works');
    }
}
