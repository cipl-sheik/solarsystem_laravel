<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolarPlanetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solar_planet', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('solar_system_id');
			$table->string('name');
			$table->float('size');
             $table->float('coordinate_x');
             $table->float('coordinate_y');
             $table->float('coordinate_z');
			 $table->boolean('isSun');
			 $table->boolean('isOrbitSun');
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
        Schema::dropIfExists('solar_planet');
    }
}
