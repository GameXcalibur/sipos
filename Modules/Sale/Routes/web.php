<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {

    //POS
    Route::get('/app/pos', 'PosController@index')->name('app.pos.index');
    Route::post('/app/pos', 'PosController@store')->name('app.pos.store');

    //Generate PDF
    Route::get('/sales/pdf/{id}', function ($id) {
        $sale = \Modules\Sale\Entities\Sale::findOrFail($id);
        $customer = \Modules\People\Entities\Customer::findOrFail($sale->customer_id);

        $pdf = \PDF::loadView('sale::print', [
            'sale' => $sale,
            'customer' => $customer,
        ])->setPaper('a4');

        return $pdf->stream('sale-'. $sale->reference .'.pdf');
    })->name('sales.pdf');


        //Generate PDF
        Route::get('/test/pdf/{date}/{type}', function ($date, $type) {
            $dateSplit = explode(',', $date);
            $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');

            $tests = \App\Models\Test::where('testType', $type)->where('dateString', 'LIKE', '%'.$dateSplit[0].','.$dateSplit[1].'%')->where('hubSerial', $hubsForAccount[0]->hubSerial)->get();
            //dd($test);
            //$customer = \Modules\People\Entities\Customer::findOrFail($sale->customer_id);
            foreach($tests as $key=>&$test){
                $device = \DB::select('SELECT * FROM devices WHERE serial_no ="'.$test->deviceSerial.'"');
                if(array_key_exists(0, $device)){
                    if($device[0]->device_name = '')
                        continue;
                    $test->extra1 = $device[0]->device_name;
    
                }
                
            }

            
            $pdf = \PDF::loadView('sale::print', [
                'tests' => $tests,
                'date' => $date,
                'type' => $type,

            ])->setPaper('a4');
            $pdf->setOption('footer-html',view('header'));
            $pdf->setOption('background',true);

            //dd($pdf);
            return $pdf->stream('ProEMTest-'. $type.'-'.$date .'.pdf');
        })->name('tests.pdf');
    Route::get('/sales/pos/pdf/{id}', function ($id) {
        $sale = \Modules\Sale\Entities\Sale::findOrFail($id);

        $pdf = \PDF::loadView('sale::print-pos', [
            'sale' => $sale,
        ])->setPaper('a7')
            ->setOption('margin-top', 8)
            ->setOption('margin-bottom', 8)
            ->setOption('margin-left', 5)
            ->setOption('margin-right', 5);

        return $pdf->stream('sale-'. $sale->reference .'.pdf');
    })->name('sales.pos.pdf');

    //Sales
    Route::resource('sales', 'SaleController');

    //Payments
    Route::get('/sale-payments/{sale_id}', 'SalePaymentsController@index')->name('sale-payments.index');
    Route::get('/sale-payments/{sale_id}/create', 'SalePaymentsController@create')->name('sale-payments.create');
    Route::post('/sale-payments/store', 'SalePaymentsController@store')->name('sale-payments.store');
    Route::get('/sale-payments/{sale_id}/edit/{salePayment}', 'SalePaymentsController@edit')->name('sale-payments.edit');
    Route::patch('/sale-payments/update/{salePayment}', 'SalePaymentsController@update')->name('sale-payments.update');
    Route::delete('/sale-payments/destroy/{salePayment}', 'SalePaymentsController@destroy')->name('sale-payments.destroy');


    Route::get('/inv/pick/', 'SaleController@pickIndex')->name('pick.index');
    Route::get('/inv/pick/{sale}', 'SaleController@pickAction')->name('pick.action');
    Route::post('/complete/pick/{sale}', 'SaleController@pickComplete')->name('pick.complete');

    Route::get('/inv/cus/', 'SaleController@cusIndex')->name('cus.index');
    Route::get('/inv/cus/{sale}', 'SaleController@cusAction')->name('cus.action');
    Route::post('/complete/cus/{sale}', 'SaleController@cusComplete')->name('cus.complete');

    Route::get('/inv/sec/', 'SaleController@secIndex')->name('sec.index');
    Route::get('/inv/sec/{sale}', 'SaleController@secAction')->name('sec.action');
    Route::post('/complete/sec/{sale}', 'SaleController@secComplete')->name('sec.complete');
});
