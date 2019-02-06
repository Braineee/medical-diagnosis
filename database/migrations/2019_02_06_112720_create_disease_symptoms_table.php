<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseaseSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_symptoms', function (Blueprint $table) {
            $table->increments('disease_symptom_id');
            $table->integer('disease_id')->unsigned();
            $table->integer('symptom_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->timestamps();


            $table->foreign('disease_id')->references('disease_id')->on('diseases');
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
        Schema::dropIfExists('disease_symptoms');
    }
}
