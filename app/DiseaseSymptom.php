<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiseaseSymptom extends Model
{
  // define the fillables
  protected $fillable = [
    'disease_id',
    'symptom_id',
    'level_id'
  ];

  /**
    * Declaring the ORM relationships
    */
  public function Diease(){
      return $this->belongsTo('App\Diease');
  }

  public function Symptom(){
      return $this->belongsTo('App\Symptom');
  }
}
