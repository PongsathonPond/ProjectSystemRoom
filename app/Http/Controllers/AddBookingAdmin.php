<?php

namespace App\Http\Controllers;

use App\Models\BookingList;
use App\Models\Location;
use Illuminate\Http\Request;

class AddBookingAdmin extends Controller
{
    public function index()
    {

        $location = location::where('status',0)->get();
        $booking = BookingList::all();
        return view('page.admin.booking.index', compact('location', 'booking'));
    }

    public function index2(Request $request, $id)
    {

        if ($request->ajax()) {

            $data = BookingList::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->where('location_id', $id)
                ->get(['id', 'title', 'start', 'end', 'location_id']);

            return response()->json($data);

        }

        return view('page.admin.booking.add');
    }
    public function edit($location_id)
    {
        $location = Location::find($location_id);
        return view('page.admin.booking.add', compact('location'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'location_id' => 'required|max:255',
            'project_name' => 'required|max:255',
            'agency' => 'required|max:255',
            'club_name' => 'required',
            'start' => 'required|max:255',
            'end' => 'required|max:255',
            'file_document' => 'required|mimes:pdf',

        ],
            ['location_id.required' => "กรุณาป้อนห้อง",
                'project_name.required' => "กรุณาป้อนอาคาร",
                'agency.required' => "กรุณาป้อนชั้น",
                'club_name.required' => "กรุณาเพิ่มรูปภาพ",
                'start.required' => "กรุณาป้อนความจุของห้อง",
                'end.required' => "กรุณาป้อนราคาเต็มวัน",
                'file_document.required' => "กรุณาป้อนราคาเต็มวัน",

            ]
        );

        $room_image = $request->file('file_document');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($room_image->getClientOriginalExtension());
        $img_name = $name_gen . '.' . $img_ext;
        $upload_location = 'pdf/pdf/';
        $full_path = $upload_location . $img_name;

        $addcal = new BookingList;
        $addcal->location_id = $request->location_id;
        $addcal->admin_id = session('id');
        $addcal->project_name = $request->project_name;
        $addcal->agency = $request->agency;
        $addcal->club_name = $request->club_name;
        $addcal->title = $request->title;
        $addcal->start = $request->start;
        $addcal->end = $request->end;
        $addcal->file_document = $full_path;
        $addcal->more = $request->more;
        $addcal->save();

        $room_image->move($upload_location, $img_name);

        //อัพโหลดภาพไปไดเรกทอรี่
        return redirect()->route('add-bookingadmin')->with('success', "บันทึกข้อมูลเรียบร้อย");

    }

}
