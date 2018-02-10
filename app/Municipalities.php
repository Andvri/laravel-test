<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipalities extends Model
{
    protected $fillable = ['name','state_id'];
}
