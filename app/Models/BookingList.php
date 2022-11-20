<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingList extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'location_id',
        'project_cost',
        'project_name',
        'agency',
        'club_name',
        'start',
        'end',
        'status',
        'status_cost',
        'status_email',
        'file_document',
        'title',
        'more',

    ];

    public function booktolocation()
    {

        return $this->hasMany(Location::class, 'location_id', 'location_id');

    }

    public function booktouser()
    {

        return $this->hasMany(User::class, 'id', 'user_id');

    }

    public function booktoadmin()
    {

        return $this->hasMany(Admin::class, 'id', 'admin_id');

    }

    public function booktoinsider()
    {

        return $this->hasMany(Insiders::class, 'id', 'insiders_id');

    }

    public function booktostaff()
    {

        return $this->hasMany(Staff::class, 'id', 'staff_id');

    }
}
