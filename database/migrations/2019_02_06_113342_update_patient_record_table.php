<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePatientRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //add the phone number and the group_id to the users table
      Schema::table('patient_records', function (Blueprint $table){
        $table->integer('treatment_id')->unsigned();

        $table->foreign('treatment_id')->references('treatment_id')->on('treatments');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
