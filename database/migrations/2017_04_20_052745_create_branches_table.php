<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')
                ->on('users');
            $table->integer('merchant_id')->unsigned()->nullable();
            $table->foreign('merchant_id')->references('id')
                ->on('merchants');
            $table->string('branch_id_no')->nullable();
            $table->string('branch_name');
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
            $table->string('misc_data')->nullable();
            $table->string('registration_no')->unique()->nullable();
            $table->date('date_registered')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
