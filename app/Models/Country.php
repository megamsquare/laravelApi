<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The table that is associated with the model
    */
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'country_name',
        'country_code'
    ];
}
