<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BookingList;
use App\Models\Location;

class RequestAdminController extends Controller
{
    public function index()
    {
        $location = Location::all();
        $booking = BookingList::where('admin_id', session('id'))->paginate(5);

        return view('page.admin.request.me.index', compact('booking', 'location'));
    }
}
