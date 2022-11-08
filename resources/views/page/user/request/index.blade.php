@extends('layouts.user')
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>


@section('contentuser')
    <div class="row">
        <div class="col-xl-12 order-xl-1">


            @if (session('success'))
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'โหลดข้อมูลเรียบร้อย',
                        showConfirmButton: false,
                        timer: 2500
                    })
                </script>
            @endif

            @if (session('delete'))
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'ลบข้อมูลเรียบร้อย',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            @endif

            @if (session('update'))
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'อัพเดทข้อมูลเรียบร้อย',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            @endif


            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>รายการจองของฉัน</h4>
                </div>
                <br>
                <div class="card-body px-0 pt-0 pb-2">

                    <div class="table-responsive p-0">
                        {{-- id="myTable" --}}
                        <table class="align-items-center mb-0 table">

                            <thead>
                                <tr>
                                    <th class="text-uppercase font-weight-bolder  text-center text-xs">
                                        ลำดับ
                                    </th>
                                    <th class="text-uppercase font-weight-bolder text-center text-xs">
                                        ชื่อรายการ</th>
                                    <th class="text-uppercase font-weight-bolder text-center text-xs">
                                        ชื่อสถานที่</th>
                                    <th class="text-uppercase font-weight-bolder text-center text-xs">
                                        วันที่ทำรายการจอง</th>
                                    <th class="text-uppercase font-weight-bolder text-center text-xs">สถานะการจอง </th>
                                    <th class="text-uppercase font-weight-bolder text-center text-xs">จัดการ
                                    </th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($booking as $item)
                                    <tr>
                                        <td class="text-center align-middle">
                                            {{ $booking->firstItem() + $loop->index }}
                                        </td>


                                        <td class="text-center align-middle">
                                            {{ $item->project_name }}
                                        </td>

                                        <td class="text-center align-middle">
                                            @foreach ($item->booktolocation as $item1)
                                                {{ $item1->location_name }}
                                            @endforeach
                                        </td>

                                        <td class="text-center align-middle">
                                            {{ show_date($item->created_at) }}


                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($item->status == 0)
                                                <span class="badge bg-secondary">รอการอนุมัติ</span>
                                            @elseif($item->status == 1)
                                                <span class="badge bg-success">อนุมัติเรียบร้อย</span>
                                            @else
                                                <span class="badge bg-danger">ไม่อนุมัติ</span>
                                            @endif
                                        </td>



                                        <td class="text-center align-middle">

                                            <a href="{{ url('/request/detail/' . $item->id) }}"
                                                class="btn btn-secondary fas fa-eye" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="รายละเอียดการจอง" data-container="body"
                                                data-animation="true">
                                            </a>



                                            <!-- Button trigger modal -->

                                            @if ($item->status == 1)
                                                <button type="button" class="fas fa-edit fa-lg btn btn-primary"
                                                    data-bs-toggle="modal" id="test"
                                                    data-bs-target="#TestReq{{ $item->id }}" disabled>

                                                </button>
                                            @else
                                                <button type="button" class="fas fa-edit fa-lg btn btn-primary"
                                                    data-bs-toggle="modal" id="test"
                                                    data-bs-target="#TestReq{{ $item->id }}">

                                                </button>
                                            @endif


                                            @if ($item->status == 1)
                                                <a href="" class="fas fa-trash-alt fa-lg btn btn-danger"
                                                    onclick="testdelete();"> </a>
                                            @else
                                                <a href="" class="fas fa-trash-alt fa-lg btn btn-danger"
                                                    onclick="return confirm('ยกเลิกการจอง ?')"> </a>
                                            @endif
                                            <!-- Modal -->
                                            <!-- ModalReq -->
                                            <div class="modal fade" id="TestReq{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                แก้ไขรายละเอียดการจอง</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/request/updatereq/' . $item->id) }}"
                                                                method="post">
                                                                @csrf

                                                                <div class="row" style="text-align: left">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label"
                                                                                for="location_id">ห้อง
                                                                            </label>
                                                                            <select type="text " class="form-control "
                                                                                name="location_id">

                                                                                <option value="{{ $item->location_id }}">
                                                                                    เลือกประเภท</option>

                                                                                @foreach ($location as $item1)
                                                                                    <option
                                                                                        value="{{ $item1->location_id }}">
                                                                                        {{ $item1->location_name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class=" col-lg-5">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label"
                                                                                for="project_name">ชื่อรายการจอง
                                                                            </label>
                                                                            <input type="text" class="form-control"
                                                                                name="project_name"
                                                                                value="{{ $item->project_name }}">
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="example-datetime-local-input"
                                                                                class="form-control-label">เวลาเริ่มต้น</label>
                                                                            <input class="form-control"
                                                                                type="datetime-local" name="start"
                                                                                value="{{ $item->start }}"
                                                                                id="example-datetime-local-input">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="example-datetime-local-input"
                                                                                class="form-control-label">เวลาสิ้นสุด</label>
                                                                            <input class="form-control"
                                                                                type="datetime-local" name="end"
                                                                                value="{{ $item->end }}"
                                                                                id="example-datetime-local-input">
                                                                        </div>
                                                                    </div>










                                                                </div>



                                                                @error('name')
                                                                    <div class="my-2">
                                                                        <span class="text-danger my-2">
                                                                            {{ $message }}
                                                                        </span>
                                                                    </div>
                                                                @enderror

                                                                @error('email')
                                                                    <div class="my-2">
                                                                        <span class="text-danger my-2">
                                                                            {{ $message }}
                                                                        </span>
                                                                    </div>
                                                                @enderror
                                                                <div class="ss">
                                                                    <button type="submit"
                                                                        class="btn bg-gradient-primary">บันทึก</button>
                                                                    <button type="button"
                                                                        class="btn bg-gradient-secondary"
                                                                        data-bs-dismiss="modal">ปิด</button>

                                                                </div>
                                                        </div>




                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                    </div>

                    <!-- EndModalReq -->

                </div>



                </td>

                </tr>
                @endforeach

                </tbody>

                </table>


            </div>

        </div>

    </div>
    {{ $booking->links() }}
    </div>



    </div>
    <script>
        function testdelete() {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'ไม่สามารถลบข้อมูลได้',
                showConfirmButton: true,

            })
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

        $(document).ready(function() {
            $('.step').each(function(index, element) {
                // element == this
                $(element).not('.active').addClass('done');
                $('.done').html('<i class="fas fa-check"></i>');
                if ($(this).is('.active')) {
                    return false;
                }
            });
        });
    </script>
@endsection
