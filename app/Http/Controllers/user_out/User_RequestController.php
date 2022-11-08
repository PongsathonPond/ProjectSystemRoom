<?php

namespace App\Http\Controllers\user_out;

use App\Http\Controllers\Controller;
use App\Models\BookingList;
use App\Models\Location;

class User_RequestController extends Controller
{
    public function index()
    {

        $location = Location::all();

        if (empty(session('student_id'))) {
            $booking = BookingList::where('user_id', session('id'))->paginate(5);
        } else {
            $booking = BookingList::where('insiders_id', session('id'))->paginate(5);
        }

        return view('page.user.request.index', compact('booking', 'location'));
    }

    public function detail($id)
    {

        $booking = BookingList::find($id);

        return view('page.user.request.detail', compact('booking'));
    }
}
