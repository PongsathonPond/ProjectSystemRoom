<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    {{-- <link rel="icon" type="image/png" href="../assets/img/favicon.png"> --}}
    <title>
        STAFF
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="/../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="/../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="/../assets/css/argon-dashboard.css?v=2.0.0" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-dark position-absolute w-100"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" #" target="_blank">
                {{-- <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Argon Dashboard 2</span> --}}
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">ผู้ดูแลสถานที่</h6>
                </li>

                @if (request()->routeIs('staff-dashboard'))
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('staff-dashboard') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Dashboard</span>


                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('staff-dashboard') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Dashboard</span>
                        </a>
                    </li>
                @endif


                @if (request()->routeIs('staff-request'))
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('staff-request') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">จัดการคำขอ</span>


                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('staff-request') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">จัดการคำขอ</span>
                        </a>
                    </li>
                @endif



                @if (request()->routeIs('staff-location'))
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('staff-location') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">จัดการสถานที่</span>


                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('staff-location') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">จัดการสถานที่</span>
                        </a>
                    </li>
                @endif



                @if (request()->routeIs('staff_history_index') || request()->routeIs('staff_history_req'))
                    <li class="nav-item">
                        <a class="nav-link bg-primary active" href="{{ route('staff_history_index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-book-medical text-white text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text  text-white ms-1">ประวัติการขอ/การใช้</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('staff_history_index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fas fa-book-medical text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">ประวัติการขอ/การใช้</span>
                        </a>
                    </li>
                @endif



                @if (request()->routeIs('add-bookingstaff'))
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('add-bookingstaff') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">เพิ่มการจอง</span>



                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('add-bookingstaff') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">เพิ่มการจอง</span>
                        </a>
                    </li>
                @endif





                @if (request()->routeIs('request-staff'))
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('request-staff') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">รายการจองของฉัน</span>



                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('request-staff') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">รายการจองของฉัน</span>
                        </a>
                    </li>
                @endif




            </ul>
        </div>
        <div class="sidenav-footer mx-3 ">
            <div class="card card-plain shadow-none" id="sidenavCard">

                <div class="card-body text-center p-3 w-100 pt-9">
                    <div class="docs-info">


                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class=" btn btn-dark btn-sm mb-0 w-100  " href="{{ route('logout') }}"
                    onclick="event.preventDefault();
            this.closest('form').submit();">
                    ออกจากระบบ
                </a>
            </form>

        </div>
    </aside>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">



                    {{-- navigation --}}
                    @if (request()->routeIs('user-manage'))
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                    href="javascript:;">Pages</a>
                            </li>
                            <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                                จัดการข้อมูลผู้ใช้


                            </li>
                        </ol>
                    @endif





                    @if (request()->routeIs('location-manage'))
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                    href="javascript:;">Pages</a>
                            </li>
                            <li class="breadcrumb-item text-sm text-white active" aria-current="page">จัดการข้อมูลห้อง
                            </li>
                        </ol>
                    @endif


                    {{-- navigation --}}

                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            {{-- <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Type here..."> --}}
                        </div>
                    </div>
                    <ul class="navbar-nav  justify-content-end">

                        <li class="nav-item d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">

                                <span class="d-sm-inline d-none">ข้อมูลผู้ใช้</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0">
                                <i class="fa fa-user fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        {{-- content --}}
        <div class="container-fluid py-4">


            @include('include.contentstaff')


        </div>
    </main>

    {{-- เมนู --}}
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"> </i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3 ">

                <div class="float-start">
                    <h5 class="mt-3 mb-0">ยินดีต้อนรับ</h5>
                    <br>
                    <p> {{ session('email') }}
                    </p>
                    <p>สถานะ:ผู้ดูแลสถานที่</p>

                </div>









                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0 overflow-auto">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">สีเมนู</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>


                <!-- Navbar Fixed -->

                <hr class="horizontal dark my-sm-4">
                <div class="mt-2 mb-5 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                            onclick="darkMode(this)">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- เมนู --}}




    <!--   Core JS Files   -->

    <script src="/../assets/js/core/popper.min.js"></script>
    <script src="/../assets/js/core/bootstrap.min.js"></script>
    <script src="/../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/../assets/js/plugins/chartjs.min.js"></script>


    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.0"></script>

    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script> --}}

    @stack('js')
</body>

</html>
