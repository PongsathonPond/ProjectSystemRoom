<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Readerstacks laravel 8 Custom login and registration </title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" />
    <script type="text/javascript" src="index.js"></script>
    <style>
        .error {
            color: red !important
        }

        .dash {
            height: 400px;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            color: green;
            flex-direction: column;

        }
    </style>
</head>

<body class="antialiased">
    <div class="container">
        <!-- main app container -->
        <div class="readersack">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">

                        {{-- {{ dd(session()->all()) }} --}}

                        <!-- Show any success message -->
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif
                        <!-- Show any success message -->

                        <!-- Check user is logged in -->

                        <div class='dash'>You are logged in as : <br> Email :{{ session('email') }}
                            ID:{{ session('id') }}, <a href="{{ url('logout') }}"> Logout</a></div>


                        <!-- Check user is logged in -->
                    </div>
                </div>
            </div>
        </div>
        <!-- credits -->

    </div>

</body>

</html>
