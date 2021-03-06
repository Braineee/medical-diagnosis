<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{

  // define the primary key
  protected $primaryKey = 'treatment_id';

  // define the fillabels
  protected $fillable = [
    'disease_disease_id',
    'treatment'
  ];

  /**
    * Declaring the ORM relationships
    */
  public function patientRecord(){
      return $this->hasMany('App\PatientRecord');
  }

  public function disease(){
    return $this->belongsTo('App\Disease');
  }

}
