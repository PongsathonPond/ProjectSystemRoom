<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Location Request Management System of RMUTI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap');
    </style>

    <style type="text/css" media="screen">
        [style*='Kanit'] {
            font-family: 'Kanit', sans-serif !important
        }
    </style>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            /*background: linear-gradient(135deg, #71b7e6, #9b59b6);*/
            background-color: #f8f8f8;
            font-family: "Kanit", sans-serif;
        }

        .icon {
            text-align: center;
            margin-top: 37px;
        }

        .icon-title {
            font-family: "Kanit", sans-serif;
            font-style: normal;
            font-weight: 200;
            font-size: 15px;
            text-align: center;
            color: #6a6d6d;
        }

        .title {
            font-family: "Kanit", sans-serif;
            font-style: normal;
            font-weight: 400;
            font-size: 24px;
            text-align: center;
            color: #6a6d6d;
            margin-bottom: 30px;
        }

        .container {
            max-width: 664px;
            width: 100%;
            background-color: white;
            margin: 0 auto;
            padding: 30px 37px 37px 37px;
            border-radius: 18px;
        }

        .text {
            font-family: "Kanit", sans-serif;
            font-style: normal;
            font-weight: 300;
            font-size: 16px;
            text-align: left;
            color: #6a6d6d;
            background-color: white;
            border: none;
            width: 100%;
            border-radius: 7px;
            /*border: 1px solid hotpink;*/
        }

        .approve {
            font-family: "Kanit", sans-serif;
            font-style: normal;
            text-align: center;
            font-weight: 400;
            font-size: 16px;
            color: white;
            background: #5bb084;
            width: 100%;
            height: 35px;
            border: none;
            border-radius: 7px;
            margin-top: 8px;
        }

        .notapproved {
            font-family: "Kanit", sans-serif;
            font-style: normal;
            text-align: center;
            font-weight: 400;
            font-size: 16px;
            color: white;
            background: #ed9c17;
            width: 100%;
            height: 35px;
            border: none;
            border-radius: 7px;
            margin-top: 8px;
        }

        .end {
            font-family: "Kanit", sans-serif;
            font-style: normal;
            font-size: 16px;
            text-align: center;
            color: #5bb084;
            margin-top: 40px;
        }

        .the-end {
            font-family: "Kanit", sans-serif;
            font-style: normal;
            font-size: 15px;
            font-weight: 200;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="icon"><img src="https://sv1.picz.in.th/images/2022/08/13/XHBAZZ.png"
            style="width: 120px; height: 155px" /></div>
    <div class="icon-title">Location Request Management System of RMUTI</div>
    <div class="title">แบบฟอร์มตอบกลับคำร้องขอใช้สถานที่ มทร.อีสาน</div>
    <div class="container">
        <form>
            <div>
                <p style="color: #5bb084">ชื่อรายการจอง</p>
                <button class="text">{{ $head }}</button>
            </div>
            <br>
            <div>
                <p style="color: #5bb084">ชื่อสถานที่</p>
                <button class="text">{{ $location }}</button>
            </div>
            <br>
            <div>
                <p style="color: #5bb084">วันที่-เวลาในการจองขอใช้สถานที่</p>
                <button class="text">{{ $start }} - {{ $end }}</button>
            </div>
            <br>


            <div>

                <p style="color: #5bb084">สาเหตุในการไม่อนุมัติการขอใช้สถานที่</p>
                <button class="text">{{ $test }}</button>
            </div>

            <br>
            <div>
                <p style="color: #5bb084">สถานะคำร้องขอใช้สถานที่</p>
                <button class="notapproved">ไม่ผ่านการอนุมัติ</button>
            </div>

        </form>
    </div>
    <div class="end">มหาวิทยาลัยเทคโนโลยีราชมงคลอีสาน</div>
    <div class="the-end">
        <p>Rajamangala University of Technology lsan ,RMUTI</p>
        <p>744 ถ.สุรนารายณ์ ต.ในเมือง อ.เมืองนครราชสีมา จ.นครราชสีมา 30000</p>
    </div>
</body>

</html>
