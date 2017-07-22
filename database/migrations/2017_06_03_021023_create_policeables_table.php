<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliceablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policeables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('policy_id')->unsigned()->nullable();
            $table->integer('policeable_id')->unsigned()->nullable();
            $table->string('policeable_type')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('policeables');
    }
}
