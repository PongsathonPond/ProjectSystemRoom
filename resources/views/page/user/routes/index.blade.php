@extends('layouts.user')

<!DOCTYPE html>
<html lang="th">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

</head>
<style>
    * {
        font-family: 'Kanit', sans-serif;
        font-weight: 400;
    }

    #calendar {
        max-width: 1000px;
        margin: 0 auto;
        margin-top: 25px;
        height: 75vh;
        padding: 0px 15px 0px 15px;
    }
</style>

</html>

@section('contentuser')
 

    <div class="container-fluid">
        <div class="card shadow-sm mx-5">
            <div id='calendar'></div>
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
                    </span>
                    <br>
                    <span>เวลาเริ่ม-สิ้นสุด : <b> <span id="title"></b> </span>
                    </span>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
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
                    right: 'month,agendaWeek,agendaDay,dayGridMonth,timeGridWeek,timeGridDay,listMonth',
                },
                locale: "th",
                events: SITEURL + "/fullcalender",
                eventColor: '#F99C4A',
                eventTextColor: '#000000',

                lang: 'th',
                displayEventTime: false,
                editable: true,
                selectable: true,
                selectHelper: true,

                eventLimit: 5, // for all non-agenda views

                timezone: 'Asia/Bangkok',
                defaultDate: new Date(),
                contentHeight: 600,
                eventClick: function(calEvent, jsEvent, view) {
                    $.ajax({
                        type: 'get',
                        url: "{{ url('/booking') }}/" + calEvent.id,
                        success: function(respones) {

                            $('#project_name').text(respones.project_name);
                            $('#title').text(respones.title);
                        }

                    })
                    $('#exampleModal').modal("show");

                },
            });




        });
    </script>
@endsection
