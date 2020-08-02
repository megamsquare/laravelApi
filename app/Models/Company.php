<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    /**
     * The table that is associated with the model
    */
    protected $table = 'companies';

    /**
     * Using Soft Deletes for the model
     */
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'company_name',
        'company_address',
        'company_code'
    ];
}
