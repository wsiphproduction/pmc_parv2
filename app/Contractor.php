<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Contractor extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table='contractors';

    protected $fillable = [
        'contractor_id','contractor_fname','contractor_lname','contractor_mname','contractor_dept'
    ];

    public $timestamps = false;

    

}