@extends('layouts.app')

@section('title', 'Pick Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('cus.index') }}">Customer Receipt</a></li>
        <li class="breadcrumb-item active">Details</li>
    </ol>
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.34/sweetalert2.css" integrity="sha512-e+TwvhjDvKqpzQLJ7zmtqqz+5jF9uIOa+5s1cishBRfmapg7mqcEzEl44ufb04BXOsEbccjHK9V0IVukORmO8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center">
                        <div>
                            Reference: <strong>{{ $sale->reference }}</strong>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Company Info:</h5>
                                <div><strong>{{ settings()->company_name }}</strong></div>
                                <div>{{ settings()->company_address }}</div>
                                <div>Email: {{ settings()->company_email }}</div>
                                <div>Phone: {{ settings()->company_phone }}</div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Customer Info:</h5>
                                <div><strong>{{ $customer->customer_name }}</strong></div>
                                <div>{{ $customer->address }}</div>
                                <div>Email: {{ $customer->customer_email }}</div>
                                <div>Phone: {{ $customer->customer_phone }}</div>
                            </div>

                            <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Invoice Info:</h5>
                                <div>Invoice: <strong>INV/{{ $sale->reference }}</strong></div>
                                <div>Date: {{ \Carbon\Carbon::parse($sale->date)->format('d M, Y') }}</div>
                            </div>

                        </div>

                        <div class="table-responsive-sm">
                        <form id="pick-form" action="{{ route('cus.complete', $sale) }}" method="POST">
                        @csrf

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    
                                    <th class="align-middle">Product</th>
                                    <th class="align-middle">Pack Size</th>

                                    <th class="align-middle">Quantity</th>
                                    <th class="align-middle">Picked?</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sale->saleDetails as $item)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $item->product_name }} <br>
                                            <span class="badge badge-success">
                                                {{ $item->product_code }}
                                            </span>
                                        </td>


                                        <td class="align-middle">
                                            <b style="font-size: 16px;">{{ $item->product->category->category_name }}</b>
                                        </td>

                                        <td class="align-middle">
                                            <b style="font-size: 22px;">{{ $item->quantity }}</b>
                                        </td>

                                        <td class="align-middle">
                                            <input type="checkbox" name="{{$item->product_code}}" />
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>
                        </div>
                        <div class="row">
                            <div class="col-md-11">
                            </div>
                            <div class="col-md-1">
                            <button class="btn btn-info pull-right" type="button" onclick="pickSignOff()">Sign Off</button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.34/sweetalert2.all.min.js" integrity="sha512-HTl4tBrbMVVFPxzq2l5FyIedzGnuXpt4ye/7nL04fUDqQTSQLz6MrZzJJU8avbryHT/6b6cjdlV2oaXFTbSw1A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>


          function pickSignOff(){
            var form = document.getElementById('pick-form');
var inputs = form.getElementsByTagName('input');
var is_checked = true;
for(var x = 0; x < inputs.length; x++) {
    if(inputs[x].type == 'checkbox') {
        is_checked = inputs[x].checked;
        if(!is_checked) break;
    }
}

if(!is_checked){
    Swal.fire({
      title: 'SOME ITEMS HAVE NOT BEEN CHECKED',
              html: "You have not checked all invoice items!",
              icon: 'warning',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Okay',
            })
            return;
}

              
    Swal.fire({
      title: 'CUSTOMER RECEIPT DISCLAIMER',
              html: "Please ensure that you have received all items according to your invoice. By clicking accept, you hereby aknowledge that you have received the correct items and thus void any claim to innacurate receipt.",
              icon: 'warning',
              footer: '<span style="font-size: 12px;">*Clicking the accept button constitutes a legally binding digital signature which is linked to your account and device. <b>{{date("Y-m-d H:i:s")}}</b></span>',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Accept',
              cancelButtonText: 'Decline',
            }).then((result) => {
              console.log(result);
              if (result.value === true) {
                document.getElementById('pick-form').submit();
              }
            })

    }
    </script>
@endsection

