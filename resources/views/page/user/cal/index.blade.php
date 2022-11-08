@extends('layouts.user')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>



@section('contentuser')
    <div class="row">

        <div class="col-xl-5 ">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">รายชื่อห้อง</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center" id="myTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class=" text-center text-xs font-weight-bolder" data-sort="name">รูป</th>
                                    <th class=" text-center text-xs font-weight-bolder" data-sort="name">ชื่อห้อง</th>
                                    <th class=" text-center text-xs font-weight-bolder" data-sort="name">จัดการ</th>

                                </tr>
                            </thead>
                            <tbody class="list">

                                @foreach ($location as $item)
                                    <tr class="ss" align="center">

                                        <td> <img src="{{ asset($item->location_image) }}" alt="" width="60vh"
                                                height="60vh"></td>

                                        <td>
                                            {{ $item->location_name }}
                                        </td>

                                        <td> <a href="{{ url('/calculate/user/' . $item->location_id) }}"
                                                class=" btn btn-primary fas fa-eye" style="width: 80%;margin-left: 10% ">
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>

        </div>




        <div class="col-xl-7">

            <div class="card">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">คำนวณราคาเบื้องต้น</h5>
                    </div>
                    <div class="card-body">

                        <h3 style="text-align: center">กรุณาเลือกห้องเพื่อคำนวณราคา</h3>
                    </div>
                </div>



            </div>




        </div>






        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    paging: false,
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
    @endsection
