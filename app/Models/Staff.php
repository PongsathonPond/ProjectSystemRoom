<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [

        'title_name',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',

    ];
}
