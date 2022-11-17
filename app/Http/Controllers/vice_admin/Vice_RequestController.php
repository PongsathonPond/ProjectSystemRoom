<?php

namespace App\Http\Controllers\vice_admin;

use App\Http\Controllers\Controller;
use App\Models\BookingList;
use Illuminate\Http\Request;

class Vice_RequestController extends Controller
{
    public function index()
    {
        $booking = BookingList::paginate(10000);
        return view('page.vice_admin.request.index', compact('booking'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([

            'status_cost' => 'required',
            
        ],

            [
            
            'status_cost.required' => "กรุณาใส่สถานะ",
          
            ]
        );

        BookingList::find($id)->update([

            'status_cost' => $request->status_cost,
            'project_cost' => $request->project_cost,
            
        ]);

        return redirect()->back()->with('update', "อัพเดตข้อมูลเรียบร้อย");
        // return redirect()->route('usermanager')->with('success',"อัพเดตข้อมูลเรียบร้อย");
    }
}
