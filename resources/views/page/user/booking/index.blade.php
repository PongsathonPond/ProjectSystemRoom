@extends('layouts.user')

@section('contentuser')
    <div class="container-fluid mt--6">
        <div class="row">
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

            <div class="row">
                <div class="col-9"></div>
                <div class="col-3 justify-content-end mt--6">
                    <!-- Search -->
                    <form action="{{ route('search') }}" method="GET" class="d-md-flex ml-lg-auto">
                        <div class="form-group mb-0">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <input class="form-control" name="name" type="text"
                                            placeholder="ค้นหาจากชื่อ">
                                    </div>
                                </div>

                                <div class="col-2"><input type="submit" value="ค้นหา" class="btn btn-primary"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @foreach ($location as $item)
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                            <a href="javascript:;" class="d-block blur-shadow-image">
                                <img src="{{ asset($item->location_image) }}" class="img-fluid border-radius-lg">
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="w-50 mx-auto">

                            </div>
                            <a href="javascript:;" class="card-title h5 d-block text-darker">
                                {{ $item->location_name }}
                            </a>
                            <br>
                            <h6 class="fas fa-thumbtack"> &nbsp ประเภท: <span
                                    class="badge bg-gradient-warning">{{ $item->location_type }}</span> </h6>
                            <br>
                            <h6 class="fas fa-map-marker-alt"> &nbsp ที่ตั้ง: {{ $item->area }} </h6>
                            <br>
                            <h6 class="fas fa-user"> &nbsp ความจุ: {{ $item->accommodate_people }} คน </h6>
                            <br>
                            <h6 >อุปกรณ์ภายในห้อง: {{ $item->other }}  </h6>


                        </div>

                        <a href="{{ url('/addbooking/' . $item->location_id) }}" class=" btn btn-warning"
                            style="width: 80%;margin-left: 10% "> จองห้องนี้</a>


                        <!-- Modal -->

                    </div>
                </div>
            @endforeach
            {{-- @foreach ($booking as $item)
                <a href="{{ asset($item->file_document) }}" target=" _blank">Open the pdf!</a>
            @endforeach --}}
        @endsection
