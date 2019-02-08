<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{

  // define the primary key
  protected $primaryKey = 'level_id';

  // define the fillables
  protected $fillable = [
    'level_name',
  ];

  /**
    * Declaring the ORM relationships
    */
  public function NewSymptom(){
      return $this->hasMany('App\NewSymptom');
  }

  public function DiseaseSymptom(){
      return $this->hasMany('App\DiseaseSymptom');
  }
}
