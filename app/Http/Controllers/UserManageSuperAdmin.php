<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class UserManageSuperAdmin extends Controller
{
    public function index()
    {
        $users = User::all();
        $admin = Admin::all();
        return view('page.admin.usermanage.index', compact('users', 'admin'));
    }

    public function update(Request $request, $id)
    {

        dd($request);
        $request->validate([

            'title_name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'role' => 'required',

        ],

            ['title_name.required' => "กรุณาป้อนคำนำหน้า",

                'first_name.required' => "กรุณาป้อนชื่อ",
                'last_name.required' => "กรุณาป้อนนามสกุล",
                'phone_number.required' => "กรุณาป้อนเบอร์โทร",
                'email.required' => "กรุณาป้อนอีเมล์",
                'role.required' => "กรุณาป้อนสถานะ",

            ]
        );
        User::find($id)->update([

            'title_name' => $request->title_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,

            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'role' => $request->role,

        ]);

        return redirect()->back()->with('success', "อัพเดตข้อมูลเรียบร้อย");
        // return redirect()->route('usermanager')->with('success',"อัพเดตข้อมูลเรียบร้อย");
    }

    public function updateadmin(Request $request, $id)
    {
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ],
            [
                'first_name.required' => "กรุณาป้อนชื่อ",
                'last_name.required' => "กรุณาป้อนนามสกุล",
                'email.required' => "กรุณาป้อนอีเมล์",
            ]
        );

        
        
        Admin::find($id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);


        return redirect()->back()->with('success', "อัพเดตข้อมูลเรียบร้อย");
    }


    public function delete($id)
    {

        //ลบข้อมูล
        $delete = User::find($id)->delete();
        return redirect()->back()->with('success', "ลบเรียบร้อยแล้ว");

    }

     public function deleteAdmin($id)
    {

        //ลบข้อมูล
        $delete = Admin::find($id)->delete();
        return redirect()->back()->with('success', "ลบเรียบร้อยแล้ว");

    }
}
