<?php

namespace App\Http\Controllers;
use App\Models\BookingList;
use App\Models\Location;
use Illuminate\Http\Request;


class RequestStaffController extends Controller
{
    public function index()
    {
        $location = Location::all();
        $booking = BookingList::where('staff_id', session('id'))->paginate(10000);

        return view('page.staff.request.me', compact('booking', 'location'));
    }
}
