@extends('layouts.admin')
<!DOCTYPE html>
<html lang="th">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

</head>
<style>
    #calendar {
        max-width: 1000px;
        margin: 16px auto;
        margin-top: 25px;
        height: 100%;
        padding: 0px 15px 0px 15px;

    }
</style>

</html>

@section('content')
    <div class="row">


        <div class="col-xl-4 ">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">รายชื่อห้อง</h5>
                </div>

                <div class="table-responsive" >

                    <div class="card-body">

                        <table class="table align-items-center" id="myTable">
                            <thead class="thead-light">
                            <tr>
                                <th class=" text-center text-xs font-weight-bolder" data-sort="name">รูป</th>
                                <th class=" text-center text-xs font-weight-bolder" data-sort="name">ชื่อห้อง</th>
                                <th class=" text-center text-xs font-weight-bolder" data-sort="name">จัดการ</th>
                            </tr>
                            </thead>
                            <tbody class="list">

                            <tr class="ss" align="center">
                                <td> ห้องทั้งหมด</td>

                                <td>
                                    ห้องทั้งหมด
                                </td>

                                <td> <a href="{{ url('/calendar/admin') }}" class=" btn btn-primary fas fa-eye"
                                        style="width: 80%;margin-left: 10% "> </a>
                                </td>

                            </tr>

                            @foreach ($location as $item)
                                <tr class="ss" align="center">

                                    <td> <img src="{{ asset($item->location_image) }}" alt="" width="60vh"
                                              height="60vh"></td>

                                    <td>
                                        {{ $item->location_name }}
                                    </td>

                                    <td> <a href="{{ url('/calendar/admin/' . $item->location_id) }}"
                                            class=" btn btn-primary fas fa-eye" style="width: 80%;margin-left: 10% "> </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>


                </div>

            </div>

        </div>




        <div class="col-xl-8">

            <div class="card">
                <div id='calendar'></div>
            </div>


            <div class="col-xl-12" style="margin-top: 4%">

                <div class="blogs">
                    <div class="row">
                        <div class="col-3">
                            <span class="badge" style="color: #92CD28;background-color: #92CD28;float: right;">อนุมัติแล้ว
                            </span>


                        </div>
                        <div class="col-3">
                            <span class="badge" style="color: #000000;">รายการจองได้รับการอนุมัติแล้ว </span>


                        </div>


                        <div class="col-3">
                            <span class="badge" style="color: #F78914;background-color: #F78914;float: right;">อนุมัติแล้ว
                            </span>


                        </div>
                        <div class="col-3">
                            <span class="badge" style="color: #000000;">รายการจองยังไม่ผ่านการอนุมัติ </span>


                        </div>

                    </div>
                </div>
            </div>
        </div>




    </div>


    {{-- modal --}}
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
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">ปิด</button>

                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                paging: false,
                responsive:true,
                ordering: false,
                info: false,
                "language": {
                    "search": "ค้นหา:",
                    "lengthMenu": "",
                    "zeroRecords": "ไม่พบข้อมูล - ขออภัย",
                    "info": '',
                    "infoEmpty": "ไม่มีข้อมูล",
                    "infoFiltered": "",
                    "paginate": ""
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            var SITEURL = "{{ url('/fullcalender') }}";
            var SITEURL2 = "{{ url('/fullcalenderadmin') }}";
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
                eventSources: [{
                    url: '/fullcalender',
                    color: '#92CD28'
                }, {
                    url: '/fullcalenderadmin',
                    color: '#F78914'

                }],


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
@endsection
