<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    /**
     * The table that is associated with the model
    */
    protected $table = 'countries';

    /**
     * Using Soft Deletes for the model
     */
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'country_name',
        'country_code'
    ];
}
