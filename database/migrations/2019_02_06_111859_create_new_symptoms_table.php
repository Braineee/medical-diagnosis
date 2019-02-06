<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /**
        * note! incase off err> (errno: 150 "Foreign key constraint is incorrectly formed or formartted)
        * SOLUTION>> add "->unsigned();" to the foregin key.
      */
        Schema::create('new_symptoms', function (Blueprint $table) {
            $table->increments('new_symptom_id');
            $table->integer('symptom_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->integer('added')->default(0);//if disease has been added to this symptoms ? 1 : 0
            $table->timestamps();

            $table->foreign('symptom_id')->references('symptom_id')->on('symptoms');
            $table->foreign('level_id')->references('level_id')->on('levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_symptoms');
    }
}
