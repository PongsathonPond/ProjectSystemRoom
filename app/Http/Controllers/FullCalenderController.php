<?php

namespace App\Http\Controllers;

use App\Models\BookingList;
use Illuminate\Http\Request;

class FullCalenderController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = BookingList::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->where('status', 1)
                ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }

        return view('page.user.routes.index');
    }

    public function indexadmin(Request $request)
    {

        if ($request->ajax()) {

            $data = BookingList::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->where('status', 0)
                ->get(['id', 'title', 'start', 'end', 'status']);

            return response()->json($data);
        }

        return view('page.admin.calendar.index');
    }

    public function show($id)
    {
        $booking = BookingList::find($id);
        return response()->json($booking);

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {

        switch ($request->type) {
            case 'add':
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = Event::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = Event::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                # code...
                break;
        }
    }

}
