@extends('layouts.app')

@section('title', 'VCM')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">VCM</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
       <div class='row justify-content-center'>
        <h2>VCM LOGS FOR HUB SERIAL</h2>
        <input type='text' id='hubSerial'></input>
        <button class='btn btn-info' onclick='getVCM()'>FETCH</button>

       </div>
       <div class='row justify-content-center' style='background: black; color: green; text-align: center'>
        <h2>RESULTS</h2>
        <hr>
            <div id='resCon'>
                
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
    function getVCM(){
        var hubSerial = document.getElementById('hubSerial').value;

        window.open("/php/pull.php?h="+hubSerial, '_blank').focus();

    });
    }
    </script>
@endpush
