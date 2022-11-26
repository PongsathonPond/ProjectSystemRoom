<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocaiotnManageSuperAdmin extends Controller
{
    public function index()
    {

        $location = location::paginate(3);
        return view('page.admin.locationmanage.index', compact('location'));
    }

    public function index2(Request $request)
    {

        $location = DB::table('locations');
        if ($request->name) {
            $location = $location->where('location_name', 'LIKE', "%" . $request->name . "%");
        }

        $location = $location->paginate(10);
        return view('page.user.booking.index', compact('location'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'location_name' => 'required|max:255',
            'location_building' => 'required|max:255',
            'location_floor' => 'required|max:255',
            'location_image' => 'required|mimes:jpg,jpeg,png',
            'accommodate_people' => 'required|max:255|integer',
            'cost_fullday' => 'required|max:255|integer',
            'cost_halfday' => 'required|max:255|integer',
            'area' => 'required|max:255',
            'location_type' => 'required|max:255',

        ],
            ['location_name.required' => "กรุณาป้อนห้อง",
                'location_building.required' => "กรุณาป้อนอาคาร",
                'location_floor.required' => "กรุณาป้อนชั้น",
                'location_image.required' => "กรุณาเพิ่มรูปภาพ",
                'accommodate_people.integer' => "กรุณาป้อนตัวเลขเท่านั้น",
                'cost_fullday.integer' => "กรุณาป้อนตัวเลขเท่านั้น",
                'cost_halfday.integer' => "กรุณาป้อนตัวเลขเท่านั้น",
                'area.required' => "กรุณาป้อนที่ตั้ง",
                'location_type.required' => "กรุณาเพิ่มประเภท",

            ]

        );
        //เข้ารหัสรูปภาพ
        $room_image = $request->file('location_image');

        //gennerat ชื่อภาพ
        $name_gen = hexdec(uniqid());
        //ดึงนามสกุลไฟล์ภาพ
        $img_ext = strtolower($room_image->getClientOriginalExtension());
//รวมชื่อไฟล์กับนามสกุล
        $img_name = $name_gen . '.' . $img_ext;

        //อัพโหลดและบันทึกข้อมูล

        //สร้างไดเรกทอรี่
        $upload_location = 'img/location/';
        $full_path = $upload_location . $img_name;
        //อัพโหลดลงดาต้าเบส ด้วย model

        $addcal = new Location;
        $addcal->location_name = $request->location_name;
        $addcal->location_building = $request->location_building;
        $addcal->location_floor = $request->location_floor;
        $addcal->area = $request->area;

        $addcal->accommodate_people = $request->accommodate_people;
        $addcal->cost_halfday = $request->cost_halfday;
        $addcal->cost_fullday = $request->cost_fullday;
        $addcal->location_type = $request->location_type;
        $addcal->other = $request->other;
        $addcal->location_image = $full_path;
        $addcal->created_at = Carbon::now();

        $addcal->save();
        //อัพโหลดภาพไปไดเรกทอรี่
        $room_image->move($upload_location, $img_name);

        return redirect()->back()->with('success', "บันทึกข้อมูลเรียบร้อย");

    }

    public function delete($location_id)
    {
        //ลบภ่าพ

        $img = Location::find($location_id)->location_image;

        $img = Location::find($location_id)->location_image;
        if ($img == null) {
            unlink($img);
        }

        //ลบข้อมูล
        $delete = Location::find($location_id)->delete();
        return redirect()->back()->with('delete', "ลบเรียบร้อยแล้ว");

    }

    public function update(Request $request, $location_id)
    {

        $request->validate([

            'accommodate_people' => 'required|max:255|integer',
            'cost_fullday' => 'required|max:255|integer',
            'cost_halfday' => 'required|max:255|integer',

        ],
            [
                'accommodate_people.integer' => "กรุณาป้อนตัวเลขเท่านั้น",
                'cost_fullday.integer' => "กรุณาป้อนตัวเลขเท่านั้น",
                'cost_halfday.integer' => "กรุณาป้อนตัวเลขเท่านั้น",


            ]

        );
        $location_Image = $request->file('location_image');

        if ($location_Image) {
            //อัพเดทภาพและชื่อ
            $name_gen = hexdec(uniqid());

            $img_ext = strtolower($location_Image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;

            $upload_location = 'img/location/';
            //ลบภาพเก่าและอัพภาพใหม่

            //อัพเดทข้อมูล

            $full_path = $upload_location . $img_name;
            location::find($location_id)->update([

                'location_image' => $full_path,

            ]);
            //ลบภาพเก่าและอัพภาพใหม่
            $old_image = $request->old_image;
            unlink($old_image);
            $location_Image->move($upload_location, $img_name);
            return redirect()->back()->with('update', "อัพเดตข้อมูลเรียบร้อย");

        } else {
            location::find($location_id)->update([
                'location_name' => $request->location_name,
                'location_building' => $request->location_building,
                'location_floor' => $request->location_floor,
                'accommodate_people' => $request->accommodate_people,
                'cost_halfday' => $request->cost_halfday,
                'cost_fullday' => $request->cost_fullday,
                'area' => $request->area,
                'location_type' => $request->location_type,
                'other' => $request->other,
            ]);
            return redirect()->back()->with('update', "อัพเดตข้อมูลเรียบร้อย");

        }

    }



    public function updatestatus(Request $request, $location_id)
    {

            location::find($location_id)->update([
                'status' => $request->status,
            ]);
            return redirect()->back()->with('update', "อัพเดตข้อมูลเรียบร้อย");



    }
}
