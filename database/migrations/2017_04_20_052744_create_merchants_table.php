<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')
                ->on('users');
            $table->string('merchant_id')->nullable()->unique();
            $table->string('branch_id')->nullable()->unique();
            $table->string('name')->nullable()->unique();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->boolean('status')->nullable();
            $table->string('contact_person')->nullable();
            $table->integer('registered_by_id')->unsigned()->nullable();
            $table->foreign('registered_by_id')->references('id')
                ->on('registered_by');
            $table->integer('ownership_type_id')->unsigned()->nullable();
            $table->foreign('ownership_type_id')->references('id')
                ->on('ownership_type');
            $table->string('business_type')->nullable();
            $table->boolean('for_franchise')->nullable();
            $table->integer('franchise_id')->unsigned()->nullable();
            $table->foreign('franchise_id')->references('id')
                ->on('franchise');
            $table->integer('trade_id')->unsigned()->nullable();
            $table->foreign('trade_id')->references('id')
                ->on('trade');
            $table->string('misc_data')->nullable();
            $table->string('registration_no')->unique()->nullable();
            $table->date('date_registered')->nullable();
            $table->boolean('pos')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('merchants');
    }
}
