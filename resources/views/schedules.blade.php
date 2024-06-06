@extends('layouts.app')

@section('title', 'Schedules')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Schedules</li>
    </ol>
@endsection

@section('content')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

    <div class="container-fluid">
       

    <div class="row">
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Weekly</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Monthly</a>
      <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Bi-Annual</a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Annual</a>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

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
                    @foreach ($finalList['weekly'] as $key=>$data)
                    @if ($data[0]['type'] != $type)
                        @continue
                    @endif
                    <div class="col-lg-6">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    @switch($data[0]['type'])
                                        @case('Master')
                                            <img src="{{ asset('images') }}/Master Icon.png" class="" style="width: 100%;" alt="" />
                                            
                                            @break
                                        @case('Proem VCM100')
                                            <img src="{{ asset('images') }}/VCM Icon.png" class="" style="width: 100%;" alt="" />
                                            
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
                                    <div class="font-weight-bold " >Type: {{$data[0]['type']}}</div>
                                    <div class="font-weight-bold " >Name: {{$data[0]['name']}}</div>
                                    <div class="font-weight-bold " >Serial: {{$key}}</div>



                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>
        @endforeach
      </div>

      <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
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
                    @foreach ($finalList['monthly'] as $key=>$data)
                    @if ($data[0]['type'] != $type)
                        @continue
                    @endif
                    <div class="col-lg-6">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    @switch($data[0]['type'])
                                        @case('Master')
                                            <img src="{{ asset('images') }}/Master Icon.png" class="" style="width: 100%;" alt="" />
                                            
                                            @break
                                        @case('Proem VCM100')
                                            <img src="{{ asset('images') }}/VCM Icon.png" class="" style="width: 100%;" alt="" />
                                            
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
                                    <div class="font-weight-bold " >Type: {{$data[0]['type']}}</div>
                                    <div class="font-weight-bold " >Name: {{$data[0]['name']}}</div>
                                    <div class="font-weight-bold " >Serial: {{$key}}</div>



                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>
        @endforeach
      </div>


      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">


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
                    @foreach ($finalList['bannual'] as $key=>$data)
                    @if ($data[0]['type'] != $type)
                        @continue
                    @endif
                    <div class="col-lg-6">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    @switch($data[0]['type'])
                                        @case('Master')
                                            <img src="{{ asset('images') }}/Master Icon.png" class="" style="width: 100%;" alt="" />
                                            
                                            @break
                                        @case('Proem VCM100')
                                            <img src="{{ asset('images') }}/VCM Icon.png" class="" style="width: 100%;" alt="" />
                                            
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
                                    <div class="font-weight-bold " >Type: {{$data[0]['type']}}</div>
                                    <div class="font-weight-bold " >Name: {{$data[0]['name']}}</div>
                                    <div class="font-weight-bold " >Serial: {{$key}}</div>



                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>
        @endforeach
      </div>


      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">

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
                    @foreach ($finalList['annual'] as $key=>$data)
                    @if ($data[0]['type'] != $type)
                        @continue
                    @endif
                    <div class="col-lg-6">
                        <div class="card border-0">
                            <div class="card-body p-0 d-flex  shadow-sm rounded-left rounded-right">
                                <div class="p-2 mfe-3 align-items-center  bg-gradient-success rounded-left rounded-right" style='width: 7vmax''>
                                    @switch($data[0]['type'])
                                        @case('Master')
                                            <img src="{{ asset('images') }}/Master Icon.png" class="" style="width: 100%;" alt="" />
                                            
                                            @break
                                        @case('Proem VCM100')
                                            <img src="{{ asset('images') }}/VCM Icon.png" class="" style="width: 100%;" alt="" />
                                            
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
                                    <div class="font-weight-bold " >Type: {{$data[0]['type']}}</div>
                                    <div class="font-weight-bold " >Name: {{$data[0]['name']}}</div>
                                    <div class="font-weight-bold " >Serial: {{$key}}</div>



                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                
            </div>





            
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>




    </div>
@endsection


@section('third_party_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
            integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@push('page_scripts')
   <script>
        $(document).ready(function() {
   

    });

    </script>
@endpush
