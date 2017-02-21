<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolarSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solar_system', function (Blueprint $table) {
            $table->increments('id');
             $table->string('name');
             $table->float('size');
             $table->float('coordinate_x');
             $table->float('coordinate_y');
             $table->float('coordinate_z');
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
        Schema::dropIfExists('solar_system');
    }
}
