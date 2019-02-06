<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    // define the fillabels
    protected $fillable = [
      'symptom_name',
    ];

    /**
      * Declaring the ORM relationships
      */
    public function DiseaseSymptom(){
        return $this->belongsToMany('App\DiseaseSymptom');
    }

    public function NewSymptom(){
        return $this->hasMany('App\NewSymptom');
    }
}
