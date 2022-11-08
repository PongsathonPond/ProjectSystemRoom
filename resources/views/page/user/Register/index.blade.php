

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Register
    </title>


    <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard" />

    <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 5 dashboard, bootstrap 5, css3 dashboard, bootstrap 5 admin, Argon Dashboard 2 bootstrap 5 dashboard, frontend, responsive bootstrap 5 dashboard, free dashboard, free admin dashboard, free bootstrap 5 admin dashboard">
    <meta name="description" content="Argon Dashboard 2 is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">

    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Argon Dashboard 2 by Creative Tim">
    <meta name="twitter:description" content="Argon Dashboard 2 is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/450/original/opt_sd_free_thumbnail.png">

    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Argon Dashboard 2 by Creative Tim" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="http://demos.creative-tim.com/argon-dashboard/examples/dashboard.html" />
    <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/450/original/opt_sd_free_thumbnail.png" />
    <meta property="og:description" content="Argon Dashboard 2 is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you." />
    <meta property="og:site_name" content="Creative Tim" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />

    <link id="pagestyle" href="../assets/css/argon-dashboard.min.css?v=2.0.4" rel="stylesheet" />

    <style>
        .async-hide {
            opacity: 0 !important
        }
    </style>



</head>
<body class="">


<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">

</nav>

<main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">ยินดีต้อนรับ</h1>
                    <p class="text-lead text-white">สมัครสมาชิกใหม่สำหรับผู้ใช้จากหน่วยงานภายนอก</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Register </h5>
                    </div>
                    <div class="row px-xl-5 px-sm-4 px-3">
                        <div class="col-3 ms-auto px-1">

                        </div>
                        <div class="col-3 ms-auto px-1">

                        </div>
                        <div class="col-3 ms-auto px-1">

                        </div>
                        <div class="mt-2 position-relative text-center">
                            <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">

                            </p>
                        </div>
                    </div>
                    @if ($errors->any())

                        <ul>
                            @foreach ($errors->all() as $error)

                                <span class="badge bg-gradient-danger">{{ $error }}</span>
                            @endforeach
                        </ul>

                    @endif
                    <div class="card-body">





                        <form method="POST" action="{{ route('registerUser') }}" role="form">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1">คำนำหน้า</label>
                                <select class="form-control" type="select" id="exampleFormControlSelect1" name="title_name" >
                                    <option value="นาย">นาย</option>
                                    <option value="นางสาว">นางสาว</option>

                                </select>

                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1">ชื่อ</label>
                                <input type="text" class="form-control" placeholder="ชื่อ" aria-label="ชื่อ" name="first_name">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1">นามสกุล</label>
                                <input type="text" class="form-control" placeholder="นามสกุล" aria-label="นามสกุล" name="last_name">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1">เบอร์โทร</label>
                                <input type="text" class="form-control" placeholder="0912345678" aria-label="0912345678" name="phone_number">
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1">Email</label>
                                <input type="email" class="form-control" placeholder="Email" :value="old('email')" name="email"
                                       required />
                                @error('password')
                                <div class="my-2">
                                    <span class="text-danger my-2"> {{ $message }} </span>
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1">Password</label>
                                <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password">

                            </div>



                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">สมัครสมาชิก</button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="footer py-5">
    <div class="container">
        <div class="row">


        </div>
        <div class="row">
            <div class="col-8 mx-auto text-center mt-1">
                <p class="mb-0 text-secondary">
                    Copyright © <script>
                        document.write(new Date().getFullYear())
                    </script> Soft by Creative Tim.
                </p>
            </div>
        </div>
    </div>
</footer>


<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>
</html>
