@extends('layouts.admin')
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<style type="text/css">
    a[disabled="disabled"] {
        pointer-events: none;
        text-decoration: line-through;
    }
</style>

@section('content')
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

    @if (session('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'ไม่สามารถลบข้อมูลได้ ต้องลบสถานที่รับผิดชอบออกก่อน',
                showConfirmButton: false,
                timer: 5000
            })
        </script>
    @endif

    <!-- Button trigger modal -->
    <button type="button" class="btn bg-gradient-success fa-solid fas fa-user-plus" data-bs-toggle="modal"
            data-bs-target="#STAFF">

    </button>

            <!-- Modal -->
    <div class="modal fade" id="STAFF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มผู้ดูแลสถานที่</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="handleAjax" action="{{ url('do-register') }}" name="postform">
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
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">REGISTER</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">


            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>จัดการข้อมูลผู้ใช้</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="align-items-center mb-0 table">
                            <thead>
                            <tr>
                                <th class="text-uppercase font-weight-bolder text-xs">
                                    ผู้ใช้
                                </th>
                                <th class="text-uppercase font-weight-bolder text-center text-xs">
                                    สถานะ
                                </th>
                                <th class="text-uppercase font-weight-bolder text-center text-xs">
                                    วันที่เพิ่ม
                                </th>

                                <th class="text-uppercase font-weight-bolder text-center text-xs">จัดการ
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($staff as $row)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">
                                                </h6>
                                                <p class="text-secondary mb-0 text-xs">{{ $row->email }}</p>
                                            </div>
                                        </div>
                                    </td>


                                    <td class="text-center align-middle">
                                        <span class="badge badge-sm bg-success">ปกติ</span>
                                    </td>

                                    <td class="text-center align-middle">
                                        {{ show_date($row->creatd_at) }}
                                    </td>


                                    <td class="text-center align-middle">


                                        <!-- Button trigger modal -->
                                        <button type="button" class="fas fa-edit fa-lg btn btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModalSignUp{{ $row->id }}">

                                        </button>

                                        <a href="{{ url('/manage/delete/' . $row->id) }}"
                                           class="fas fa-trash-alt fa-lg btn btn-danger"
                                           onclick="return confirm('ลบหรือไม่ ?')"> </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalSignUp{{ $row->id }}"
                                             tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <div class="card card-plain">
                                                            <div class="card-header pb-0 text-left">
                                                                <h3
                                                                        class="font-weight-bolder text-primary text-gradient">
                                                                    จัดการสถานที่รับผิดชอบ</h3>

                                                            </div>
                                                            <div class="card-body pb-3">

                                                                <div class="card ">
                                                                    <div class="card-header">
                                                                        <h4>สถานที่รับผิดชอบ</h4>
                                                                    </div>
                                                                    <div class="card-body pt-0">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div
                                                                                        class="card-profile-stats d-flex justify-content-center">
                                                                                    <div class="table-responsive p-0">
                                                                                        <table
                                                                                                class="align-items-center mb-0 table">
                                                                                            <thead>
                                                                                            <tr>
                                                                                                <th
                                                                                                        class="text-uppercase font-weight-bolder text-xs">
                                                                                                    ชื่อสถานที่
                                                                                                </th>

                                                                                                <th
                                                                                                        class="text-uppercase font-weight-bolder text-center text-xs">
                                                                                                    วันที่เพิ่ม
                                                                                                </th>


                                                                                                <th
                                                                                                        class="text-uppercase font-weight-bolder text-center text-xs">
                                                                                                    ลบข้อมูล
                                                                                                </th>

                                                                                            </tr>
                                                                                            </thead>
                                                                                            <tbody>

                                                                                            @php
                                                                                                $test =array();
                                                                                            @endphp

                                                                                            @foreach ($atten as $item)
                                                                                                @if ($row->id == $item->staff_id)
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            @foreach ($item->attentolo as $item1)
                                                                                                                {{ $item1->location_name }}
                                                                                                                @php
                                                                                                                    array_push($test,$item1->location_name);
                                                                                                                @endphp

                                                                                                            @endforeach


                                                                                                        </td>

                                                                                                        <td
                                                                                                                class="text-center align-middle">
                                                                                                            {{ show_date($row->creatd_at) }}
                                                                                                        </td>


                                                                                                        <td
                                                                                                                class="text-center align-middle">
                                                                                                            <a href="{{ url('/manage/deleteatten/' . $item->id) }}"
                                                                                                               class="fas fa-trash-alt fa-lg "
                                                                                                               onclick="return confirm('ลบหรือไม่ ?')">
                                                                                                            </a>

                                                                                                        </td>

                                                                                                    </tr>
                                                                                                @endif
                                                                                            @endforeach

                                                                                            </tbody>
                                                                                        </table>


                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                <br>

                                                                <form action="{{ route('addrole_staff') }}"
                                                                      method="post">
                                                                    @csrf
                                                                    <div class="row">


                                                                        <div class="col-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                        for="exampleFormControlInput1">รหัสผู้ดูแล
                                                                                </label>
                                                                                <input type="text" name="staff_id"
                                                                                       class="form-control"
                                                                                       value="{{ $row->id }}"
                                                                                       readonly>

                                                                                <input type="hidden"
                                                                                       name="attention_name"
                                                                                       class="form-control"
                                                                                       value="{{ $row->id }}"
                                                                                       readonly>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-6">

                                                                            <div class="form-group">
                                                                                <label
                                                                                        for="exampleFormControlSelect1">สถานที่</label>


                                                                                <select class="form-control"
                                                                                        name="location_id">


                                                                                    @foreach ($location as $item)
                                                                                            @if(!in_array($item->location_name,$test))
                                                                                                <option value="{{ $item->location_id }}" >
                                                                                                    {{ $item->location_name }}
                                                                                                </option>
                                                                                            @endif


                                                                                    @endforeach


                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="text-center">
                                                                        <button type="submit"
                                                                                class="btn bg-gradient-primary btn-lg btn-rounded mt-4 mb-0 w-80">
                                                                            บันทึก
                                                                        </button>


                                                                    </div>
                                                                    <br>
                                                                </form>


                                                            </div>
                                                        </div>
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
        });
    </script>


    <script src="/../assets/js/core/popper.min.js"></script>
    <script src="/../assets/js/core/bootstrap.min.js"></script>

    </div>
@endsection
