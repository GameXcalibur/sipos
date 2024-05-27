@extends('layouts.app')

@section('title', 'Home')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Home</li>
    </ol>
@endsection

@section('content')
<link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <div class="container-fluid">
       
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex  shadow-sm bg-gradient-success rounded-left rounded-right">
                        <div class="p-2  align-items-center" style='width: 12vmax''>
                            <img src="{{ asset('images') }}/Hub Icon.png" class="" style="width: 100%;" alt="" />

                        </div>
                        <div style='width: 100% !important; text-align: center !important; margin: auto;'>
                            <div class="font-weight-bold " style='color: #fff;'><h1>Hubs</h1></div>
                            <div class="font-weight-bold " style='color: #fff;'><h2><b>{{ $num_hubs }}</b></h2></div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex  shadow-sm bg-gradient-success rounded-left rounded-right">
                        <div class="p-2  align-items-center" style='width: 12vmax''>
                            <img src="{{ asset('images') }}/Master Icon.png" class="" style="width: 100%;" alt="" />

                        </div>
                        <div style='width: 100% !important; text-align: center !important; margin: auto;'>
                            <div class="font-weight-bold " style='color: #fff;'><h1>Master</h1></div>
                            <div class="font-weight-bold " style='color: #fff;'><h2><b>1</b></h2></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex  shadow-sm bg-gradient-success rounded-left rounded-right">
                        <div class="p-2  align-items-center" style='width: 12vmax''>
                            <img src="{{ asset('images') }}/Devices Icon.png" class="" style="width: 100%;" alt="" />

                        </div>
                        <div style='width: 100% !important; text-align: center !important; margin: auto;'>
                            <div class="font-weight-bold " style='color: #fff;'><h1>Devices</h1></div>
                            <div class="font-weight-bold " style='color: #fff;'><h2><b>{{ count($devices) }}</b></h2></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">




            <div class="col-lg-12">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                        All Reports Available
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <table id='datatables'>
                            <thead>
                                <th>SERIAL</th>
                                <th>TYPE</th>
                                
                                <th>NAME</th>
                                <th>RESULT</th>

                                <th>ACTION</th>

                            </thead>
                            <tbody>
                                @foreach ($tests as $test)
                                    <tr>
                                        <td>{{$test->deviceSerial}}</td>
                                        <td>{{$test->testType}}</td>
                                        <td>{{$test->extra1}}</td>
                                        <td>{{$test->testResult}}</td>

                                        <td><a href='#'>Download</a></td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>





        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header">
                        Monthly Device Stability (Offline Vs Online)
                    </div>
                    <div class="card-body">
                        <canvas id="paymentChart"></canvas>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
@endsection

@section('third_party_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
            integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap.min.js"></script>

@endsection

@push('page_scripts')
<script>
    new DataTable('#datatbles', {
    order: [[3, 'desc']]
});
    </script>
    <script src="{{ asset('js/chart-config.js') }}"></script>
@endpush
