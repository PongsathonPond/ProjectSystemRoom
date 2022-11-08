<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class CalReqController extends Controller
{
    public function index()
    {
        $location = location::all();
        return view('page.user.cal.index', compact('location'));
    }

    public function edit($location_id)
    {
        $find = Location::find($location_id);
        $location = location::all();

        return view('page.user.cal.find', compact('find', 'location'));
    }

    public function index2(Request $request)
    {

        $d1 = strtotime($request->start);
        $d2 = strtotime($request->end);
        $totalSecondsDiff = abs($d1 - $d2);
        $totalHoursDiff = $totalSecondsDiff / 60 / 60;
        $totalDaysDiff = $totalSecondsDiff / 60 / 60 / 24;
        $sum = null;
        $test = null;

        $location = $request->name;
        $bul = $request->building;
        if ($totalHoursDiff <= 6) {

            $sum = $request->half;
            $test = 1;
        } elseif ($totalHoursDiff > 6 and $totalHoursDiff <= 24) {
            $sum = $request->full;
            $test = 2;
        } elseif ($totalDaysDiff > 1) {
            $sum = $request->full * $totalDaysDiff;
            $test = 3;
        }

        return view('page.user.cal.calall', compact('totalHoursDiff', 'totalDaysDiff', 'sum', 'test', 'location', 'bul'));
    }
}
