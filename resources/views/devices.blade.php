@extends('layouts.app')

@section('title', 'Devices')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Devices</li>
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
                            <div class="font-weight-bold " style='color: #fff;'><h2><b>{{ count($devices) }}</b></h2></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-4">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <h1>HUBS</h1>
                    </div>

                </div>
                <div class="row">
                    @foreach ($hubs as $hub)
                    <div class="col-lg-3">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    <img src="{{ asset('images') }}/Hub Icon.png" class="" style="width: 100%;" alt="" />

                                </div>
                                <div style='width: 100% !important; text-align: laft !important; margin: auto;'>
                                    <div class="font-weight-bold " >Type: IntelliHub</div>
                                    <div class="font-weight-bold " >Name: {{$hub->hubName}}</div>
                                    <div class="font-weight-bold " >Serial: {{$hub->hubSerial}}</div>


                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>
        <hr>
        <div class="row mb-4">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <h1>MASTER</h1>
                    </div>

                </div>
                <div class="row">
                    @foreach ($devices as $device)
                    @if ($device->type != 'PROEM_MASTER')
                        @continue
                    @endif
                    <div class="col-lg-3">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    <img src="{{ asset('images') }}/Master Icon.png" class="" style="width: 100%;" alt="" />

                                </div>
                                <div style='width: 100% !important; text-align: laft !important; margin: auto;'>
                                    <div class="font-weight-bold " >Type: {{$device->type}}</div>
                                    <div class="font-weight-bold " >Name: {{$device->device_name}}</div>
                                    <div class="font-weight-bold " >Serial: {{$device->serial_no}}</div>
                                    <div class="font-weight-bold " >Parent Hub: {{$device->hub_serial_no}}</div>



                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>

        <hr>
        <div class="row mb-4">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <h1>EMERGENCY_LIGHT</h1>
                    </div>

                </div>
                <div class="row">
                    @foreach ($devices as $device)
                    @if ($device->type != 'EMERGENCY_LIGHT')
                        @continue
                    @endif
                    <div class="col-lg-3">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    <img src="{{ asset('images') }}/Pro-Em Icon.png" class="" style="width: 100%;" alt="" />

                                </div>
                                <div style='width: 100% !important; text-align: laft !important; margin: auto;'>
                                    <div class="font-weight-bold " >Type: {{$device->type}}</div>
                                    <div class="font-weight-bold " >Name: {{$device->device_name}}</div>
                                    <div class="font-weight-bold " >Serial: {{$device->serial_no}}</div>
                                    <div class="font-weight-bold " >Parent Hub: {{$device->hub_serial_no}}</div>



                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>

        <hr>
        <div class="row mb-4">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <h1>EMC Lite Maintained</h1>
                    </div>

                </div>
                <div class="row">
                    @foreach ($devices as $device)
                    @if ($device->type != 'EMC Lite Maintained')
                        @continue
                    @endif
                    <div class="col-lg-3">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    <img src="{{ asset('images') }}/Pro-Em Lite Icon.png" class="" style="width: 100%;" alt="" />

                                </div>
                                <div style='width: 100% !important; text-align: laft !important; margin: auto;'>
                                    <div class="font-weight-bold " >Type: {{$device->type}}</div>
                                    <div class="font-weight-bold " >Name: {{$device->device_name}}</div>
                                    <div class="font-weight-bold " >Serial: {{$device->serial_no}}</div>
                                    <div class="font-weight-bold " >Parent Hub: {{$device->hub_serial_no}}</div>



                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>

                <hr>
        <div class="row mb-4">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <h1>EMC_LITE_UNMAINTAINED</h1>
                    </div>

                </div>
                <div class="row">
                    @foreach ($devices as $device)
                    @if ($device->type != 'EMC_LITE_UNMAINTAINED')
                        @continue
                    @endif
                    <div class="col-lg-3">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    <img src="{{ asset('images') }}/Pro-Em Lite Icon.png" class="" style="width: 100%;" alt="" />

                                </div>
                                <div style='width: 100% !important; text-align: laft !important; margin: auto;'>
                                    <div class="font-weight-bold " >Type: {{$device->type}}</div>
                                    <div class="font-weight-bold " >Name: {{$device->device_name}}</div>
                                    <div class="font-weight-bold " >Serial: {{$device->serial_no}}</div>
                                    <div class="font-weight-bold " >Parent Hub: {{$device->hub_serial_no}}</div>



                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>

        <hr>
        <div class="row mb-4">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <h1>Proem EMC</h1>
                    </div>

                </div>
                <div class="row">
                    @foreach ($devices as $device)
                    @if ($device->type != 'Proem EMC')
                        @continue
                    @endif
                    <div class="col-lg-3">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    <img src="{{ asset('images') }}/Pro-Em Icon.png" class="" style="width: 100%;" alt="" />

                                </div>
                                <div style='width: 100% !important; text-align: laft !important; margin: auto;'>
                                    <div class="font-weight-bold " >Type: {{$device->type}}</div>
                                    <div class="font-weight-bold " >Name: {{$device->device_name}}</div>
                                    <div class="font-weight-bold " >Serial: {{$device->serial_no}}</div>
                                    <div class="font-weight-bold " >Parent Hub: {{$device->hub_serial_no}}</div>



                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>


        <hr>
        <div class="row mb-4">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <h1>Bulkhead Maintained</h1>
                    </div>

                </div>
                <div class="row">
                    @foreach ($devices as $device)
                    @if ($device->type != 'Bulkhead Maintained')
                        @continue
                    @endif
                    <div class="col-lg-3">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    <img src="{{ asset('images') }}/Pro-Em Lite Icon.png" class="" style="width: 100%;" alt="" />

                                </div>
                                <div style='width: 100% !important; text-align: laft !important; margin: auto;'>
                                    <div class="font-weight-bold " >Type: {{$device->type}}</div>
                                    <div class="font-weight-bold " >Name: {{$device->device_name}}</div>
                                    <div class="font-weight-bold " >Serial: {{$device->serial_no}}</div>
                                    <div class="font-weight-bold " >Parent Hub: {{$device->hub_serial_no}}</div>



                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>




        <hr>
        <div class="row mb-4">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <h1>Bulkhead Non Maintained</h1>
                    </div>

                </div>
                <div class="row">
                    @foreach ($devices as $device)
                    @if ($device->type != 'Bulkhead Non Maintained')
                        @continue
                    @endif
                    <div class="col-lg-3">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    <img src="{{ asset('images') }}/Pro-Em Lite Icon.png" class="" style="width: 100%;" alt="" />

                                </div>
                                <div style='width: 100% !important; text-align: laft !important; margin: auto;'>
                                    <div class="font-weight-bold " >Type: {{$device->type}}</div>
                                    <div class="font-weight-bold " >Name: {{$device->device_name}}</div>
                                    <div class="font-weight-bold " >Serial: {{$device->serial_no}}</div>
                                    <div class="font-weight-bold " >Parent Hub: {{$device->hub_serial_no}}</div>



                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>
        <hr>
        <div class="row mb-4">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <h1>VCM</h1>
                    </div>

                </div>
                <div class="row">
                    @foreach ($devices as $device)
                    @if ($device->type != 'PROEM_VCM100')
                        @continue
                    @endif
                    <div class="col-lg-3">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    <img src="{{ asset('images') }}/VCM Icon.png" class="" style="width: 100%;" alt="" />

                                </div>
                                <div style='width: 100% !important; text-align: laft !important; margin: auto;'>
                                    <div class="font-weight-bold " >Type: {{$device->type}}</div>
                                    <div class="font-weight-bold " >Name: {{$device->device_name}}</div>
                                    <div class="font-weight-bold " >Serial: {{$device->serial_no}}</div>
                                    <div class="font-weight-bold " >Parent Hub: {{$device->hub_serial_no}}</div>



                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


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
