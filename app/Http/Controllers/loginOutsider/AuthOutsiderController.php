<?php

namespace App\Http\Controllers\loginOutsider;

use App\Http\Controllers\Controller;
use App\Models\BookingList;
use App\Models\Insiders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class AuthOutsiderController extends Controller
{

    public function index()
    {

        $booking = BookingList::all();
        session_start();
        if (!empty($_SESSION['_login_info'])) {
            $test = json_encode($_SESSION['_login_info']);
            $obj = json_decode($test);
            $userInfo = Insiders::where('email', '=', $obj->mail)->first();

            // create the validations
            if (!empty($userInfo)) //check all validations are fine, if not then redirect and show error messages
            {

                Session::put('id', $userInfo->id);
                Session::put('email', $userInfo->email);
                Session::put('student_id', $userInfo->student_id);
                Session::put('title_name', $userInfo->title_name);
                Session::put('first_name', $userInfo->first_name);
                Session::put('last_name', $userInfo->last_name);

                return view('page.user.routes.index', compact('booking'));
            } else {
                //validations are passed, save new user in database

                $User = new Insiders;
                $User->email = $obj->mail;
                if(empty($obj->studentId)){
                    $User->student_id = "null";
                }else{
                    $User->student_id = $obj->studentId;
                }
                $User->title_name = $obj->prename;
                $User->first_name = $obj->firstNameThai;
                $User->last_name = $obj->lastNameThai;
                $User->save();
                $userInfo = Insiders::where('email', '=', $obj->mail)->first();
                Session::put('id', $userInfo->id);
                Session::put('email', $userInfo->email);
                Session::put('student_id', $userInfo->student_id);
                Session::put('title_name', $userInfo->title_name);
                Session::put('first_name', $userInfo->first_name);
                Session::put('last_name', $userInfo->last_name);

                return view('page.user.routes.index', compact('booking'));

            }
        }

        // if (empty(session('id'))) {

        //     $userInfo = Insiders::where('email', '=', "admin@admin.com")->first();

        //     // create the validations
        //     if (!empty($userInfo)) //check all validations are fine, if not then redirect and show error messages
        //     {
        //         Session::put('id', 1);
        //         Session::put('email', "test@test.com");
        //         Session::put('first_name', "pond");
        //         Session::put('last_name', "1234");
        //         Session::put('student_id', "123411111");

        //         return view('page.user.routes.index', compact('booking'));
        //     } else {
        //         //validations are passed, save new user in database
        //         Session::put('id', 1);
        //         $User = new Insiders;
        //         $User->email = "admin@admin.com";
        //         $User->student_id = 1234567;
        //         $User->title_name = "123";
        //         $User->first_name = "123";
        //         $User->last_name = "123";
        //         $User->save();
        //         return view('page.user.routes.index', compact('booking'));

        //     }
        // }

        return view('page.user.routes.index', compact('booking'));
    }

    public function register()
    {
        return view('page.user.Register.index');

    }

    public function oldregister()
    {
        return view('page.user.Register.redirect');
    }

    public function doLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $userInfo = User::where('email', '=', $request->email)->first();

        if (!$userInfo) {
            return back()->with('fail', 'We do not recognize your email address');
        } else {
            //check password
            if (Hash::check($request->password, $userInfo->password)) {
                $data = $request->input();
                $request->session()->put('id', $userInfo->id);
                $request->session()->put('email', $data['email']);
                $request->session()->put('first_name', $userInfo->first_name);
                $request->session()->put('last_name', $userInfo->last_name);

                // return view('page.staff.routes.index');
                return redirect()->route('indexuser');
            } else {
                return back()->with('fail', 'Incorrect password');
            }
        }

    }

    public function doRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
            'first_name' => 'required', // required and email format validation
            'last_name' => 'required', // required and number field validation
            'email' => 'required|email|unique:users,email', // required and email format validation
            'password' => 'required|min:8', // required and number field validation

        ]);

        // create the validations
        if ($validator->fails()) //check all validations are fine, if not then redirect and show error messages
        {
            return back()->withInput()->withErrors($validator);
            // validation failed redirect back to form
        } else {
            //validations are passed, save new user in database

            $User = new User;
            $User->title_name = $request->title_name;
            $User->email = $request->email;
            $User->first_name = $request->first_name;
            $User->last_name = $request->last_name;
            $User->phone_number = $request->phone_number;
            $User->password = bcrypt($request->password);
            $User->save();

            return view('page.user.Register.redirect');

        }
    }
    // show dashboard

    // logout method to clear the sesson of logged in user
    public function logout()
    {
        \Auth::logout();
        return redirect("admin_login")->with('success', 'Logout successfully');
    }
}
