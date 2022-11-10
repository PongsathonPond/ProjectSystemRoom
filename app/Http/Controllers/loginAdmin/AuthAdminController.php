<?php

namespace App\Http\Controllers\loginAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthAdminController extends Controller
{

    public function LoginView()
    {
        return view("test.admin");
    }

    public function doLogin(Request $request)
    {

     

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $userInfo = Admin::where('email', '=', $request->email)->first();

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
                return redirect()->route('admin-dashboard');
                
            } else {
                return back()->with('fail', 'Incorrect password');
            }
        }

    }

    public function doRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required', // required and email format validation
            'last_name' => 'required', // required and number field validation
            'email' => 'required|email|unique:admins,email', // required and email format validation
            'password' => 'required|min:8', // required and number field validation

        ]); // create the validations
        if ($validator->fails()) //check all validations are fine, if not then redirect and show error messages
        {

            return back()->withInput()->withErrors($validator);
            // validation failed redirect back to form

        } else {
            //validations are passed, save new user in database
            $User = new Admin;
            $User->email = $request->email;
            $User->first_name = $request->first_name;
            $User->last_name = $request->last_name;

            $User->password = bcrypt($request->password);
            $User->save();

            return redirect("/usermanage")->with('success', 'You have successfully registered, Login to access your dashboard');
        }
    }
    // show dashboard

    public function dashboardse(Request $request)
    {

        $countUser = DB::table('users')->select(DB::raw('count(id) as total'))->get();
        $countStaff = DB::table('staff')->select(DB::raw('count(id) as total'))->get();
        $countLocation = DB::table('locations')->select(DB::raw('count(location_id) as total'))->get();

        $countRequest = DB::table('booking_lists')->select(DB::raw('count(id) as total'))->get();
        $countRequestPass = DB::table('booking_lists')->select(DB::raw('count(id) as total'))->where('status', 1)->get();
        $countRequestNoPass = DB::table('booking_lists')->select(DB::raw('count(id) as total'))->where('status', 0)->get();

        $countViceAdminPass = DB::table('booking_lists')->select(DB::raw('count(id) as total'))->where('status_cost', 1)->get();
        $countViceAdminNoPass = DB::table('booking_lists')->select(DB::raw('count(id) as total'))->where('status_cost', 0)->get();


        if($request->test == 2) {
            $path = $request->test;
            $sumLocation = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_name', 'locations.location_image', DB::raw('count(booking_lists.location_id) as total'))
                ->where('status','!=',1)
                ->groupBy('locations.location_name', 'locations.location_image')
                ->orderBy('total', 'desc')
                ->get();


            $arrsum = [];
            $namelocation = [];
            foreach ($sumLocation as $dashsum => $values) {
                $arrsum[] = $values->total;
                $namelocation[] = $values->location_name;
            }

            $sumProjectcost = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('sum(booking_lists.project_cost) as total'))
                ->where('status','!=',1)
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();

            $arrsumcoust = [];

            foreach ($sumProjectcost as $dashsum => $values) {
                $arrsumcoust[] = $values->total;

            }


            //user ภายในจอง
            $dash1 = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('count(booking_lists.user_id) as total'))
                ->where('status','!=',1)
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();

            $arr = [];
            foreach ($dash1 as $dashsum => $values) {
                $arr[] = $values->total;
            }


            //  ภายนอก

            $dash2 = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('count(booking_lists.insiders_id) as total'))
                ->where('status','!=',1)
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();


            $arr2 = [];
            foreach ($dash2 as $dashsum => $values) {
                $arr2[] = $values->total;
            }


            $dash3 = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('count(booking_lists.staff_id) as total'))
                ->where('status','!=',1)
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();


            $arr3 = [];
            foreach ($dash3 as $dashsum => $values) {
                $arr3[] = $values->total;
            }

            $dash4 = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('count(booking_lists.admin_id) as total'))
                ->where('status','!=',1)
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();


            $arr4 = [];
            foreach ($dash4 as $dashsum => $values) {
                $arr4[] = $values->total;
            }


            return view('page.admin.routes.index', compact('countUser',
                'countStaff',
                'countLocation',
                'countRequest',
                'countRequestPass',
                'countRequestNoPass',
                'countViceAdminPass',
                'countViceAdminNoPass',
                'sumLocation',
                'arr',
                'arr2',
                'arr3',
                'arr4',
                'arrsum',
                'namelocation',
                'arrsumcoust',
                'path'

            ));
        }
        if($request->test == 0) {
            $path = $request->test;
            $sumLocation = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_name', 'locations.location_image', DB::raw('count(booking_lists.location_id) as total'))
                ->groupBy('locations.location_name', 'locations.location_image')
                ->orderBy('total', 'desc')
                ->get();


            $arrsum = [];
            $namelocation = [];
            foreach ($sumLocation as $dashsum => $values) {
                $arrsum[] = $values->total;
                $namelocation[] = $values->location_name;
            }

            $sumProjectcost = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('sum(booking_lists.project_cost) as total'))
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();

            $arrsumcoust = [];

            foreach ($sumProjectcost as $dashsum => $values) {
                $arrsumcoust[] = $values->total;

            }


            //user ภายในจอง
            $dash1 = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('count(booking_lists.user_id) as total'))
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();

            $arr = [];
            foreach ($dash1 as $dashsum => $values) {
                $arr[] = $values->total;
            }


            //  ภายนอก

            $dash2 = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('count(booking_lists.insiders_id) as total'))
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();


            $arr2 = [];
            foreach ($dash2 as $dashsum => $values) {
                $arr2[] = $values->total;
            }


            $dash3 = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('count(booking_lists.staff_id) as total'))
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();


            $arr3 = [];
            foreach ($dash3 as $dashsum => $values) {
                $arr3[] = $values->total;
            }

            $dash4 = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('count(booking_lists.admin_id) as total'))
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();


            $arr4 = [];
            foreach ($dash4 as $dashsum => $values) {
                $arr4[] = $values->total;
            }


            return view('page.admin.routes.index', compact('countUser',
                'countStaff',
                'countLocation',
                'countRequest',
                'countRequestPass',
                'countRequestNoPass',
                'countViceAdminPass',
                'countViceAdminNoPass',
                'sumLocation',
                'arr',
                'arr2',
                'arr3',
                'arr4',
                'arrsum',
                'namelocation',
                'arrsumcoust',
                'path'

            ));
        }
        if($request->test == 1) {

            $path = $request->test;

            $sumLocation = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_name', 'locations.location_image', DB::raw('count(booking_lists.location_id) as total'))
                ->where('status',1)
                ->groupBy('locations.location_name', 'locations.location_image')
                ->orderBy('total', 'desc')
                ->get();


            $arrsum = [];
            $namelocation = [];
            foreach ($sumLocation as $dashsum => $values) {
                $arrsum[] = $values->total;
                $namelocation[] = $values->location_name;
            }

            $sumProjectcost = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('sum(booking_lists.project_cost) as total'))
                ->where('status',1)
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();

            $arrsumcoust = [];

            foreach ($sumProjectcost as $dashsum => $values) {
                $arrsumcoust[] = $values->total;

            }


            //user ภายในจอง
            $dash1 = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('count(booking_lists.user_id) as total'))
                ->where('status',1)
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();

            $arr = [];
            foreach ($dash1 as $dashsum => $values) {
                $arr[] = $values->total;
            }


            //  ภายนอก

            $dash2 = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('count(booking_lists.insiders_id) as total'))
                ->where('status',1)
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();


            $arr2 = [];
            foreach ($dash2 as $dashsum => $values) {
                $arr2[] = $values->total;
            }


            $dash3 = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('count(booking_lists.staff_id) as total'))
                ->where('status',1)
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();


            $arr3 = [];
            foreach ($dash3 as $dashsum => $values) {
                $arr3[] = $values->total;
            }

            $dash4 = DB::table('booking_lists')
                ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
                ->select('locations.location_type', DB::raw('count(booking_lists.admin_id) as total'))
                ->where('status',1)
                ->groupBy('locations.location_type')
                ->orderBy('locations.location_type')
                ->get();


            $arr4 = [];
            foreach ($dash4 as $dashsum => $values) {
                $arr4[] = $values->total;
            }


            return view('page.admin.routes.index', compact('countUser',
                'countStaff',
                'countLocation',
                'countRequest',
                'countRequestPass',
                'countRequestNoPass',
                'countViceAdminPass',
                'countViceAdminNoPass',
                'sumLocation',
                'arr',
                'arr2',
                'arr3',
                'arr4',
                'arrsum',
                'namelocation',
                'arrsumcoust',
                'path'

            ));
        }


    }

    public function dashboard(Request $request)
    {

      
        $countUser = DB::table('users')->select(DB::raw('count(id) as total'))->get();
        $countStaff = DB::table('staff')->select(DB::raw('count(id) as total'))->get();
        $countLocation = DB::table('locations')->select(DB::raw('count(location_id) as total'))->get();

        $countRequest = DB::table('booking_lists')->select(DB::raw('count(id) as total'))->get();
        $countRequestPass = DB::table('booking_lists')->select(DB::raw('count(id) as total'))->where('status', 1)->get();
        $countRequestNoPass = DB::table('booking_lists')->select(DB::raw('count(id) as total'))->where('status', 0)->get();

        $countViceAdminPass = DB::table('booking_lists')->select(DB::raw('count(id) as total'))->where('status_cost', 1)->get();
        $countViceAdminNoPass = DB::table('booking_lists')->select(DB::raw('count(id) as total'))->where('status_cost', 0)->get();

        $sumLocation = DB::table('booking_lists')
            ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
            ->select('locations.location_name', 'locations.location_image', DB::raw('count(booking_lists.location_id) as total'))
            ->groupBy('locations.location_name', 'locations.location_image')
            ->orderBy('total', 'desc')
            ->get();

            $path = 0;
            $arrsum=[];
            $namelocation=[];
            foreach($sumLocation as $dashsum => $values){
                $arrsum[]=$values->total;
                $namelocation[]=$values->location_name;
             }

             $sumProjectcost = DB::table('booking_lists')
             ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
             ->select('locations.location_type', DB::raw('sum(booking_lists.project_cost) as total'))
             ->groupBy('locations.location_type')
             ->orderBy('locations.location_type')
             ->get();
  
             $arrsumcoust=[];
          
             foreach($sumProjectcost as $dashsum => $values){
                 $arrsumcoust[]=$values->total;
                 
              }

              
    //user ภายในจอง
            $dash1 = DB::table('booking_lists')
            ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
            ->select('locations.location_type', DB::raw('count(booking_lists.user_id) as total'))
            ->groupBy('locations.location_type')
            ->orderBy('locations.location_type')
            ->get();
            
            $arr=[];
            foreach($dash1 as $dashsum => $values){
               $arr[]=$values->total;
            }
           

    //  ภายนอก
    
    $dash2 = DB::table('booking_lists')
    ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
    ->select('locations.location_type', DB::raw('count(booking_lists.insiders_id) as total'))
    ->groupBy('locations.location_type')
    ->orderBy('locations.location_type')
    ->get();
    
    
    $arr2=[];
    foreach($dash2 as $dashsum => $values){
       $arr2[]=$values->total;
    }


    $dash3 = DB::table('booking_lists')
    ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
    ->select('locations.location_type', DB::raw('count(booking_lists.staff_id) as total'))
    ->groupBy('locations.location_type')
    ->orderBy('locations.location_type')
    ->get();

    
    $arr3=[];
    foreach($dash3 as $dashsum => $values){
       $arr3[]=$values->total;
    }

    $dash4 = DB::table('booking_lists')
    ->join('locations', 'booking_lists.location_id', '=', 'locations.location_id')
    ->select('locations.location_type', DB::raw('count(booking_lists.admin_id) as total'))
    ->groupBy('locations.location_type')
    ->orderBy('locations.location_type')
    ->get();
   
    
    $arr4=[];
    foreach($dash4 as $dashsum => $values){
       $arr4[]=$values->total;
    }




        return view('page.admin.routes.index', compact('countUser',
            'countStaff',
            'countLocation',
            'countRequest',
            'countRequestPass',
            'countRequestNoPass',
            'countViceAdminPass',
            'countViceAdminNoPass',
            'sumLocation',
            'arr',
            'arr2',
            'arr3',
            'arr4',
            'arrsum',
            'namelocation',
            'arrsumcoust',
        'path'

        ));

    
    }

    // logout method to clear the sesson of logged in user
    public function logout()
    {
        \Auth::logout();
        return redirect("admin_login")->with('success', 'Logout successfully');
    }
}
