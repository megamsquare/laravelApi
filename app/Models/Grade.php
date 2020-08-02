<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    /**
     * The table that is associated with the model
    */
    protected $table = 'grades';

    /**
     * Using Soft Deletes for the model
     */
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'grade_name',
        'grade_code'
    ];
}
