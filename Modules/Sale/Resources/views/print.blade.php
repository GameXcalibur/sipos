<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProEM Report</title>
    <link rel="stylesheet" href="{{ public_path('b3/bootstrap.min.css') }}">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div style="text-align: center;margin-bottom: 25px;">
                <img width="180" src="{{ public_path('images/logo-dark.png') }}" alt="Logo">
                <h4 style="margin-bottom: 20px;">
                    <strong>ProEM Report</strong>
                </h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-xs-6 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">Company Info:</h4>
                            <div><strong>{{ settings()->company_name }}</strong></div>
                            <div>{{ settings()->company_address }}</div>
                            <div>Email: {{ settings()->company_email }}</div>
                            <div>Phone: {{ settings()->company_phone }}</div>
                        </div>

                        <div class="col-xs-6 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">Report Details:</h4>
                            <div>Date: <strong>{{ $date }}</strong></div>
                            <div>Type: <strong>{{ $type }}</strong></div>
                            <div>Number Of Devices: <strong>{{ count($tests) }}</strong></div>
                            <div>Number Of Passes: <strong>{{ count($tests) }}</strong></div>
                        </div>



                    </div>

                    <div class="table-responsive-sm" style="margin-top: 30px;">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="align-middle">Device</th>
                                <th class="align-middle">Result</th>
                                <th class="align-middle">Reason</th>
 
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tests as $test)
                                <tr>
                                    <td class="align-middle">
                                        {{ $test->extra1 }} <br>
                                        <span class="badge badge-success">
                                                <strong>{{ $test->deviceSerial }}</strong>
                                            </span>
                                    </td>

                                    <td class="align-middle">
                                        {{$test->testResult }}
                                    </td>

                                    <td class="align-middle">
                                        -
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="row" style="margin-top: 25px;">
                    <div class="col-xs-12">
                            <p style="font-style: italic;text-align: center">The SILUX CONTROL ProEM system not only meets the requirements of the latest BS 5266-1-2016 standard
but also ensures all compliance testing is carried out in accordance with BS EN 50172:2004 and BS 5266-8:2004 and BS 5266-1:2016
The PRO-EM is updated every hour with status information which can be viewed at any time
Weekly Test: Flash Test 1 Minute; Monthly Test: 30 Minute; Bi-Annual Test: 1.5 hours; Annual Test: 3 hours</p>
                        </div>
                        <div class="col-xs-12">
                            <p style="font-style: italic;text-align: center">{{ settings()->company_name }} &copy; {{ date('Y') }}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
