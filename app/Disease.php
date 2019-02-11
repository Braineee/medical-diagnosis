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
      'description'
    ];

    /**
      * Declaring the ORM relationships
      */
    public function symptoms(){
        return $this->belongsToMany('App\Symptom', 'disease_symptoms', 'disease_id', 'symptom_id');
    }

    public function patientRecords(){
        return $this->hasMany('App\PatientRecord');
    }

    public function treatment(){
        return $this->hasMany('App\Treatment');
    }
}
