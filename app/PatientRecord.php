<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientRecord extends Model
{

  // define the primary key
  protected $primaryKey = 'patient_record_id';

  // define the fillables
  protected $fillable = [
    'user_id',
    'disease_id',
    'symptoms',
    'treatment_id',
  ];

    /**
      * Declaring the ORM relationships
      */
    public function users(){
        return $this->belongsTo('App\User');
    }

    public function diseases(){
        return $this->belongsTo('App\Disease');
    }

    public function treatments(){
        return $this->belongsTo('App\Treatment');
    }
}
