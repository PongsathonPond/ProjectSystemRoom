@extends('layouts.staff')

@section('contentstaff')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <h2 class="text-lg mb-1 text-uppercase font-weight-bold">ผู้ใช้ทั้งหมดในระบบ</h2>


                                <h6 class="font-weight-bolder">
                                    @foreach ($countUser as $item)
                                        ผู้ใช้ภายนอก :{{ $item->total }} คน
                                    @endforeach

                                </h6>

                                <h6 class="font-weight-bolder">
                                    @foreach ($countStaff as $item)
                                        ผู้ใช้ภายใน :{{ $item->total }} คน
                                    @endforeach

                                </h6>

                                <h6 class="font-weight-bolder">
                                    @foreach ($countStaff as $item)
                                        ผู้ดูแลสถานที่ :{{ $item->total }} คน
                                    @endforeach
                                </h6>

                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <h2 class="text-lg mb-1 text-uppercase font-weight-bold">ห้องทั้งหมดในระบบ</h2>



                                <h6 class="font-weight-bolder">
                                    @foreach ($countLocation as $item)
                                        ห้องทั้งหมด :{{ $item->total }} ห้อง
                                    @endforeach
                                </h6>

                                <h6 class="font-weight-bolder">
                                    @foreach ($countLocation as $item)
                                        พร้อมใช้งาน :{{ $item->total }} ห้อง
                                    @endforeach
                                </h6>

                                <h6 class="font-weight-bolder">
                                    @foreach ($countLocation as $item)
                                        ไม่พร้อมใช้งาน :0 ห้อง
                                    @endforeach
                                </h6>

                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="fas fa-map-marked-alt text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">

                                <h2 class="text-lg mb-1 text-uppercase font-weight-bold">คำขอใช้ห้องทั้งหมด</h2>

                                <h6 class="font-weight-bolder">
                                    @foreach ($countRequest as $item)
                                        ทั้งหมด :{{ $item->total }} คำขอ
                                    @endforeach

                                </h6>
                                <h6 class="font-weight-bolder">
                                    @foreach ($countRequestNoPass as $item)
                                        รอการอนุมัติ :{{ $item->total }} คำขอ
                                    @endforeach

                                </h6>

                                <h6 class="font-weight-bolder">
                                    @foreach ($countRequestPass as $item)
                                        ผ่านการอนุมัติ :{{ $item->total }} คำขอ
                                    @endforeach

                                </h6>



                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="fas fa-paste text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">

                                <h2 class="text-lg mb-1 text-uppercase font-weight-bold">คำขอรอการประเมินราคา</h2>
                                <h6 class="font-weight-bolder">
                                    @foreach ($countRequest as $item)
                                        ทั้งหมด :{{ $item->total }} คำขอ
                                    @endforeach

                                </h6>
                                <h6 class="font-weight-bolder">
                                    @foreach ($countViceAdminPass as $item)
                                        ผ่านการประเมิน :{{ $item->total }} คำขอ
                                    @endforeach

                                </h6>

                                <h6 class="font-weight-bolder">


                                    @foreach ($countViceAdminNoPass as $item)
                                        รอการประเมิน :{{ $item->total }} คำขอ
                                    @endforeach
                                </h6>


                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fas fa-user-cog text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="cotainer-fluid py-4">


        <div class="row">


            <div class="col-xl-12 order-xl-1">

                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>สถิติการใช้ห้อง</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class=" text-center text-xs font-weight-bolder" data-sort="name">
                                            รูป</th>
                                        <th class=" text-center text-xs font-weight-bolder" data-sort="name">
                                            ชื่อห้อง</th>
                                        <th class=" text-center text-xs font-weight-bolder" data-sort="name">
                                            ลำดับ</th>




                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($sumLocation as $item)
                                        <tr>

                                            <td class="align-middle text-center">

                                                <img src="{{ asset($item->location_image) }}" alt="" width="60vh"
                                                    height="60vh">

                                            </td>

                                            <td class="align-middle text-center">
                                                {{ $item->location_name }}
                                            </td>


                                            <td class="align-middle text-center">
                                                {{ $item->total }}
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>



                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
