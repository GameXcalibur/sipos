@extends('layouts.app')

@section('title', 'Settings')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Settings</li>
    </ol>
@endsection

@section('content')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

    <div class="container-fluid">
       
    <div class="row">
            <h2><u>Notifications</u></h2>

    </div>
    <div class="row">
            <select>
                <option>Offline Devices</option>
                <option>Device Faults</option>

            </select>


    </div>
    <div class="row">

            <input type='email' name='email' placeholder='example@test.com'></input>

    </div>
    <div class="row">

<input type='email' name='email' placeholder='example@test.com'></input>

</div>
<div class="row">

<input type='email' name='email' placeholder='example@test.com'></input>

</div>
<div class="row">

<input type='email' name='email' placeholder='example@test.com'></input>

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
