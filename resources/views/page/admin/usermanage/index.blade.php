@extends('layouts.admin')

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

    @if (session('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'ไม่สามารถลบข้อมูลได้ เนื่องจากผู้ใช้มีการทำรายการจอง',
                showConfirmButton: false,
                timer: 5000
            })
        </script>
    @endif
    <button type="button" class="btn bg-gradient-success fa-solid fas fa-user-plus" data-bs-toggle="modal"
            data-bs-target="#ADMIN">

    </button>



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


            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1" id="tabs-icons-text-3-tab" data-bs-toggle="tab"
                   href="#tabs-icons-text-3" role="tab" aria-controls="code" aria-selected="false">
                    <i class="ni ni-laptop text-sm me-2"></i> ผู้ใช้ภายใน
                </a>
            </li>

        </ul>
    </div>


    <div class="card shadow">
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                     aria-labelledby="tabs-icons-text-1-tab">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
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
                                    <th class="text-uppercase font-weight-bolder text-center text-xs">
                                        จัดการ
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($admin as $row)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div
                                                        class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ $row->title_name }}
                                                        {{ $row->first_name }}
                                                        {{ $row->last_name }}</h6>
                                                    <p class="text-secondary mb-0 text-xs">
                                                        {{ $row->email }}</p>
                                                </div>
                                            </div>
                                        </td>


                                        <td class="text-center align-middle">
                                                                    <span
                                                                            class="badge badge-sm bg-gradient-success">ผู้ดูแลระบบ</span>
                                        </td>


                                        <td class="text-center align-middle">
                                                                    <span
                                                                            class="text-secondary font-weight-bold text-xs">{{ $row->created_at }}</span>
                                        </td>

                                        <td class="text-center align-middle">


                                            <button type="button" class="fas fa-edit fa-lg btn btn-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalSignUser{{ $row->id }}">

                                            </button>


                                            <a href="{{ url('/usermanage/deleteadmin/' . $row->id) }}"
                                               class="fas fa-trash-alt fa-lg btn btn-danger"
                                               onclick="return confirm('ลบหรือไม่ ?')"> </a>
                                            <!-- Modal -->
                                            <div class="modal fade"
                                                 id="exampleModalSignUser{{ $row->id }}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalSignTitle"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-md"
                                                     role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                            <div class="card card-plain">
                                                                <div class="card-header pb-0 text-left">
                                                                    <h3
                                                                            class="font-weight-bolder text-primary text-gradient">
                                                                        แก้ไขข้อมูล</h3>

                                                                </div>
                                                                <div class="card-body pb-3">
                                                                    <form role="form text-left"
                                                                          action="{{ url('/usermanage/updateadmin/'. $row->id) }}"
                                                                          method="post">
                                                                        @csrf

                                                                        <div class="row">

                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                            class="form-control-label"
                                                                                            for="first_name">ชื่อ
                                                                                    </label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="first_name"
                                                                                           value="{{ $row->first_name }}">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-3">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                            class="form-control-label"
                                                                                            for="last_name">นามสกุล</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="last_name"
                                                                                           value="{{ $row->last_name }}">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-5">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                            class="form-control-label"
                                                                                            for="email">อีเมล์</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           name="email"
                                                                                           value="{{ $row->email }}">
                                                                                </div>
                                                                            </div>


                                                                        </div>

                                                                        <br>

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
                                        </td>
                        </div>
                    </div>
                </div>
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="tab-pane fade " id="tabs-icons-text-2" role="tabpanel"
         aria-labelledby="tabs-icons-text-2-tab">
        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
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
                        <th class="text-uppercase font-weight-bolder text-center text-xs">
                            จัดการ
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $row)
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">
                                            {{ $row->title_name }} {{ $row->first_name }}
                                            {{ $row->last_name }}</h6>
                                        <p class="text-secondary mb-0 text-xs">{{ $row->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            @if ($row->role == 1)
                                <td class="text-center align-middle">
                                                            <span
                                                                    class="badge badge-sm bg-gradient-success">ผู้ดูแลระบบ</span>
                                </td>
                            @else
                                <td class="text-center align-middle">
                                    <span class="badge badge-sm bg-primary">ผู้ใช้ทั่วไป</span>
                                </td>
                            @endif


                            <td class="text-center align-middle">
                                                        <span
                                                                class="text-secondary font-weight-bold text-xs">{{ $row->created_at }}</span>
                            </td>

                            <td class="text-center align-middle">


                                <!-- Button trigger modal -->
                                <button type="button" class="fas fa-edit fa-lg btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleModalSignUp{{ $row->id }}">

                                </button>


                                <a href="{{ url('/usermanage/delete/' . $row->id) }}"
                                   class="fas fa-trash-alt fa-lg btn btn-danger"
                                   onclick="return confirm('ลบหรือไม่ ?')"> </a>
                                <!-- Modal -->
                                <div class="modal fade"
                                     id="exampleModalSignUp{{ $row->id }}" tabindex="-1"
                                     role="dialog" aria-labelledby="exampleModalSignTitle"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-md"
                                         role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card card-plain">
                                                    <div class="card-header pb-0 text-left">
                                                        <h3
                                                                class="font-weight-bolder text-primary text-gradient">
                                                            แก้ไขข้อมูล</h3>

                                                    </div>
                                                    <div class="card-body pb-3">
                                                        <form role="form text-left"
                                                              action="{{ url('/usermanage/update/' . $row->id) }}"
                                                              method="post">
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                                class="form-control-label"
                                                                                for="title_name">คำนำหน้า</label>
                                                                        <select type="text "
                                                                                class="form-control"
                                                                                name="title_name">

                                                                            <option
                                                                                    value="{{ $row->title_name }}">
                                                                                {{ $row->title_name }}
                                                                            </option>
                                                                            @if ($row->title_name == 'นางสาว')
                                                                                <option
                                                                                        value="นาย">
                                                                                    นาย
                                                                                </option>
                                                                            @else
                                                                                <option
                                                                                        value="นางสาว">
                                                                                    นางสาว
                                                                                </option>
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                                class="form-control-label"
                                                                                for="first_name">ชื่อ
                                                                        </label>
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               name="first_name"
                                                                               value="{{ $row->first_name }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                                class="form-control-label"
                                                                                for="last_name">นามสกุล</label>
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               name="last_name"
                                                                               value="{{ $row->last_name }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label
                                                                                class="form-control-label"
                                                                                for="email">อีเมล์</label>
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               name="email"
                                                                               value="{{ $row->email }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label
                                                                                class="form-control-label"
                                                                                for="phone_number">เบอร์โทร</label>
                                                                        <input type="text"
                                                                               class="form-control"
                                                                               name="phone_number"
                                                                               value="{{ $row->phone_number }}">
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <br>

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
    </div>



    </td>

    </tr>
    @endforeach
    </tbody>
    </table>
    </div>
    </div>

    </div>

    <div class="tab-pane fade " id="tabs-icons-text-3" role="tabpanel"
         aria-labelledby="tabs-icons-text-3-tab">
        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Technology</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs">John Michael</h6>
                                    <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">Manager</p>
                            <p class="text-xs text-secondary mb-0">Organization</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm badge-success">Online</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                        </td>
                        <td class="align-middle">
                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-3.jpg" class="avatar avatar-sm me-3">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs">Alexa Liras</h6>
                                    <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">Programator</p>
                            <p class="text-xs text-secondary mb-0">Developer</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm badge-secondary">Offline</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                        </td>
                        <td class="align-middle">
                            <a href="#!" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-4.jpg" class="avatar avatar-sm me-3">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs">Laurent Perrier</h6>
                                    <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">Executive</p>
                            <p class="text-xs text-secondary mb-0">Projects</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm badge-success">Online</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                        </td>
                        <td class="align-middle">
                            <a href="#!" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-3.jpg" class="avatar avatar-sm me-3">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs">Michael Levi</h6>
                                    <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">Programator</p>
                            <p class="text-xs text-secondary mb-0">Developer</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm badge-success">Online</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">24/12/08</span>
                        </td>
                        <td class="align-middle">
                            <a href="#!" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs">Richard Gran</h6>
                                    <p class="text-xs text-secondary mb-0">richard@creative-tim.com</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">Manager</p>
                            <p class="text-xs text-secondary mb-0">Executive</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm badge-secondary">Offline</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                        </td>
                        <td class="align-middle">
                            <a href="#!" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-4.jpg" class="avatar avatar-sm me-3">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs">Miriam Eric</h6>
                                    <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">Programtor</p>
                            <p class="text-xs text-secondary mb-0">Developer</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm badge-secondary">Offline</span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">14/09/20</span>
                        </td>
                        <td class="align-middle">
                            <a href="#!" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                Edit
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>

@endsection
