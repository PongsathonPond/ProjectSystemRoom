@extends('layouts.admin')
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<style>
    ::-webkit-scrollbar-thumb:hover {
  background: #596cff;}
</style>
@section('content')
    <div class="row">
        <div class="col-xl-8 order-xl-1">
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

            @if (session('error'))
                    <script>
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'ไม่สามารถลบข้อมูลได้ เนื่องจากห้องมีการทำรายการจอง',
                            showConfirmButton: false,
                            timer: 5000
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
                        title: 'แก้ไขข้อมูลเรียบร้อย',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            @endif



            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>จัดการข้อมูลห้อง</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class=" text-center text-xs font-weight-bolder" data-sort="name">
                                        ลำดับ</th>
                                    <th class=" text-center text-xs font-weight-bolder" data-sort="name">
                                        รูป</th>
                                    <th class=" text-center text-xs font-weight-bolder" data-sort="name">
                                        ชื่อห้อง</th>
                                    <th class=" text-center text-xs font-weight-bolder" data-sort="name">
                                        อาคาร</th>

                                    <th class=" text-center text-xs font-weight-bolder" data-sort="name">
                                        ประเภท</th>
                                    <th class=" text-center text-xs font-weight-bolder" data-sort="name">
                                        ราคาครึ่งวัน</th>
                                    <th class=" text-center text-xs font-weight-bolder" data-sort="name">
                                        ราคาเต็มวัน</th>

                                    <th class=" text-center text-xs font-weight-bolder" data-sort="name">
                                        สถานะห้อง</th>

                                    <th class="text-center text-xs font-weight-bolder" data-sort="name">
                                        จัดการ</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($location as $row)
                                    <tr>

                                        <td class="align-middle text-center">
                                            {{ $location->firstItem() + $loop->index }} </td>
                                        <td class="align-middle text-center"> <img src="{{ asset($row->location_image) }}"
                                                alt="" width="60vh" height="60vh"></td>
                                        <td class="align-middle text-center">{{ $row->location_name }}</td>
                                        <td class="align-middle text-center">{{ $row->location_building }}</td>
                                        <td class="align-middle text-center">{{ $row->location_type }}</td>
                                        <td class="align-middle text-center">{{ $row->cost_halfday }}</td>
                                        <td class="align-middle text-center">{{ $row->cost_fullday }}</td>
                                        <td class="align-middle text-center">
                                         @if($row->status_location == 0)
                                                <span class="badge badge-sm bg-gradient-success">พร้อมใช้</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">ไม่พร้อมใช้</span>
                                            @endif


                                        </td>


                                        <td class="align-middle text-center">




                                            <!-- Button trigger modal -->
                                            <button type="button" class="fas fa-edit fa-lg btn btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $row->location_id }}">
                                            </button>

                                            <button type="button" class="fas fa-cogs fa-lg btn btn-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModaltest{{ $row->location_id }}">
                                            </button>

                                            <a href="{{ url('/locationmanage/delete/' . $row->location_id) }}"
                                                class="fas fa-trash-alt fa-lg btn btn-danger"
                                                onclick="return confirm('ลบหรือไม่ ?')"> </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $row->location_id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                แก้ไขข้อมูลห้อง
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">


                                                            <form
                                                                action="{{ url('/locationmanage/update/' . $row->location_id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf

                                                                <div class="pl-lg-4">
                                                                    <div class="row" style="text-align: left">
                                                                        <div class="col-lg-7">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label"
                                                                                    for="location_name">ชื่อห้อง</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="location_name"
                                                                                    value="{{ $row->location_name }}" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class=" col-lg-5">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label"
                                                                                    for="area">ที่ตั้ง
                                                                                </label>
                                                                                <input type="text" class="form-control"
                                                                                    name="area"
                                                                                    value="{{ $row->area }}" required>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label"
                                                                                    for="location_floor">ชั้น</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="location_floor"
                                                                                    value="{{ $row->location_floor }}" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label"
                                                                                    for="accommodate_people">ความจุ</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="accommodate_people"
                                                                                    value="{{ $row->accommodate_people }}" required>
                                                                                @error('accommodate_people')
                                                                                <div class="my-2">
                                                                                    <span class="text-danger my-2"> {{ $message }} </span>
                                                                                </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>



                                                                        <div class="col-lg-5">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label"
                                                                                    for="location_building">อาคาร</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="location_building"
                                                                                    value="{{ $row->location_building }}" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label"
                                                                                    for="cost_halfday">ราคาครึ่งวัน</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="cost_halfday"
                                                                                    value="{{ $row->cost_halfday }}" required>
                                                                                @error('cost_halfday')
                                                                                <div class="my-2">
                                                                                    <span class="text-danger my-2"> {{ $message }} </span>
                                                                                </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-lg-3">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label"
                                                                                    for="cost_fullday">ราคาเต็มวัน</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="cost_fullday"
                                                                                    value="{{ $row->cost_fullday }}" required>
                                                                                @error('cost_fullday')
                                                                                <div class="my-2">
                                                                                    <span class="text-danger my-2"> {{ $message }} </span>
                                                                                </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>



                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label"
                                                                                    for="location_type">ประเภท :

                                                                                    <span
                                                                                        class="badge badge-pill bg-gradient-primary">{{ $row->location_type }}</span>
                                                                                </label>
                                                                                <select type="text "
                                                                                    class="form-control "
                                                                                    name="location_type">

                                                                                    <option
                                                                                        value="{{ $row->location_type }}">
                                                                                        เลือกประเภท</option>
                                                                                    <option value="กลางแจ้ง">กลางแจ้ง
                                                                                    </option>
                                                                                    <option value="ห้องประชุม">
                                                                                        ห้องประชุม
                                                                                    </option>
                                                                                    <option value="ห้องอเนกประสงค์">
                                                                                        ห้องอเนกประสงค์</option>

                                                                                </select>
                                                                            </div>
                                                                        </div>



                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="exampleFormControlTextarea1">อุปกรณ์อื่นๆภายในห้อง</label>
                                                                            <input type="text" class="form-control"
                                                                                   name="other"
                                                                                   value="{{ $row->other }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label"
                                                                                    for="location_image">รูปภาพ</label>
                                                                                <input type="file" class="form-control"
                                                                                    name="location_image"
                                                                                    value="{{ $row->location_image }}">


                                                                                <br>
                                                                                <img src="{{ asset($row->location_image) }}"
                                                                                    style="margin-left: 25%"
                                                                                    alt="" width="200px"
                                                                                    height="200px">
                                                                            </div>

                                                                            <input type="hidden" name="old_image"
                                                                                value="{{ $row->location_image }}">

                                                                        </div>
                                                                    </div>





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

                                            <div class="modal fade" id="exampleModaltest{{ $row->location_id }}"
                                                 tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                แก้ไขข้อมูลห้อง
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">


                                                            <form
                                                                action="{{ url('/locationmanage/updatest/' . $row->location_id) }}"
                                                                method="post" >
                                                                @csrf

                                                                <div class="pl-lg-4">
                                                                    <div class="row" style="text-align: left">


                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label"
                                                                                       for="location_type">
                                                                                    ประเภท :

                                                                                    @if( $row->status_location == 0)
                                                                                        <span
                                                                                             style="color: #1e7e34">พร้อมใช้</span>
                                                                                    @else
                                                                                        <span
                                                                                            style="color: red">ไม่พร้อมใช้</span>
                                                                                        @endif

                                                                                </label>
                                                                                <select type="text "
                                                                                        class="form-control "
                                                                                        name="status_location">

                                                                                    <option
                                                                                        value="{{ $row->status_location  }}">
                                                                                        เลือกสถานะห้อง</option>
                                                                                    <option value="0">พร้อมใช้
                                                                                    </option>
                                                                                    <option value="1">
                                                                                        ไม่พร้อมใช้
                                                                                    </option>

                                                                                </select>
                                                                            </div>
                                                                        </div>



                                                                    </div>







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


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>



                    </div>

                </div>
                {{ $location->links() }}
            </div>


        </div>


        <div class="col-xl-4 order-xl-2">
            <div class="card ">
                <div class="card-header">
                    <h4>เพิ่มห้อง</h4>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <form action="{{ route('location-manage-add') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="location_name">ชื่อห้อง</label>
                                                    <input type="text" class="form-control" name="location_name" required >
                                                </div>
                                            </div>

                                            <div class=" col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="area">ที่ตั้ง
                                                    </label>
                                                    <input type="text" class="form-control" name="area" required>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="location_floor">ชั้น</label>
                                                    <input type="text" class="form-control" name="location_floor" required>
                                                </div>
                                            </div>



                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="location_building">อาคาร</label>
                                                    <input type="text" class="form-control" name="location_building" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                           for="accommodate_people">ความจุ</label>
                                                    <input type="text" class="form-control" name="accommodate_people" placeholder="ใส่ตัวเลขเท่านั้น" required>
                                                </div>
                                                @error('accommodate_people')
                                                <div class="my-2">
                                                    <span class="text-danger my-2"> {{ $message }} </span>
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="cost_halfday">ราคาครึ่งวัน</label>
                                                    <input type="text" class="form-control" name="cost_halfday" placeholder="ใส่ตัวเลขเท่านั้น" required>
                                                </div>
                                                @error('cost_fullday')
                                                <div class="my-2">
                                                    <span class="text-danger my-2"> {{ $message }} </span>
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="cost_fullday">ราคาเต็มวัน</label>
                                                    <input type="text" class="form-control" name="cost_fullday" placeholder="ใส่ตัวเลขเท่านั้น" required>
                                                </div>
                                                @error('cost_halfday')
                                                <div class="my-2">
                                                    <span class="text-danger my-2"> {{ $message }} </span>
                                                </div>
                                                @enderror
                                            </div>



                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="location_type">ประเภท</label>
                                                    <select type="text " class="form-control " name="location_type">

                                                        <option value="">
                                                            เลือกประเภท</option>
                                                        <option value="กลางแจ้ง">กลางแจ้ง</option>
                                                        <option value="ห้องประชุม">ห้องประชุม</option>
                                                        <option value="ห้องอเนกประสงค์">ห้องอเนกประสงค์</option>

                                                    </select>
                                                </div>
                                            </div>



                                        </div>


                                        <div class="row">
                                            <div class="col-lg">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="location_image">รูปภาพ</label>

                                                    <input type="file" class="form-control" name="location_image" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">อุปกรณ์อื่นๆภายในห้อง</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="other" placeholder="ไม่มีข้อมูลกรุณาใส่ - แทนค่าว่าง"></textarea>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                    <input type="submit" value="เพิ่ม" class="btn btn-success "
                                        style="margin-left: 40%">



                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>




    </div>
@endsection
