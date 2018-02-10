<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colonies extends Model
{
    protected $fillable = ['name','municipality_id'];

    public function municipality(){
        return $this->belongsTo(Municipalities::class);
    }
}
