@extends('layouts.staff')
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

@section('contentstaff')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header">
                        <h4>เพิ่มรายการจอง</h4>
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{ route('booking-addstaff') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">ชื่อห้อง</label>
                                        <input class="form-control" type="text" value="{{ $location->location_name }}"
                                            readonly>
                                        <input type="hidden" name="location_id" value="{{ $location->location_id }}">
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
                                               class="form-control-label">เวลาเริ่มต้น</label>
                                        <input class="form-control" type="datetime-local" name="start"
                                               min="<?php echo date('Y-m-d H:i'); ?>" value="<?php echo date('Y-m-d H:i'); ?>"
                                               id="example-datetime-local-input">
                                    </div>
                                </div>






                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="example-datetime-local-input"
                                               class="form-control-label">เวลาสิ้นสุด</label>
                                        <input class="form-control" type="datetime-local" name="end"
                                               min="<?php echo date('Y-m-d H:i'); ?>" value="<?php echo date('Y-m-d H:i'); ?>"
                                               id="example-datetime-local-input">

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

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">หมายเหตุอื่นๆ</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="more"></textarea>
                                </div>
                            </div>
                            <br>
                            <input type="hidden" name="staff_id" value="null">
                            <input type="hidden" name="title" value="{{ $location->location_name }}">
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
                            events: SITEURL + "/fullcalender2/{{ $location->location_id }}",
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
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
