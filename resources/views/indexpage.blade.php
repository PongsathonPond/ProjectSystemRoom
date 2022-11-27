



<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="login/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="login/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="login/css/style.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Login </title>
</head>
<body>

@if (session('fail'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'ไอดีหรือรหัสผ่านผิด',
            showConfirmButton: true,
            timer: 2500
        })
    </script>
@endif
@php

    session_start();
    if (!empty($_SESSION['_login_info'])) {
        $test = json_encode($_SESSION['_login_info']);
        $obj = json_decode($test);
        if (!empty($obj)) {
            header('Location: https://lrm.rmuti.ac.th/indexuser');
            exit();
        }
    }



    Session::forget('id');
    Session::forget('email');
    Session::forget('student_id');
    Session::forget('title_name');
    Session::forget('first_name');
    Session::forget('last_name');

@endphp
<div class="d-md-flex half">
    <div class="bg" style="background-image: url('imglogin/bg_1.jpg');">

    </div>
    <div class="contents">

        <div class="container">
            <div class="row align-items-center justify-content-center">

                <div class="col-md-12">

                    <div class="form-block mx-auto">

                        <div class="text-center mb-5">
                            <h3 class="text-uppercase">เข้าสู่ระบบ <strong>บุคคลภายนอก</strong></h3>
                        </div>
                        <form method="POST" class="sign-in-form" action="{{ route('login_outsider') }}">
                            @csrf
                            <div class="form-group first">
                                <label for="username">Email</label>
                                <input type="text" class="form-control" placeholder="your-email@gmail.com" id="username" name="email">
                            </div>
                            <div class="form-group last mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Your Password" id="password"  name="password">
                            </div>

                            <div class="d-sm-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Remember me</span>
                                    <input type="checkbox" checked="checked"/>
                                    <div class="control__indicator"></div>
                                </label>
                                <span class="ml-auto"><a href="{{ route('register_outsider') }}" class="forgot-pass">สมัครสมาชิก</a></span>
                            </div>

                            <input type="submit" value="เข้าสู่ระบบ" class="btn btn-block py-2 btn-primary">

                            <span class="text-center my-3 d-block">หรือ</span>


                            <div class="">
                                @if(session('_previous.url')=="https://lrm.rmuti.ac.th")
                                    <a href="sso?sso" class="btn btn-block py-2 btn-facebook">
                                        <span class="icon-facebook mr-3"></span> เข้าสู่ระบบด้วยบัญชีมหาวิทยาลัย
                                    </a>
                                @else

                                @endif
                                    <a href="sso?sso" class="btn btn-block py-2 btn-facebook">
                                        <span class="icon-facebook mr-3"></span> เข้าสู่ระบบด้วยบัญชีมหาวิทยาลัย
                                    </a>
                                <a href="{{ route('adminlogin') }}" class="btn btn-block py-2 btn-google"><span class="icon-google mr-3"></span> สำหรับผู้ดูแลระบบ</a>
                                <a href="{{ route('stafflogin') }}" class="btn btn-block py-2 btn-google"><span class="icon-google mr-3"></span> สำหรับผู้ดูแลสถานที่</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>



<script src="login/js/jquery-3.3.1.min.js"></script>
<script src="login/js/popper.min.js"></script>
<script src="login/js/bootstrap.min.js"></script>
<script src="login/js/main.js"></script>
</body>
</html>
