@extends('layouts.admin')
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<style type="text/css">
    a[disabled="disabled"] {
        pointer-events: none;
        text-decoration: line-through;
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
                                        ราคา</th>

                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        เวลาเริ่มต้น-สิ้นสุด</th>
                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        สถานะ</th>

                                    <th class="text-aa font-weight-bolder text-center text-xs" data-sort="name">
                                        จัดการ</th>
                                    <th class="text-aa font-weight-bolder text-center text-xs" data-sort="name" ">
                                                                    </th>
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

                                            @if ($item->project_cost == 'nil')
                                                <span class="badge badge-sm bg-danger">ยังไม่ผ่านการประเมิน</span>
                                            @else
                                                {{ $item->project_cost }} บาท
                                            @endif

                                        </td>



                                        <td class="text-center align-middle">

                                            {{ show_date($item->start) }}
                                            -
                                            {{ show_date($item->end) }}

                                        </td>

                                        <td class="text-center align-middle">

                                            @if ($item->status_cost == 1)
                                                <span class="badge badge-sm bg-success">อนุมัติเรียบร้อย</span>
                                            @elseif($item->status_cost == 0)
                                                <span class="badge badge-sm bg-primary">รอการอนุมัติ</span>
                                            @else
                                                <span class="badge badge-sm bg-danger">ไม่อนุมัติ</span>
                                            @endif
                                        </td>

                                        </td>



                                        <td>
                                            <div class="dropdown text-right">
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
                                                            data-bs-target="#exampleModal{{ $item->id }}" href="#"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="จัดการคำขอ">จัดการคำขอ
                                                        </a>
                                                    </li>




                                            </div>




                                            <!-- ModalEditUser -->
                                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                สถานะการอนุมัติ
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">


                                                            <form action="{{ url('/request/vice_admin/update/' . $item->id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf

                                                                <div class="pl-lg-4">
                                                                    <div class="row" style="text-align: left">



                                                                        <div class="col-6">

                                                                            <div class="form-group">
                                                                                <label>ราคา</label>

                                                                                @if ($item->project_cost == 'nil')
                                                                                    <input type="text" name="project_cost"
                                                                                        value="0" class="form-control" />
                                                                                @else
                                                                                    <input type="text" name="project_cost"
                                                                                        value="{{ $item->project_cost }}"
                                                                                        class="form-control" />
                                                                                @endif


                                                                            </div>
                                                                        </div>




                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label>ราคา</label>
                                                                                <select type="text " class="form-control"
                                                                                    name="status_cost">

                                                                                    <option value="0">
                                                                                        เลือกสถานะ</option>
                                                                                    <option value="1">อนุมัติ
                                                                                    </option>
                                                                                    <option value="2">
                                                                                        ไม่อนุมัติ
                                                                                    </option>


                                                                                </select>


                                                                            </div>
                                                                        </div>


                                                                        <br><br>
                                                                        <div class="test">

                                                                            ราคาปัจจุบัน:
                                                                            @if ($item->project_cost == 'nil')
                                                                                <span
                                                                                    class="badge bg-danger">รอการประเมิน</span>
                                                                            @elseif($item->project_cost > 1)
                                                                                <span
                                                                                    class="badge bg-success">{{ $item->project_cost }}
                                                                                    บาท</span>
                                                                            @else
                                                                                <span class="badge bg-success"> 0 บาท</span>
                                                                            @endif

                                                                        </div>

                                                                        <br>


                                                                        <br>

                                                                        <div class="test">

                                                                            สถานะปัจจุบัน:
                                                                            @if ($item->status_cost == 0)
                                                                                <span
                                                                                    class="badge bg-primary">รอการอนุมัติ</span>
                                                                            @elseif($item->status_cost == 1)
                                                                                <span
                                                                                    class="badge bg-success">อนุมัติเรียบร้อย</span>
                                                                            @else
                                                                                <span class="badge bg-danger">ไม่อนุมัติ</span>
                                                                            @endif

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

                                                                    <br>
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
                                            <!-- EndModal -->

                                        </td>
                                        <td>

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
                $(document).ready(function () {
                    $('#myTable').DataTable({
                        responsive:true,
                        paging: true,
                        lengthMenu: [ 10, 25, 50, 75, 100 ],
                        ordering: false,
                        info: false,
                        "language": {
                            "search": "ค้นหา:",
                            "zeroRecords": "ไม่พบข้อมูล - ขออภัย",
                            "info": '',
                            "infoEmpty": "ไม่มีข้อมูล",
                            "infoFiltered": "",
                            "lengthMenu": "  แสดง _MENU_ ข้อมูล",
                            "paginate": {
                                "previous": "กลับ",
                                "next": "ถัดไป"
                            }
                        }
                    });
                });
            </script>


            <script src="/../assets/js/core/popper.min.js"></script>
            <script src="/../assets/js/core/bootstrap.min.js"></script>

        </div>
    @endpush

@endsection
