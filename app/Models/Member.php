<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
     /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start', 'end'];
    protected $fillable = [
        'name',
        'thumb',
        'gender',
        'birthday',
        'birth_place',
        'degree',
        'degree_2',
        'function',
        'specialized',
        'year',
        'name_school',
        'thumb_2',
        'name_company',
        'office',
        'address',
        'date',
        'email',
        'phone'
    ];
}