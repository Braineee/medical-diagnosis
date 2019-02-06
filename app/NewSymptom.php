<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewSymptom extends Model
{
  // define the fillables
  protected $fillable = [
    'symptom_id',
    'level_id',
    'added',
  ];

  /**
    * Declaring the ORM relationships
    */
  public function Level(){
      return $this->belongsTo('App\Level');
  }

  public function Symptom(){
      return $this->belongsTo('App\Symptom');
  }

}
