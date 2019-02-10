<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{

    // define the primary key
    protected $primaryKey = 'symptom_id';

    // define the fillabels
    protected $fillable = [
      'symptom_name',
      'description'
    ];

    /**
      * Declaring the ORM relationships
      */
    public function levels(){
        return $this->belongsToMany('App\Symptom', 'disease_symptoms', 'symptom_id', 'level_id');
    }

    public function diseases(){
        return $this->belongsToMany('App\Disease');
    }

    public function newSymptom(){
        return $this->hasMany('App\NewSymptom');
    }
}
