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
        'marital_status_id',
        'colony_id'
    ];
}
