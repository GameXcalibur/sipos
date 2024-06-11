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


        </div>
        <div class="col-md-4">
            <div class="row">
                <h2><b>Notification Interval</b></h2>

            </div>


        </div>


    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row" >
                <div class="col-md-8" >

                    <input type='email' name='email' placeholder='' style='width: 80%;' class="form-control"></input>

                </div>
                <div class="col-md-4" >

                    <select style='width: 100%;' class="form-control">
                        <option>Once / Day</option>
                        <option>Once / Week</option>
                        <option>Once / Month</option>
                        <option>Once / Year</option>

                    </select>
                </div>
            </div>
        </div>
    </div>

    <hr>





</div>
<hr>




    <div class="row" >
        <button class='btn btn-success' style='width:100%;'>SUBMIT</button>
    </div>
    <div class="row justify-content-center" >

        <p>*These notifications will alert you to any problems found on the netowork, and will be emailed to the respective email addresses</p>
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
