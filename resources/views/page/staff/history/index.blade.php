@extends('layouts.staff')
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>


@section('contentstaff')
    <div class="nav-wrapper position-relative end-0">
        <ul class="nav nav-pills nav-fill p-1">

            <li class="nav-item ">
                <a class="nav-link mb-0 px-0 py-1 btn btn-dark" href="{{ route('staff_history_index') }}">
                    การใช้
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 btn btn-dark " href="{{ route('staff_history_req') }}">
                    การขอใช้
                </a>
            </li>

        </ul>
    </div>

    <div class="row">
        <div class="col-12">





            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>ข้อมูลการใช้สถานที่</h6>
                </div>
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
                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        ชื่อผู้จอง</th>

                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        เวลาเริ่มต้น-สิ้นสุด</th>
                                    <th class="font-weight-bolder text-center text-xs" data-sort="name">
                                        สถานะ</th>


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
                                                @foreach ($item->booktoadmin as $item1)
                                                    {{ $item1->first_name }}
                                                    {{ $item1->last_name }}
                                                @endforeach
                                                @foreach ($item->booktoinsider as $item1)
                                                    {{ $item1->first_name }}
                                                    {{ $item1->last_name }}
                                                @endforeach
                                                @foreach ($item->booktostaff as $item1)
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
        </div>
    @endpush

@endsection
