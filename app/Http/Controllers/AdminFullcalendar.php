<?php

namespace App\Http\Controllers;

use App\Models\BookingList;
use App\Models\Location;

class AdminFullcalendar extends Controller
{
    //

    public function index()
    {

        $location = location::all();
        $booking = BookingList::all();
        return view('page.admin.calendar.index', compact('location', 'booking'));

    }

  

    public function edit($location_id)
    {
        $find = Location::find($location_id);
        $location = location::all();

        return view('page.admin.calendar.findlocation', compact('find', 'location'));
    }

   
}
