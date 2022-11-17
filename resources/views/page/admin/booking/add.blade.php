@extends('layouts.admin')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">


            <div class="col-12">
                <div class="card ">
                    <div class="card-header">
                        <h4>เพิ่มรายการจอง</h4>

                    </div>
                    <div class="card-body pt-0">

                        <form action="{{ route('booking-addadmin') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">ชื่อห้อง</label>
                                        <input class="form-control" type="text" value="{{ $location->location_name }}"
                                            readonly>
                                        <input type="hidden" name="location_id" value="{{ $location->location_id }}">
                                        <input type="hidden" name="title" value="{{ $location->location_name }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">ชื่อรายการจอง</label>
                                        <input class="form-control" name="project_name" type="text">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">ชื่อหน่วยงาน</label>
                                        <input class="form-control" name="agency" type="text">
                                        <input type="hidden" name="club_name" value="null">
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-datetime-local-input"
                                            class="form-control-label">Datetime</label>
                                        <input class="form-control" type="datetime-local" name="start"
                                            value="2022-11-23T10:30:00" id="example-datetime-local-input">
                                    </div>
                                </div>






                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="example-datetime-local-input"
                                            class="form-control-label">Datetime</label>
                                        <input class="form-control" type="datetime-local" name="end"
                                            value="2022-11-23T10:30:00" id="example-datetime-local-input">


                                    </div>


                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="file_document">ไฟล์บันทึกข้อความ</label>

                                        <input type="file" class="form-control" name="file_document"
                                            accept="application/pdf">
                                    </div>

                                </div>

                            </div>
                            <br>
                            <input type="hidden" name="staff_id" value="null">
                            <input type="submit" value="เพิ่ม" class="btn btn-success ">
                        </form>

                    </div>


                </div>

            </div>

            <style>
                #calendar {
                    max-width: 1000px;
                    margin: 16px auto;
                    margin-top: 25px;
                    height: 100%;
                    padding: 0px 15px 0px 15px;
                }
            </style>


            <div class="col-md-12">


                <div class="container">
                    <div class="row">

                        <div class="col-md-12">
                            <br><br><br>

                            <div class="card">
                                <br>

                                <div id='calendar'>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการจอง</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <span>ชื่อรายการจอง : <b> <span id="project_name"> </b></span>

                                <br>
                                <span>ชื่อห้อง : <b> <span id="title"></b> </span>
                                <br>
                                <span>เวลาเริ่ม : <b> <span id="start"> </b> </span>
                                <br>
                                <span>เวลาสิ้นสุด : <b> <span id="end"> </b> </span>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn bg-gradient-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        var SITEURL = "{{ url('/') }}";
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var calendar = $('#calendar').fullCalendar({
                            editable: true,
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay,dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                                // right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
                            },
                            locale: "th",
                            events: SITEURL + "/fullcalender",
                            eventColor: '#378006',
                            eventTextColor: '#000000',
                            lang: 'th',
                            displayEventTime: false,
                            editable: true,
                            selectable: true,
                            selectHelper: true,
                            timezone: 'Asia/Bangkok',
                            defaultDate: new Date(),
                            contentHeight: 600,
                            eventClick: function(calEvent, jsEvent, view) {
                                $.ajax({
                                    type: 'get',
                                    url: "{{ url('/booking') }}/" + calEvent.id,
                                    success: function(respones) {
                                        var start = new Date(respones.start);

                                        var end = new Date(respones.end);

                                        var newstart = start.toLocaleString("th-TH", {
                                            timeZone: 'Asia/Bangkok',

                                        })

                                        var newend = end.toLocaleString("th-TH", {
                                            timeZone: "Asia/Bangkok"
                                        })
                                        $('#project_name').text(respones.project_name);
                                        $('#title').text(respones.title);
                                        $('#start').text(newstart);
                                        $('#end').text(newend);

                                    }

                                })
                                $('#exampleModal').modal("show");

                            }

                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
