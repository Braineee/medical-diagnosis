<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
  // define the fillabels
  protected $fillable = [
    'disease_id',
    'treatment'
  ];

  /**
    * Declaring the ORM relationships
    */
  public function PatientRecord(){
      return $this->hasMany('App\PatientRecord');
  }

}
