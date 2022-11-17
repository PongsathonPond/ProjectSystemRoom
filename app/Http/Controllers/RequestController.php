<?php

namespace App\Http\Controllers;

use App\Models\BookingList;
use App\Models\Location;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $location = Location::all();
        $booking = BookingList::where('status','!=',10)->paginate(10000);

        return view('page.admin.request.SuperAdmin.index', compact('booking', 'location'));

    }

    public function cancel()
    {
        $location = Location::all();
        $booking = BookingList::where('status',10)->paginate(10000);

        return view('page.admin.request.SuperAdmin.cancel', compact('booking', 'location'));

    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'status' => 'required',

        ],

            ['status.required' => "กรุณาใส่สถานะ",

            ]
        );

       
        BookingList::find($id)->update([

            'status' => $request->status,

        ]);

        return redirect()->back()->with('update', "อัพเดตข้อมูลเรียบร้อย");
        // return redirect()->route('usermanager')->with('success',"อัพเดตข้อมูลเรียบร้อย");
    }

    public function updatereq(Request $request, $id)
    {

        $request->validate([

            'location_id' => 'required',
            'project_name' => 'required',
            'start' => 'required',
            'end' => 'required',

        ],

            ['project_name.required' => "กรุณาใส่สถานะ",

            ]
        );
        BookingList::find($id)->update([

            'location_id' => $request->location_id,
            'project_name' => $request->project_name,
            'start' => $request->start,
            'end' => $request->end,

        ]);

        return redirect()->back()->with('update', "อัพเดตข้อมูลเรียบร้อย");
        // return redirect()->route('usermanager')->with('success',"อัพเดตข้อมูลเรียบร้อย");
    }

    public function updateedit(Request $request, $id)
    {


        $request->validate([

            'status' => 'required',

        ],

            ['status.required' => "กรุณาใส่สถานะ",

            ]
        );


        BookingList::find($id)->update([

            'status' => $request->status,

        ]);

        return redirect()->back()->with('updateedit', "อัพเดตข้อมูลเรียบร้อย");
        // return redirect()->route('usermanager')->with('success',"อัพเดตข้อมูลเรียบร้อย");
    }

    public function delete($id)
    {

        //ลบข้อมูล
        $delete = BookingList::find($id)->delete();
        return redirect()->back()->with('delete', "ลบเรียบร้อยแล้ว");

    }
}
