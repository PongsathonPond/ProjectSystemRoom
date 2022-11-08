<?php

namespace App\Http\Controllers;

use App\Models\BookingList;

class RouteController extends Controller
{
    public function index()
    {

        $booking = BookingList::all();

        return view('page.user.routes.index', compact('booking'));

    }
}
