@extends('layouts.app')

@section('title', 'Home')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Home</li>
    </ol>
@endsection

@section('content')
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
                            <div class="font-weight-bold " style='color: #fff;'><h2><b>{{$master}}</b></h2></div>

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
                            <div class="font-weight-bold " style='color: #fff;'><h2><b>{{ $devices }}</b></h2></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">




            <div class="col-lg-12">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4">
                                <b>All Tests Run</b>

                            </div>
                            <div class="col-lg-4 justify-content-center">
                                <span style='text-align: center; display: block; width: 100%;'>Passed: <b id='numAllTestsP'>-</b></span>

                            </div>
                            <div class="col-lg-4 justify-content-center">
                                <span style='text-align: center; display: block; width: 100%;'>Failed: <b id='numAllTestsF'>-</b></span>


                            </div>
                        </div>

                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="chart-container" style="position: relative; height:auto; width:280px">
                            <canvas id="testChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row mb-4">


<div class="col-lg-6">
    <div class="card border-0 shadow-sm h-100">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4">
                    <b>Weekly Tests Run</b>

                </div>
                <div class="col-lg-4 justify-content-center">
                    <span style='text-align: center; display: block; width: 100%;'>Passed: <b id='weeklyTestsP'>-</b></span>

                </div>
                <div class="col-lg-4 justify-content-center">
                    <span style='text-align: center; display: block; width: 100%;'>Failed: <b id='weeklyTestsF'>-</b></span>


                </div>
            </div>
        </div>
        <div class="card-body d-flex justify-content-center">
            <div class="chart-container" style="position: relative; height:auto; width:280px">
                <canvas id="wtestChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="card border-0 shadow-sm h-100">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4">
                    <b>Monthly Tests Run</b>

                </div>
                <div class="col-lg-4 justify-content-center">
                    <span style='text-align: center; display: block; width: 100%;'>Passed: <b id='monthlyTestsP'>-</b></span>

                </div>
                <div class="col-lg-4 justify-content-center">
                    <span style='text-align: center; display: block; width: 100%;'>Failed: <b id='monthlyTestsF'>-</b></span>


                </div>
            </div>
        </div>
        <div class="card-body d-flex justify-content-center">
            <div class="chart-container" style="position: relative; height:auto; width:280px">
                <canvas id="mtestChart"></canvas>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row mb-4">


<div class="col-lg-6">
    <div class="card border-0 shadow-sm h-100">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4">
                    <b>Bi-Annual Tests Run</b>

                </div>
                <div class="col-lg-4 justify-content-center">
                    <span style='text-align: center; display: block; width: 100%;'>Passed: <b id='bannualTestsP'>-</b></span>

                </div>
                <div class="col-lg-4 justify-content-center">
                    <span style='text-align: center; display: block; width: 100%;'>Failed: <b id='bannualTestsF'>-</b></span>


                </div>
            </div>
        </div>
        <div class="card-body d-flex justify-content-center">
            <div class="chart-container" style="position: relative; height:auto; width:280px">
                <canvas id="bitestChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="card border-0 shadow-sm h-100">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4">
                    <b>Annual Tests Run</b>

                </div>
                <div class="col-lg-4 justify-content-center">
                    <span style='text-align: center; display: block; width: 100%;'>Passed: <b id='annualTestsP'>-</b></span>

                </div>
                <div class="col-lg-4 justify-content-center">
                    <span style='text-align: center; display: block; width: 100%;'>Failed: <b id='annualTestsF'>-</b></span>


                </div>
            </div>
        </div>
        <div class="card-body d-flex justify-content-center">
            <div class="chart-container" style="position: relative; height:auto; width:280px">
                <canvas id="antestChart"></canvas>
            </div>
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
@endsection

@push('page_scripts')
    <script src="{{ asset('js/chart-config.js') }}"></script>
@endpush
