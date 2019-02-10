<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

  // define the primary key
  protected $primaryKey = 'group_id';

  // define the fillables
  protected $fillable = [
    'group_name',
  ];

  /**
    * Declaring the ORM relationships
    */
  public function users(){
      return $this->hasMany('App\User');
  }
}
