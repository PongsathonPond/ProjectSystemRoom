<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attention extends Model
{
    use HasFactory;

    protected $fillable = [

        'staff_id ',
        'location_id',
        'attention_name	',

    ];

    public function attentolo()
    {

        return $this->hasMany(Location::class, 'location_id', 'location_id');

    }

}
