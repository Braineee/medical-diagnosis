<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientRecord extends Model
{
  // define the fillables
  protected $fillable = [
    'user_id',
    'disease_id',
    'symptoms',
    'treatment_id',


    /**
      * Declaring the ORM relationships
      */
    public function User(){
        return $this->belongsTo('App\User');
    }

    public function Disease(){
        return $this->belongsTo('App\Disease');
    }

    public function Treatment(){
        return $this->belongsTo('App\Treatment');
    }
}
