@extends('layouts.admin')
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<style type="text/css">
    a[disabled="disabled"] {
        pointer-events: none;
        text-decoration: line-through;
        
    }

::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}



::-webkit-scrollbar-thumb {
  background: #5E72E4;
  border-radius: 7px;
}



</style>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>


@section('content')

    <div class="row">
        <div class="col-xl-12 order-xl-1">


            @if (session('success'))
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'บันทึกข้อมูลเรียบร้อย',
                        showConfirmButton: false,
                        timer: 1500
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

            @if (session('ok'))
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'ส่งอีเมล์เรียบร้อย',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            @endif


            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>จัดการข้อมูลการจอง</h4>
                </div>
                <br>
                <div class="card-body px-0 pt-0 pb-2">

                    <div class="table-responsive p-0">

                        <table class="align-items-center mb-0 table" id="myTable">
                            <thead>
                                <tr>
                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        ลำดับ</th>
                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        ชื่อรายการจอง</th>
                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        ห้อง</th>
                                    {{-- <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        ชื่อผู้จอง</th> --}}

                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        เวลาเริ่มต้น-สิ้นสุด</th>
                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        สถานะ</th>

                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        จัดการ</th>


                                </tr>
                            </thead>
                            @push('js')
                                <tbody>






                                    @foreach ($booking as $item)
                                        <tr>

                                            <td class="text-center align-middle">{{ $booking->firstItem() + $loop->index }}
                                            </td>
                                            <td class="text-center align-middle">
                                                {{ $item->project_name }}
                                            </td>
                                            <td class="text-center align-middle">

                                                @foreach ($item->booktolocation as $item1)
                                                    {{ $item1->location_name }}
                                                @endforeach




                                            </td>
                                            {{-- <td class="text-center align-middle">


                                            @foreach ($item->booktouser as $item1)
                                                {{ $item1->first_name }}
                                                {{ $item1->last_name }}
                                            @endforeach
                                        </td> --}}
                                            <td class="text-center align-middle">

                                                {{ show_date($item->start) }}
                                                -
                                                {{ show_date($item->end) }}

                                            </td>

                                            <td class="text-center align-middle">

                                                @if ($item->status == 1)
                                                    <span class="badge badge-sm bg-success">อนุมัติเรียบร้อย</span>
                                                @elseif($item->status == 0)
                                                    <span class="badge badge-sm bg-primary">รอการอนุมัติ</span>
                                                @else
                                                    <span class="badge badge-sm bg-danger">ไม่อนุมัติ</span>
                                                @endif
                                            </td>





                                            <td class="text-center align-middle">
                                                <div class="dropdown text-center">
                                                    <button class="btn bg-gradient-primary dropdown-toggle fas fa-edit"
                                                        type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="จัดการข้อมูล" data-container="body" data-animation="true">

                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li><a class="dropdown-item text-center"
                                                                href="{{ asset($item->file_document) }}" target=" _blank"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="เอกสารบันทึกข้อความ">เอกสารบันทึกข้อความ</a>
                                                        </li>
                                                        <li><a class="dropdown-item text-center" data-bs-toggle="modal"
                                                                data-bs-target="#TestReq{{ $item->id }}" href="#"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="แก้ไขรายละเอียดการจอง">แก้ไขรายละเอียดการจอง
                                                            </a>
                                                        </li>

                                                        <li><a class="dropdown-item text-center" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal{{ $item->id }}" href="#"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="จัดการคำขอ">จัดการคำขอ
                                                            </a>
                                                        </li>


                                                        @if($item->status_email == 1)
                                                         <li ><a class="dropdown-item text-center disabled" data-bs-toggle="modal"
                                                                data-bs-target="#TestModal{{ $item->id }}" href="#"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="ส่งอีเมล์แจ้งเตือน" style="background-color: rgb(179, 242, 78)" >อีเมล์ได้รับการส่งแล้ว
                                                            </a>
                                                        </li>
                                                         @elseif($item->status_email == 0)
                                                         <li ><a class="dropdown-item text-center " data-bs-toggle="modal"
                                                                data-bs-target="#TestModal{{ $item->id }}" href="#"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="ส่งอีเมล์แจ้งเตือน"  >ส่งอีเมล์แจ้งเตือน
                                                            </a>
                                                        </li>
                                                        @endif
                                                       



                                                        <li><a class="dropdown-item text-center"
                                                                href="{{ url('/request/delete/' . $item->id) }} class="fas
                                                                fa-trash-alt fa-lg btn btn-danger"
                                                                onclick="return confirm('ลบหรือไม่ ?')" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="ลบข้อมูล" data-container="body"
                                                                data-animation="true"">ลบข้อมูล</a></li>
                                                    </ul>


                                                </div>








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





                        <!-- ModalEmail -->
                        <div class="modal fade" id="TestModal{{ $item->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            ส่งอีเมล์แจ้งสถานะ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('/sendmail/update/'. $item->id) }}" method="post">
                                            
                                            @csrf

                                            <div class="row">

                                                @if($item->status == 0)
                                                <h4 style="text-align: center">กรุณาทำรายการอนุมัติก่อนส่งเมล์</h4>
                                                @elseif($item->status == 2)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-datetime-local-input"
                                                            class="form-control-label">เหตุผลที่ไม่อนุมัติ</label>
                                                        <input type="text" class="form-control" name="content">

                                                    </div>
                                                </div>
                                                @endif
                                               



                                            </div>
                                            <input type="text" class="form-control" name="email" 
                                                value=@foreach ($item->booktouser as $item1) {{ $item1->email }} @endforeach
                                                @foreach ($item->booktoadmin as $item2) {{ $item2->email }} @endforeach >



                                            <input type="hidden" class="form-control" name="head"
                                                value="{{ $item->project_name }}">

                                            <input type="hidden" class="form-control" name="location"
                                                value=@foreach ($item->booktolocation as $item1) {{ $item1->location_name }} @endforeach>


                                            <input type="hidden" class="form-control" name="start"
                                                value="{{ show_date($item->start) }}">

                                            <input type="hidden" class="form-control" name="end"
                                                value="{{ show_date($item->end) }}">

                                            <input type="hidden" class="form-control" name="status"
                                                value="{{ $item->status }}">
                                            <input type="hidden" class="form-control" name="id"
                                                value="{{ $item->id }}">
                                                <input type="hidden" class="form-control" name="status_email"
                                                value="1">
                                            

                                            <br>
                                             @if($item->status == 0)
                                            <input type="submit" value="ไม่สามารถส่งเมล์ได้" class="btn btn-success "
                                            style="margin-left: 5%" disabled>
                                            @elseif($item->status !=0)
                                            <input type="submit" value="ส่งอีเมล์แจ้งเตือน" class="btn btn-success "
                                            style="margin-left: 5%" >
                                            @endif



                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- EndModalEmail -->


                        <!-- ModalEditUser -->
                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            สถานะการอนุมัติ
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">


                                        <form action="{{ url('/request/update/' . $item->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="pl-lg-4">
                                                <div class="row" style="text-align: left">

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="status">

                                                                <span class="badge badge-pill bg-gradient-primary"></span>
                                                            </label>
                                                            <select type="text " class="form-control" name="status">

                                                                <option value="0">
                                                                    เลือกสถานะ</option>
                                                                <option value="1">อนุมัติ
                                                                </option>
                                                                <option value="2">
                                                                    ไม่อนุมัติ
                                                                </option>


                                                            </select>

                                                            <br>
                                                            สถานะปัจจุบัน:
                                                            @if ($item->status == 0)
                                                                <span class="badge bg-primary">รอการอนุมัติ</span>
                                                            @elseif($item->status == 1)
                                                                <span class="badge bg-success">อนุมัติเรียบร้อย</span>
                                                            @else
                                                                <span class="badge bg-danger">ไม่อนุมัติ</span>
                                                            @endif
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
                                                    <button type="submit" class="btn bg-gradient-primary">บันทึก</button>
                                                    <button type="button" class="btn bg-gradient-secondary"
                                                        data-bs-dismiss="modal">ปิด</button>

                                                </div>
                                            </div>
                                        </form>






                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- EndModal -->

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


        <script src="/../assets/js/core/popper.min.js"></script>
        <script src="/../assets/js/core/bootstrap.min.js"></script>

        </div>
    @endpush

@endsection
