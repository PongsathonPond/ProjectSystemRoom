<?php

namespace App\Http\Controllers;

use App\Models\BookingList;
use Illuminate\Http\Request;

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
        $dataNew = BookingList::Where('status', '1')->paginate(10);
        return view('page.staff.history.index', compact('dataOld', 'dataNew'));
    }

    public function index4(Request $request)
    {

        $dataOld = BookingList::Where('status', '0')->orWhere('status', '2')->paginate(10);
        $dataNew = BookingList::Where('status', '1')->paginate(10);
        return view('page.staff.history.index2', compact('dataOld', 'dataNew'));
    }

}
