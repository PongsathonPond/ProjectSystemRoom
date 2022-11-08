<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insiders extends Model
{
    use HasFactory;

    protected $fillable = [

        'student_id',
        'title_name',
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',

    ];
 

    
}
