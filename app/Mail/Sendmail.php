<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Sendmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $content, $head, $location, $start, $end, $status)
    {
        $this->name = $name;
        $this->content = $content;
        $this->head = $head;

        $this->location = $location;
        $this->start = $start;
        $this->end = $end;
        $this->status = $status;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {

        $test = $this->content;
        $head = $this->head;

        $location = $this->location;
        $start = $this->start;
        $end = $this->end;
        $status = $this->status;

        if ($this->status == 1) {

            return $this->from('from_email@gmail.com', 'RMUTI')->subject('รายงานการจองห้อง')->view('email', compact('head', 'location', 'start', 'end', 'status'))->with("name", $this->name);

        } else {
            return $this->from('from_email@gmail.com', 'RMUTI')->subject('รายงานการจองห้อง')->view('emailno', compact('test', 'head', 'location', 'start', 'end', 'status'))->with("name", $this->name);

        }

    }
}
