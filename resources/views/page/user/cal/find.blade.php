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

                        <form action="{{ route('cal-add') }}" method="post" enctype="multipart/form-data">
                            @csrf


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">ชื่อห้อง</label>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ $find->location_name }}" readonly>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">ที่ตั้ง</label>
                                        <input class="form-control" type="text" name="building"
                                            value="{{ $find->location_building }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">สถานะห้อง</label>
                                        <input class="form-control" type="text" value="พร้อมใช้" readonly>

                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-datetime-local-input"
                                            class="form-control-label">วันที่เริ่ม</label>
                                        <input class="form-control" type="datetime-local" name="start"
                                            id="example-datetime-local-input">
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="example-datetime-local-input"
                                            class="form-control-label">วันที่สิ้นสุด</label>
                                        <input class="form-control" type="datetime-local" name="end"
                                            id="example-datetime-local-input1">


                                    </div>


                                </div>
                                <input type="hidden" name="half" value="{{ $find->cost_halfday }}">
                                <input type="hidden" name="full" value="{{ $find->cost_fullday }}">

                                <input type="submit" value="เพิ่ม" class="btn btn-success ">


                        </form>






                    </div>
                    <br>



                </div>
            </div>



        </div>




    </div>


    <script>
        function calculate() {
            var field1 = document.getElementById("num1").value;
            var field = document.getElementById("num2").value;
            var result = parseFloat(field) - parseFloat(field1);

            if (!isNaN(result)) {
                document.getElementById("answer").value = result;


            }
        }
    </script>




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
