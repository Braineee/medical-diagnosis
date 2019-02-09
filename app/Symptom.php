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
    ];

    /**
      * Declaring the ORM relationships
      */
    public function DiseaseSymptom(){
        return $this->belongsToMany('App\DiseaseSymptom');
    }

    public function Disease(){
        return $this->belongsToMany('App\Disease');
    }

    public function NewSymptom(){
        return $this->hasMany('App\NewSymptom');
    }
}
