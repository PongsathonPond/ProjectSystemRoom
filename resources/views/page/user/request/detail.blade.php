@extends('layouts.user')
<link href="{{ asset('/css/testcolor.css') }}" rel="stylesheet">

@section('contentuser')
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card mb-4">

                <div class="card-header pb-0">

                    <h4>รายละเอียดการจอง</h4>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <link
                        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
                        rel="stylesheet">

                    <section class="step-wizard">
                        <ul class="step-wizard-list">

                            @if ($booking->status_cost == 0 && $booking->status == 0)
                                <li class="step-wizard-item  ">
                                    <span class="progress-count">1</span>
                                    <span class="progress-label">กรอกข้อมูลผ่านแบบฟอร์ม</span>
                                </li>
                                <li class="step-wizard-item current-item  ">
                                    <span class="progress-count">2</span>
                                    <span class="progress-label">รอตรวจสอบจากฝ่ายสินทรัพย์</span>
                                </li>
                                <li class="step-wizard-item">
                                    <span class="progress-count">3</span>
                                    <span class="progress-label">รอตรวจสอบจากเจ้าของสถานที่</span>
                                </li>
                                <li class="step-wizard-item ">
                                    <span class="progress-count">4</span>
                                    <span class="progress-label">เสร็จสิ้น</span>
                                </li>
                            @elseif ($booking->status_cost == 1 && $booking->status == 0)
                                <li class="step-wizard-item  ">
                                    <span class="progress-count">1</span>
                                    <span class="progress-label">กรอกข้อมูลผ่านแบบฟอร์ม</span>
                                </li>
                                <li class="step-wizard-item">
                                    <span class="progress-count">2</span>
                                    <span class="progress-label">รอตรวจสอบจากฝ่ายสินทรัพย์</span>
                                </li>
                                <li class="step-wizard-item current-item">
                                    <span class="progress-count">3</span>
                                    <span class="progress-label">รอตรวจสอบจากเจ้าของสถานที่</span>
                                </li>
                                <li class="step-wizard-item ">
                                    <span class="progress-count">4</span>
                                    <span class="progress-label">เสร็จสิ้น</span>
                                </li>
                            @elseif ($booking->status_cost == 1 && $booking->status == 1)
                                <li class="step-wizard-item  ">
                                    <span class="progress-count">1</span>
                                    <span class="progress-label">กรอกข้อมูลผ่านแบบฟอร์ม</span>
                                </li>
                                <li class="step-wizard-item">
                                    <span class="progress-count">2</span>
                                    <span class="progress-label">รอตรวจสอบจากฝ่ายสินทรัพย์</span>
                                </li>
                                <li class="step-wizard-item ">
                                    <span class="progress-count">3</span>
                                    <span class="progress-label">รอตรวจสอบจากเจ้าของสถานที่</span>
                                </li>
                                <li class="step-wizard-item ">
                                    <span class="progress-count">4</span>
                                    <span class="progress-label">เสร็จสิ้น</span>
                                </li>
                            @elseif ($booking->status == 1)
                                <li class="step-wizard-item  ">
                                    <span class="progress-count">1</span>
                                    <span class="progress-label">กรอกข้อมูลผ่านแบบฟอร์ม</span>
                                </li>
                                <li class="step-wizard-item">
                                    <span class="progress-count">2</span>
                                    <span class="progress-label">รอตรวจสอบจากฝ่ายสินทรัพย์</span>
                                </li>
                                <li class="step-wizard-item ">
                                    <span class="progress-count">3</span>
                                    <span class="progress-label">รอตรวจสอบจากเจ้าของสถานที่</span>
                                </li>
                                <li class="step-wizard-item ">
                                    <span class="progress-count">4</span>
                                    <span class="progress-label">เสร็จสิ้น</span>
                                </li>
                            @elseif ($booking->status == 2)
                                <h2 style="color: red">รายการไม่ผ่านการอนุมัติ</h2>
                            @elseif ($booking->status_cost == 1 && $booking->status == 2)
                                <h2 style="color: red">รายการไม่ผ่านการอนุมัติ</h2>
                            @endif


                        </ul>
                    </section>


                </div>
            </div>



            <div class="col-xl-12 order-xl-1">
                <div class="card mb-4">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">

                                    @php
                                        
                                        foreach ($booking->booktouser as $item1) {
                                            $name1 = $item1->title_name;
                                            $name2 = $item1->first_name;
                                            $name3 = $item1->last_name;
                                        }
                                        
                                        foreach ($booking->booktoinsider as $item2) {
                                            $nameinsider = $item2->first_name;
                                        }
                                        
                                    @endphp

                                    <div class="pl-lg-4">
                                        <div class="row mt-4 ">

                                            <div class="col-lg-4 ">
                                                <div class="form-group">
                                                    <label class="form-control-label">ชื่อรายการจอง</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $booking->project_name }}" readonly>
                                                </div>
                                            </div>

                                            <div class=" col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="area">หน่วยงาน
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $booking->agency }}" readonly>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="cost_halfday">ชื่อผู้จอง</label>


                                                    @if (!empty(session('student_id')))
                                                        <input type="text" class="form-control" name="cost_halfday"
                                                            value={{ $nameinsider }} readonly>
                                                    @else
                                                        <input type="text" class="form-control" name="cost_halfday"
                                                            value={{ $name2 }} readonly>
                                                    @endif




                                                </div>
                                            </div>



                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="location_building">ห้องที่จอง</label>
                                                    <input type="text" class="form-control" name="location_building"
                                                        value=@foreach ($booking->booktolocation as $item1) {{ $item1->location_name }} @endforeach
                                                        readonly>
                                                </div>
                                            </div>


                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="location_floor">เวลาเริ่มต้น</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ show_date($booking->start) }}" readonly>

                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="accommodate_people">เวลาสิ้นสุด</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ show_date($booking->end) }}" readonly>
                                                </div>
                                            </div>




                                            {{-- @foreach ($booking->booktouser as $item1)
                                                {{ $item1->title_name }}
                                                {{ $item1->first_name }}
                                                {{ $item1->last_name }}
                                            @endforeach --}}








                                        </div>


                                        <div class="row">
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="location_image">รูปภาพ</label>



                                                </div>

                                                <div class="card">
                                                    <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                                        <a href="javascript:;" class="d-block">
                                                            @foreach ($booking->booktolocation as $item1)
                                                                <img src="{{ asset($item1->location_image) }}"
                                                                    alt="" class="img-fluid border-radius-lg">
                                                            @endforeach

                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="form-group">
                                            <label class="form-control-label" for="location_image">สถานะการจอง : </label>

                                            @if ($booking->status == 0)
                                                <span class="badge bg-secondary">รอการอนุมัติ</span>
                                            @elseif($booking->status == 1)
                                                <span class="badge bg-success">อนุมัติเรียบร้อย</span>
                                            @else
                                                <span class="badge bg-danger">ไม่อนุมัติ</span>
                                            @endif

                                        </div>

                                        <hr class="my-4" />
                                        <a href="{{ url()->previous() }}" class="btn btn-secondary  "
                                            style="float: left;"> <i class="fas fa-arrow-left"></i> กลับ</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        @endsection
