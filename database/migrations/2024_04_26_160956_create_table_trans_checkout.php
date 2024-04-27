<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransCheckout extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_checkout', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->nullable()->unsigned();
            $table->bigInteger('total_amount')->nullable();
            $table->integer('status')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->nullableTimestamps();
        });

        Schema::create('trans_checkout_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('checkout_id')->nullable()->unsigned();
            $table->integer('product_id')->nullable()->unsigned();
            $table->bigInteger('qty')->nullable();
            $table->bigInteger('price')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('checkout_id')->references('id')->on('trans_checkout');
            $table->foreign('product_id')->references('id')->on('ref_product');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trans_checkout_detail');
        Schema::dropIfExists('trans_checkout');
    }
}
