<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attention;
use App\Models\BookingList;
use App\Models\Location;
use App\Models\Staff;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function index()
    {
        $atten = Attention::all();
        $staff = Staff::all();
        $location = Location::all();
        return view('page.admin.managestaff.addstaff', compact('staff', 'location', 'atten'));
    }

    public function delete($id)
    {
            $delete = Staff::find($id)->delete();

            return redirect()->back()->with('delete', "ลบเรียบร้อยแล้ว");


    }

    public function deleteatten($id)
    {

        //ลบข้อมูล
        $delete = Attention::find($id)->delete();

        return redirect()->back()->with('delete', "ลบเรียบร้อยแล้ว");

    }

    public function requeststaff()
    {
        $requeststaff = DB::table('booking_lists')

            ->join('locations', 'booking_lists.location_id', 'locations.location_id')
            ->join('attentions', 'locations.location_id', 'attentions.location_id')
            ->join('staff', 'staff.id', 'attentions.staff_id')
            ->where('status_cost', 1)
            ->where('status','!=', 10)
            ->where('staff.id', '=', session('id'))
            ->select('booking_lists.*', 'locations.location_name')
            ->paginate(10);

        return view('page.staff.request.index', compact('requeststaff'));

    }

    public function store(Request $request)
    {

        $request->validate([
            'location_id' => 'required|max:255',
            'staff_id' => 'required|max:255',
            'attention_name' => 'required|max:255',

        ],
            ['location_id.required' => "กรุณาป้อนห้อง",
                'staff_id.required' => "กรุณาใส่ไอดี Staff",

            ]

        );

        $addcal = new Attention;
        $addcal->location_id = $request->location_id;
        $addcal->staff_id = $request->staff_id;
        $addcal->attention_name = $request->attention_name;

        $addcal->save();

        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");

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

    public function location(Request $request)
    {

        $locationstaff = DB::table('locations')

            ->join('attentions', 'locations.location_id', 'attentions.location_id')
            ->join('staff', 'staff.id', 'attentions.staff_id')
            ->where('staff.id', '=', session('id'))
            ->select('locations.*', 'attentions.*', 'staff.email')
            ->paginate(1000);

        return view('page.staff.location.index', compact('locationstaff'));

    }

}
