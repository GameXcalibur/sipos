@extends('layouts.app')

@section('title', 'Device Reports')
@section('third_party_stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection
@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Device Reports</li>
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

    <div class="col-lg-12">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header">
                        Device Reports
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('third_party_scripts')
{!! $dataTable->scripts() !!}


@endsection

@push('page_scripts')

@endpush
