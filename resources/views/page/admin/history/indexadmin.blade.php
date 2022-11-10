@extends('layouts.admin')
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'โหลดข้อมูลเรียบร้อย',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif





    <!-- Modal -->
    <div class="modal fade" id="ADMIN" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มผู้ดูแลระบบ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="handleAjax" action="{{ url('admin-do-register') }}" name="postform">
                        @csrf

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"/>

                                </div>
                            </div>
                            <div class="col-6">

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control"/>
                                    @error('password')
                                    <div class="my-2">
                                        <span class="text-danger my-2"> {{ $message }} </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-6">
                                <div class="form-group">
                                    <label>ชื่อ</label>
                                    <input type="text" name="first_name" class="form-control"/>

                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>นามสกุล</label>
                                    <input type="text" name="last_name" class="form-control"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">REGISTER</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


    <div class="nav-wrapper position-relative end-0">
        <ul class="nav nav-pills nav-fill p-1" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 active" id="tabs-icons-text-1-tab" data-bs-toggle="tab"
                   href="#tabs-icons-text-1" role="tab" aria-controls="preview" aria-selected="true">
                    <i class="ni ni-badge text-sm me-2"></i> ผู้ดูแลระบบ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1" id="tabs-icons-text-2-tab" data-bs-toggle="tab"
                   href="#tabs-icons-text-2" role="tab" aria-controls="code" aria-selected="false">
                    <i class="ni ni-laptop text-sm me-2"></i> ผู้ใช้ภายนอก
                </a>
            </li>


        </ul>
    </div>


    <div class="card shadow">
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                     aria-labelledby="tabs-icons-text-1-tab">
                    <div class="card-header pb-0">
                        <h6>ข้อมูลการขอใช้สถานที่</h6>
                    </div>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="myTable1">
                                <thead>
                                <tr>
                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        ลำดับ
                                    </th>
                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        ชื่อรายการจอง
                                    </th>
                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        ห้อง
                                    </th>
                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        ชื่อผู้จอง
                                    </th>

                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        เวลาเริ่มต้น-สิ้นสุด
                                    </th>
                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        สถานะ
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($dataOld as $item)
                                    <tr>

                                        <td class="text-center align-middle">{{ $dataOld->firstItem() + $loop->index }}
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
                                            @foreach ($item->booktouser as $item1)
                                                {{ $item1->first_name }}
                                                {{ $item1->last_name }}
                                            @endforeach


                                        </td>

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


                        </div>
                    </div>
                </div>


                </td>

                </tr>
                @endforeach


                                </tbody>
                            </table>
                        </div>
            {{ $dataOld->links() }}
                    </div>


                </div>

                <div class="tab-pane fade " id="tabs-icons-text-2" role="tabpanel"
                     aria-labelledby="tabs-icons-text-2-tab">

                    <div class="card-header pb-0">
                        <h6>ข้อมูลการใช้สถานที่</h6>
                    </div>

                                <div class="card">
                                    <div class="table-responsive p-0">
                                        <table class="align-items-center mb-0 table" id="myTable">
                                            <thead>
                                            <tr>
                                                <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                                    ลำดับ
                                                </th>
                                                <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                                    ชื่อรายการจอง
                                                </th>
                                                <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                                    ห้อง
                                                </th>
                                                <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                                    ชื่อผู้จอง
                                                </th>

                                                <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                                    เวลาเริ่มต้น-สิ้นสุด
                                                </th>
                                                <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                                    สถานะ
                                                </th>


                                            </tr>
                                            </thead>

                                            <tbody>
@push('js')
                                                @foreach ($dataNew as $item)
                                                    <tr>

                                                        <td class="text-center align-middle">{{ $dataNew->firstItem() + $loop->index }}
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
                                                            @foreach ($item->booktouser as $item1)
                                                                {{ $item1->first_name }}
                                                                {{ $item1->last_name }}
                                                            @endforeach


                                                        </td>

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


                                    </div>
                                </div>
                            </div>


                            </td>

                            </tr>
                            @endforeach


                            </tbody>

                            </table>


                        </div>

                    </div>
                    {{ $dataNew->links() }}




    </div>
    </div>
    </div>
    <script>
        $(document).ready(function () {
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
            $('#myTable1').DataTable({
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
    </div>

@endpush
@endsection
