<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionPlanOnChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_plan_on_charges', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('charge_id')->unsigned();
            $table->foreign('charge_id')->references('id')->on('charges')
                  ->onDelete('cascade');

            $table->bigInteger('product_item_id')->unsigned();
            $table->foreign('product_item_id')->references('id')->on('product_items')
                ->onDelete('cascade');

            $table->date('start_date_of_week');
            $table->integer('num');
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
        Schema::dropIfExists('production_plan_on_charges');
    }
}
