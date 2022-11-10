@extends('layouts.admin')
<script src="/../assets/js/plugins/chartjs.min.js" type="text/javascript"></script>

@section('content')
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


    <div class="containner" style="margin-top:4%">


                     <form action="{{route('admin-dashboard-se')}}" method="get"  >
                    <div class="row">
                        <div class="col-1">


                    <div class="form-group">
                        <label for="exampleFormControlSelect1">ค้นหาการขอ/การใช้</label>

                        @if($path == "2")
                            <select class="form-control"  name="test" id="gender">
                                <option value="2" >การขอใช้</option>
                                <option value="1" >การใช้</option>
                                <option value="0" >ทั้งหมด</option>

                            </select>
                        @elseif($path == "1")
                            <select class="form-control"  name="test" id="gender">
                                <option value="1" >การใช้</option>
                                <option value="2" >การขอใช้</option>
                                <option value="0" >ทั้งหมด</option>
                            </select>
                        @elseif($path == "0")
                            <select class="form-control"  name="test" id="gender">
                                <option value="0" >ทั้งหมด</option>
                                <option value="1" >การใช้</option>
                                <option value="2" >การขอใช้</option>
                            </select>
                        @endif

                    </div>
                        </div>
                        <div class="col-1">
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                    </div>
                        </div>
                </form>
        </div>
    </div>


    <div class="cotainer-fluid py-4">





        <body>



            <div class="ct-docs-main-container">
                <div class="ct-docs-main-content-row">
                    <div class="ct-docs-sidebar-col">

                        <div class="ct-docs-toc-col">

                        </div>
                        <main class="ct-docs-content-col" role="main">







                      


                         
                         

                            <div class="card mb-3">
                                <div class="card-header"> <h5>รายงานจำนวนการใช้งานแบ่งตามประเภท</h5></div>
                                <div class="card-body p-3">
                                   
                                    <div class="chart">
                                        <canvas id="bar-chart" class="chart-canvas" height="300px"></canvas>
                                    </div>
                                </div>
                            </div>
                      
                        

<div class="row">
    <div class="col-6">
     
        <div class="card mb-3">
            <div class="card-header"> <h5>ห้องที่ใช้มากที่สุด 5 อันดับแรก</h5></div>
            <div class="card-body p-3">
                <div class="chart">
                    <canvas id="doughnut-chart" class="chart-canvas" height="300px"></canvas>
                </div>
            </div>
        </div>
        <div class="position-relative">

        </div>

    </div>

    <div class="col-6">

        <div class="card mb-3">
            <div class="card-header"> <h5>รายงานรายได้แบ่งตามประเภท</h5></div>
            <div class="card-body p-3">
                
                <div class="chart">
                    <canvas id="pie-chart" class="chart-canvas" height="300px"></canvas>
                </div>
            </div>
        </div>
        <div class="position-relative">

        </div>

    </div>
</div>
                        </main>
                    </div>
                    <div class="ct-docs-main-footer-row">
                        <div class="ct-docs-main-footer-blank-col"></div>
                        <div class="ct-docs-main-footer-col">

                        </div>
                    </div>
                </div>


                <script type="text/javascript">
                    // Line chart
                    // Line chart with gradient
                    // Doughnut chart
                    var ctx3 = document.getElementById("doughnut-chart").getContext("2d");
                 
                    new Chart(ctx3, {
                        type: "doughnut",
                        data: {
                            labels: {!!json_encode($namelocation)!!},
                            datasets: [{
                                label: "Projects",
                                weight: 9,
                                cutout: 60,
                                tension: 0.9,
                                pointRadius: 2,
                                borderWidth: 2,
                                backgroundColor: [
                                    "#8D5EE4",
                                    "#5EB5E4",
                                    "#E48D5E",
                                    "#B5E45E",
                                    "#E4D05E"
                                ],
                                data: {!!json_encode($arrsum)!!},
                                fill: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: "index"
                            },
                            scales: {
                                y: {
                                    grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false
                                    },
                                    ticks: {
                                        display: false
                                    }
                                },
                                x: {
                                    grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false
                                    },
                                    ticks: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });

                    // Pie chart
                    var ctx4 = document.getElementById("pie-chart").getContext("2d");

                    new Chart(ctx4, {
                        type: "pie",
                        data: {
                            labels: ["กลางแจ้ง", "ห้องประชุม", "ห้องอเนกประสงค์"],
                            datasets: [{
                                label: "Projects",
                                weight: 9,
                                cutout: 0,
                                tension: 0.9,
                                pointRadius: 2,
                                borderWidth: 2,
                                backgroundColor: ["#5EB5E4", "#E48D5E", "#72E45E", "#a8b8d8"],
                                data: {!!json_encode($arrsumcoust)!!},
                                fill: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: "index"
                            },
                            scales: {
                                y: {
                                    grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false
                                    },
                                    ticks: {
                                        display: false
                                    }
                                },
                                x: {
                                    grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false
                                    },
                                    ticks: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });

                    // Bar chart
                    var ctx5 = document.getElementById("bar-chart").getContext("2d");

                    new Chart(ctx5, {
                        type: "bar",
                        data: {
                            labels: ["กลางแจ้ง", "ห้องประชุม", "ห้องอเนกประสงค์"],
                            datasets: [{
                                label: "ผู้ดูแลระบบ",
                                weight: 500,
                                borderWidth: 0,
                                borderRadius: 4,
                                backgroundColor: "#8D5EE4",
                                data:  {!!json_encode($arr4)!!},
                                fill: false,
                                maxBarThickness: 50
                            },{
                                label: "ผู้ดูแลสถานที่",
                                weight: 500,
                                borderWidth: 0,
                                borderRadius: 4,
                                backgroundColor: "#5EB5E4",
                                data: {!!json_encode($arr3)!!},
                                fill: false,
                                maxBarThickness: 50
                            },{
                                label: "ผู้ใช้ภายนอก",
                                weight: 500,
                                borderWidth: 0,
                                borderRadius: 4,
                                backgroundColor: "#E48D5E",
                                data: {!!json_encode($arr)!!},
                                fill: false,
                                maxBarThickness: 50
                        },{
                                label: "ผู้ใช้ภายใน",
                                weight: 500,
                                borderWidth: 0,
                                borderRadius: 4,
                                backgroundColor: "#B5E45E",
                                data: {!!json_encode($arr2)!!},
                                fill: false,
                                maxBarThickness: 50
                        }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true
                                }
                            },
                            scales: {
                                y: {
                                    grid: {
                                        drawBorder: false,
                                        display: true,
                                        drawOnChartArea: true,
                                        drawTicks: false,
                                        borderDash: [5, 5]
                                    },
                                    ticks: {
                                        display: true,
                                        padding: 5,
                                        color: "#9ca2b7"
                                    }
                                },
                                x: {
                                    grid: {
                                        drawBorder: false,
                                        display: true,
                                        drawOnChartArea: true,
                                        drawTicks: true
                                    },
                                    ticks: {
                                        display: true,
                                        color: "#9ca2b7",
                                        padding: 20
                                    }
                                }
                            }
                        }
                    });
                    // Mixed chart
                   
                    // Bubble chart
                                   </script>



            </div>


    </div>
    <div class="cotainer-fluid py-1">


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
                                            จำนวน</th>




                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($sumLocation as $item)
                                        <tr>

                                            <td class="align-middle text-center">

                                                <img src="{{ asset($item->location_image) }}" alt=""
                                                    width="60vh" height="60vh">

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
