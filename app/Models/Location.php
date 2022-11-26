<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [

        'location_name',
        'location_building',
        'location_floor',
        'location_image',
        'accommodate_people',
        'cost_halfday',
        'cost_fullday',
        'area',
        'location_type',
        'status',
        'other',

    ];
    protected $primaryKey = 'location_id';

    public function locationtoatten()
    {

        return $this->hasMany(Attention::class, 'location_id', 'location_id');

    }

}
