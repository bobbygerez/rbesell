<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contact_data_id')->unsigned()->nullable();
            $table->foreign('contact_data_id')->references('id')
                ->on('contact_data');
            $table->integer('personal_data_id')->unsigned()->nullable();
            $table->foreign('personal_data_id')->references('id')
                ->on('personal_data');
            $table->string('member_id')->unique()->nullable();
            $table->string('account_no')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->boolean('status')->default(0);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
