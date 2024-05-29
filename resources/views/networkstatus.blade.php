@extends('layouts.app')

@section('title', 'Network Status')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Network Status</li>
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


        @foreach ($types as $type)
        @if ($type == 'USER')
            @continue
        @endif
        <hr>
        <div class="row mb-4">

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>{{$type}}</h1>
                    </div>

                </div>
                <div class="row">
                    @foreach ($devices as $device)
                    @if ($device->type != $type)
                        @continue
                    @endif
                    <div class="col-lg-6">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    @switch($device->type)
                                        @case('Master')
                                            <img src="{{ asset('images') }}/Master Icon.png" class="" style="width: 100%;" alt="" />
                                            
                                            @break
                                        @case('EMC Lite Maintained')
                                        @case('EMC Lite Non Maintained')


                                            <img src="{{ asset('images') }}/Pro-Em Lite Icon.png" class="" style="width: 100%;" alt="" />
                                            
                                            @break
                                        @case('Bulkhead Maintained')
                                        @case('Bulkhead Non Maintained')
                                        <img src="{{ asset('images') }}/Bulkhead Icon.png" class="" style="width: 100%;" alt="" />

                                            @break

                                        @case('Proem Emergency')
                                        @case('Proem EMC')

                                            <img src="{{ asset('images') }}/Pro-Em Icon.png" class="" style="width: 100%;" alt="" />

                                            @break

                                        @case('Twin Spot Maintained')
                                        @case('Twin Spot Non Maintained')


                                            <img src="{{ asset('images') }}/Twin Spot Icon.png" class="" style="width: 100%;" alt="" />

                                            @break
                                        @case('Exit Box Maintained')
                                        @case('Exit Box Non Maintained')


                                            <img src="{{ asset('images') }}/Exit Light Icon.png" class="" style="width: 100%;" alt="" />

                                            @break

                                        @case('Hanging Exit Sign Maintained')
                                        @case('Hanging Exit Sign Non Maintained')


                                            <img src="{{ asset('images') }}/Hanging Exit Light Icon.png" class="" style="width: 100%;" alt="" />

                                            @break
                                        @default
                                            <img src="{{ asset('images') }}/Home Icon.png" class="" style="width: 100%;" alt="" />
                                            
                                    @endswitch

                                </div>
                                <div style='width: 100% !important; text-align: laft !important; margin: auto;'>
                                    <div class="font-weight-bold " >Type: {{$device->type}}</div>
                                    <div class="font-weight-bold " >Name: {{$device->device_name}}</div>
                                    <div class="font-weight-bold " >Serial: {{$device->serial_no}}</div>
                                    <div class="font-weight-bold " >Parent Hub: {{$device->hub_serial_no}}</div>



                                </div>
                                <div class="p-2 mfe-3 align-items-center justify-content-center  bg-gradient-default rounded-left rounded-right" style='width: 5vmax''>
                                    <img src="{{ $device->registered }}" class="" style="width: 60%;" alt="" />
                                    <div class="font-weight-bold " >{{$device->userExceptions}}</div>


                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>
        @endforeach





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
