<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users');
                
            $table->integer('productable_id')->nullable();
            $table->string('productable_type')->nullable();

            $table->integer('discount_id')->unsigned()->nullable();
            $table->foreign('discount_id')->references('id')
                ->on('discounts');

            $table->decimal('price')->nullable();

            $table->integer('quantity_id')->unsigned()->nullable();
            $table->foreign('quantity_id')->references('id')
                ->on('quantities');
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
        Schema::dropIfExists('productables');
    }
}
