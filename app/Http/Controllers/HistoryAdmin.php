<?php

namespace App\Http\Controllers;

use App\Models\BookingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HistoryAdmin extends Controller
{
    public function index(Request $request)
    {

        $dataOld = BookingList::Where('status', '0')->paginate(10);
        $dataNew = BookingList::Where('status', '1')->paginate(10);
        return view('page.admin.history.index', compact('dataOld', 'dataNew'));
    }

    public function indexuser(Request $request)
    {
        $dataOld = BookingList::Where('user_id', session('id'))->Where('status','!=',1)->paginate(10);
        $dataNew = BookingList::Where('user_id', session('id'))->Where('status', '1')->paginate(10);
        return view('page.user.history.index', compact('dataOld', 'dataNew'));
    }


    public function indexadmin(Request $request)
    {

        $dataOld = BookingList::Where('admin_id', session('id'))->Where('status','!=',1)->paginate(10);
        $dataNew = BookingList::Where('admin_id', session('id'))->Where('status', '1')->paginate(10);
        return view('page.admin.history.indexadmin', compact('dataOld', 'dataNew'));
    }

    public function index2(Request $request)
    {

        $dataOld = BookingList::Where('status', '0')->orWhere('status', '2')->paginate(10);
        $dataNew = BookingList::Where('status', '1')->paginate(10);
        return view('page.admin.history.index2', compact('dataOld', 'dataNew'));
    }

    public function index3(Request $request)
    {

        $dataOld = BookingList::Where('status', '0')->paginate(10);
//        $dataOld = DB::table('locations')
//            ->join('attentions', 'locations.location_id', 'attentions.location_id')
//            ->join('staff', 'staff.id', 'attentions.staff_id')
//            ->join('booking_lists', 'locations.location_id', '=', 'booking_lists.location_id')
//            ->where('staff.id', '=', session('id'))->where('status','!=',1)
//            ->select('locations.location_name', 'attentions.staff_id', 'staff.email','locations.location_image',DB::raw('count(booking_lists.location_id) as total'))
//            ->groupBy('locations.location_name', 'attentions.staff_id','staff.email','locations.location_image')
//            ->orderBy('total', 'desc')
//            ->paginate(10);



      $dataNew = BookingList::Where('status', '1')->paginate(10);



        return view('page.staff.history.index', compact('dataOld', 'dataNew'));
    }

    public function index4(Request $request)
    {


                $dataOld = DB::table('locations')

                     ->join('attentions', 'locations.location_id', 'attentions.location_id')
                     ->join('staff', 'staff.id', 'attentions.staff_id')
                    ->join('booking_lists', 'locations.location_id', '=', 'booking_lists.location_id')
                     ->where('staff.id', '=', session('id'))->where('status','!=',1)
                     ->select('locations.*', 'attentions.*', 'staff.email','booking_lists.*')
                     ->paginate(1000);

//        $dataOld = BookingList::Where('status', '0')->orWhere('status', '2')->paginate(10);
//        $dataNew = BookingList::Where('status', '1')->paginate(10);

        $dataNew = DB::table('locations')

            ->join('attentions', 'locations.location_id', 'attentions.location_id')
            ->join('staff', 'staff.id', 'attentions.staff_id')
            ->join('booking_lists', 'locations.location_id', '=', 'booking_lists.location_id')
            ->where('staff.id', '=', session('id'))->where('status','=',1)
            ->select('locations.*', 'attentions.*', 'staff.email','booking_lists.*')
            ->paginate(1000);
        return view('page.staff.history.index2', compact('dataOld', 'dataNew'));
    }

}
