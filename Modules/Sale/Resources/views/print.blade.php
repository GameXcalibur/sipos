<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProEM Report</title>
    <link rel="stylesheet" href="{{ public_path('b3/bootstrap.min.css') }}">
    <style>
body {
    background: url("https://dashboard.siluxcontrol.co.uk/images/logo-dark.png") !important;
    /* background: #000 !important; */

    background-position: center;
    background-repeat: repeat-y;
    background-size: 100%;
    background-attachment: fixed;
}
</style>
</head>
<body >

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div style="text-align: center;margin-bottom: 25px;">
                <img width="180" src="{{ public_path('images/logo-dark.png') }}" alt="Logo">
                <h4 style="margin-bottom: 20px;">
                    <strong>Emergency Lighting Test Report</strong>
                </h4>
            </div>
            <div class="card" style="background-color: transparent !important;">
                <div class="card-body"  style="background-color: transparent !important;">

                    <div class="row mb-4">
                        <div class="col-xs-6 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">Company Info:</h4>
                            <div><strong>{{ $settings->company_name }}</strong></div>
                            <div>{{ $settings->company_address }}</div>
                            @if ($settings->company_address1 != '')
                            <div>{{ $settings->company_address1 }}</div>
                                
                            @endif
                            @if ($settings->company_address2 != '')
                            <div>{{ $settings->company_address2 }}</div>
                                
                            @endif

                            <div>Email: {{ $settings->company_email }}</div>
                            <div>Phone: {{ $settings->company_phone }}</div>
                        </div>

                        <div class="col-xs-6 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">Report Details:</h4>
                            <div>Date: <strong>{{ $date }}</strong></div>
                            <div>Type: <strong>{{ $type }}</strong></div>
                            <div>Number Of Devices: <strong>{{ count($tests) }}</strong></div>
                            <div>Number Of Passes: <strong>{{ count($tests) }}</strong></div>
                        </div>



                    </div>

                    <div class="table-responsive-sm" style="margin-top: 30px; background: url('{{ public_path('images/opacity4.png') }}') !important; background-size: 100% !important;  background-position: center !important; background-repeat: repeat-y !important; ">

                        <table class="table table-striped" style="background-color: transparent !important;" >
                            <thead>
                            <tr>
                                <th class="align-middle">Device</th>
                                <th class="align-middle">Result</th>
                                <th class="align-middle">Reason</th>
 
                            </tr>
                            </thead>
                            
    
                            <tbody style="">
                            @foreach($tests as $test)
                                <tr style="background-color: transparent !important; ">
                                    <td class="align-middle" style="background-color: transparent !important;">
                                        {{ $test->extra1 }} <br>
                                        <span class="badge badge-success">
                                                <strong>{{ $test->deviceSerial }}</strong>
                                            </span>
                                    </td>

                                    <td class="align-middle" style="background-color: transparent !important;">
                                        <strong>{{$test->testResult }}</strong>
                                    </td>

                                    <td class="align-middle" style="background-color: transparent !important;">
                                        -
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
