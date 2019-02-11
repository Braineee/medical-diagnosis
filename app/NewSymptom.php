<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewSymptom extends Model
{


  // define the primary key
  protected $primaryKey = 'new_symptom_id';

  // define the fillables
  protected $fillable = [
    'case_id',
    'symptom_id',
    'level_id',
    'added',
  ];

  /**
    * Declaring the ORM relationships
    */
  public function levels(){
      return $this->belongsTo('App\Level');
  }

  public function symptoms(){
      return $this->belongsTo('App\Symptom');
  }

}
