<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    // define the primary key
    protected $primaryKey = 'disease_id';


    // define the fillables
    protected $fillable = [
      'disease_name',
    ];

    /**
      * Declaring the ORM relationships
      */
    public function DiseaseSymptom(){
        return $this->belongsToMany('App\DiseaseSymptom');
    }

    public function PatientRecord(){
        return $this->belongsToMany('App\PatientRecord');
    }
}
