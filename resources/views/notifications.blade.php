@extends('layouts.app')

@section('title', 'Notifications')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Notifications</li>
    </ol>
@endsection

@section('content')
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

    <div class="container-fluid">
       

    <div class="row">
        <div class="col-md-8">
        <div class="row">
                <h2><b>Emails</b></h2>

            </div>
            <div class="row" >

                    <input type='email' name='email' placeholder='' style='width: 80%;'></input>

            </div>
            <div class="row">

            <input type='email' name='email' placeholder='' style='width: 80%;'></input>

            </div>
            <div class="row">

            <input type='email' name='email' placeholder='' style='width: 80%;'></input>

            </div>
            <div class="row">

            <input type='email' name='email' placeholder='' style='width: 80%;'></input>

            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <h2><b>Notification Interval</b></h2>

            </div>
            <div class="row" style='width: 80%;'>

                <select>
                    <option>Once / Day</option>
                    <option>Once / Week</option>
                    <option>Once / Month</option>
                    <option>Once / Year</option>

                </select>

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
