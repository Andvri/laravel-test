<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = [
        'names',
        'paternal_surname',
        'maternal_surname',
        'birthdate',
        'phone',
        'gender',
        'rfc',
        'curp',
        'ife_key',
        'elector_key',
        'imss',
        'contract_date',
        'company_id',
        'nationality_mode_id',
        'marital_statuses_id',
        'colony_id'
    ];

    public function company(){
        return $this->belongsTo(Companies::class);
    }
    public function colony(){
        return $this->belongsTo(Colonies::class);
    }
    public function marital_statuses(){
        return $this->belongsTo(MaritalStatuses::class);
    }
    public function nationality_mode(){
        return $this->belongsTo(NationalityModes::class);
    }
}
