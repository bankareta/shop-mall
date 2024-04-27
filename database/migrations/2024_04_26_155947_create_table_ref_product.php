<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRefProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_product', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id')->nullable()->unsigned();
            $table->string('name')->nullable();
            $table->bigInteger('price')->nullable();
            $table->text('desc')->nullable();
            $table->string('weight')->nullable();
            $table->string('country')->nullable();
            $table->string('quality')->nullable();
            $table->string('check')->nullable();
            $table->integer('disc')->default(0)->nullable();
            $table->string('url')->nullable();
            $table->string('filename')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('category_id')->references('id')->on('ref_category');
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
        Schema::dropIfExists('ref_product');
    }
}
