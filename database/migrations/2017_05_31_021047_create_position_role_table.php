<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position_id')->unsigned()->nullable();
            $table->foreign('position_id')->references('id')
                ->on('positions');
            $table->integer('role_id')->unsigned()->nullable();
            $table->foreign('role_id')->references('id')
                 ->on('roles');
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
        Schema::dropIfExists('position_role');
    }
}
