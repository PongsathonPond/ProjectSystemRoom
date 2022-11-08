<?php

namespace App\Http\Controllers;
use App\Models\BookingList;
use App\Jobs\CustomerJob;
use App\Mail\Sendmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public function sendEmail(Request $request)
    {

        $name['name'] = 'POND';
        $email['email'] = $request->email;
        $content['content'] = $request->content;
        $head['head'] = $request->head;
        $location['location'] = $request->location;
        $start['start'] = $request->start;
        $end['end'] = $request->end;
        $status['status'] = $request->status;

        dispatch(new CustomerJob(
            $email, $name, $content,
            $head, $location, $start,
            $end, $status));

        return redirect()->back()->with('ok', "ลบเรียบร้อยแล้ว");

    }

    public function sendEmailNew(Request $request,$id)
    {

        
         BookingList::find($id)->update([
            'status_email' => $request->status_email,
        ]);


        
        $name['name'] = 'POND';
        $email['email'] = $request->email;
        $content['content'] = $request->content;
        $head['head'] = $request->head;
        $location['location'] = $request->location;
        $start['start'] = $request->start;
        $end['end'] = $request->end;
        $status['status'] = $request->status;

       

        Mail::to($email['email'])->send(new Sendmail($name['name'],
            $content['content'],
            $head['head'],
            $location['location'],
            $start['start'],
            $end['end'],
            $status['status']

        )

        );

        
        return redirect()->back()->with('ok', "ลบเรียบร้อยแล้ว");

    }

}
