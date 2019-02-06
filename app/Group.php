<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  // define the fillables
  protected $fillable = [
    'group_name',
  ];

  /**
    * Declaring the ORM relationships
    */
  public function User(){
      return $this->hasMany('App\User');
  }
}
