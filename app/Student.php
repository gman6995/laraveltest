<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=['id','firstName','middleName','lastName','grade','age','email'];
}
