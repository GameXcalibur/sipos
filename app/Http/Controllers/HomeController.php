<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Expense\Entities\Expense;
use Modules\Product\Entities\Product;
use Modules\Purchase\Entities\Purchase;
use Modules\Purchase\Entities\PurchasePayment;
use Modules\PurchasesReturn\Entities\PurchaseReturn;
use Modules\PurchasesReturn\Entities\PurchaseReturnPayment;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Entities\SalePayment;
use Modules\SalesReturn\Entities\SaleReturn;

use App\Models\User;

use Modules\Product\DataTables\ProductDataTable;



use Modules\SalesReturn\Entities\SaleReturnPayment;

class HomeController extends Controller
{
    public function getHubInfo(Request $request){
        $data = $request->all();
        $returnObj = [];
        $offlineRet = "";
        $onBattRet = "";
        $battOpen = "";
        $battShort = "";
        $allDevices = "";





        if($data["live"] == "true"){
            $data1 = [];
            $data1['api_key'] = 'abcd132453wq069n';
            $data1['hubSerial'] = $data["hubSer"];
            $data1['cmd'] = 'getDevices';
            $data1['page'] = 1;
    
    
            $totalHubDevices = [];
            $hubResDevices = $this->getDevicesS($data["hubSer"]);
            $hubResDevices = json_decode($hubResDevices, true);
            array_push($totalHubDevices , ...$hubResDevices['live_response']);
            $page = 1;
            while(count($hubResDevices['live_response']) == 8){
                $page++;
                $hubResDevices = $this->getDevicesS($data["hubSer"], $page);
                $hubResDevices = json_decode($hubResDevices, true);
                array_push($totalHubDevices , ...$hubResDevices['live_response']);
    
            }

            foreach($totalHubDevices as $totalHubDevice){
                $deviceObj = \DB::select('SELECT * FROM devices WHERE serial_no = "'.$totalHubDevice['serial_no'].'"');

                $allDevices .= '<tr>';
    
                if(!$deviceObj){
                    $allDevices .= '<td>';
                    $allDevices .= 'NO NAME';
                    $allDevices .= '</td>';
    
                    $allDevices .= '<td>';
                    $allDevices .= 'NO TYPE';
                    $allDevices .= '</td>';
                }else{
    
                    $allDevices .= '<td>';
                    $allDevices .= $deviceObj[0]->device_name;
                    $allDevices .= '</td>';
    
                    $deviceType = \DB::select('SELECT * FROM device_types WHERE code = "'.$deviceObj[0]->type.'"');
    
                    $allDevices .= '<td>';
                    $allDevices .= $deviceType[0]->name;
                    $allDevices .= '</td>';
                }
    
    
    
                $allDevices .= '<td>';
                $allDevices .= $totalHubDevice['serial_no'];
                $allDevices .= '</td>';
    

    
    
                if(!$deviceObj){
                    $allDevices .= '<td>';
                    $allDevices .= 'N/A';
                    $allDevices .= '</td>';
                }else{
    
                    $allDevices .= '<td>';
                    $allDevices .= $deviceObj[0]->date_time_registered;
                    $allDevices .= '</td>';
                }
    
                $allDevices .= '<td class="td-actions text-right">';
                if($deviceType[0]->name == 'EMERGENCY_LIGHT')
                    $allDevices .= '<a rel="tooltip" class="btn btn-info btn-link"  data-original-title="" onclick="viewSchedule(\''.$data["hubSer"].'\', \''.$totalHubDevice['serial_no'].'\');" title=""><i class="material-icons">schedule</i><div class="ripple-container"></div></a>';

                $allDevices .= '<a rel="tooltip" class="btn btn-danger btn-link"  data-original-title="" onclick="deleteDevice(\''.$data["hubSer"].'\', \''.$totalHubDevice['serial_no'].'\');" title=""><i class="material-icons">delete</i><div class="ripple-container"></div></a>';

                $allDevices .= '</td>';
    
                $allDevices .= '</tr>';

                if($totalHubDevice['state'] == '019' || $totalHubDevice['state'] == '010'){
                    $offlineRet .= '<tr>';
    
                    if(!$deviceObj){
                        $offlineRet .= '<td>';
                        $offlineRet .= 'NO NAME';
                        $offlineRet .= '</td>';
        
                        $offlineRet .= '<td>';
                        $offlineRet .= 'NO TYPE';
                        $offlineRet .= '</td>';
                    }else{
        
                        $offlineRet .= '<td>';
                        $offlineRet .= $deviceObj[0]->device_name;
                        $offlineRet .= '</td>';
        
                        $deviceType = \DB::select('SELECT * FROM device_types WHERE code = "'.$deviceObj[0]->type.'"');
        
                        $offlineRet .= '<td>';
                        $offlineRet .= $deviceType[0]->name;
                        $offlineRet .= '</td>';
                    }
        
        
        
                    $offlineRet .= '<td>';
                    $offlineRet .= $totalHubDevice['serial'];
                    $offlineRet .= '</td>';
        
        
                    $offlineRet .= '<td>';
                    $offlineRet .= $data["hubSer"];
                    $offlineRet .= '</td>';
        
        
                    if(!$deviceObj){
                        $offlineRet .= '<td>';
                        $offlineRet .= 'N/A';
                        $offlineRet .= '</td>';
                    }else{
        
                        $offlineRet .= '<td>';
                        $offlineRet .= $deviceObj[0]->date_time_registered;
                        $offlineRet .= '</td>';
                    }
        
        
        
                    $offlineRet .= '</tr>';
                }else if($totalHubDevice['state'] == '011' || $totalHubDevice['state'] == '012' || $totalHubDevice['state'] == '013' || $totalHubDevice['state'] == '014' || $totalHubDevice['state'] == '015' || $totalHubDevice['state'] == '016' || $totalHubDevice['state'] == '017' || $totalHubDevice['state'] == '018'){
                    $onBattRet .= '<tr>';
    
                    if(!$deviceObj){
                        $onBattRet .= '<td>';
                        $onBattRet .= 'NO NAME';
                        $onBattRet .= '</td>';
        
                        $onBattRet .= '<td>';
                        $onBattRet .= 'NO TYPE';
                        $onBattRet .= '</td>';
                    }else{
        
                        $onBattRet .= '<td>';
                        $onBattRet .= $deviceObj[0]->device_name;
                        $onBattRet .= '</td>';
        
                        $deviceType = \DB::select('SELECT * FROM device_types WHERE code = "'.$deviceObj[0]->type.'"');
        
                        $onBattRet .= '<td>';
                        $onBattRet .= $deviceType[0]->name;
                        $onBattRet .= '</td>';
                    }
        
        
        
                    $onBattRet .= '<td>';
                    $onBattRet .= $totalHubDevice['serial_no'];
                    $onBattRet .= '</td>';
        
        
                    $onBattRet .= '<td>';
                    $onBattRet .= $data["hubSer"];
                    $onBattRet .= '</td>';
        
        
                    if(!$deviceObj){
                        $onBattRet .= '<td>';
                        $onBattRet .= 'N/A';
                        $onBattRet .= '</td>';
                    }else{
        
                        $onBattRet .= '<td>';
                        $onBattRet .= $deviceObj[0]->date_time_registered;
                        $onBattRet .= '</td>';
                    }
        
        
        
                    $onBattRet .= '</tr>';
                }else if($totalHubDevice['state'] == '009'){
                    $battOpen .= '<tr>';
    
                    if(!$deviceObj){
                        $battOpen .= '<td>';
                        $battOpen .= 'NO NAME';
                        $battOpen .= '</td>';
        
                        $battOpen .= '<td>';
                        $battOpen .= 'NO TYPE';
                        $battOpen .= '</td>';
                    }else{
        
                        $battOpen .= '<td>';
                        $battOpen .= $deviceObj[0]->device_name;
                        $battOpen .= '</td>';
        
                        $deviceType = \DB::select('SELECT * FROM device_types WHERE code = "'.$deviceObj[0]->type.'"');
        
                        $battOpen .= '<td>';
                        $battOpen .= $deviceType[0]->name;
                        $battOpen .= '</td>';
                    }
        
        
        
                    $battOpen .= '<td>';
                    $battOpen .= $totalHubDevice['serial_no'];
                    $battOpen .= '</td>';
        
        
                    $battOpen .= '<td>';
                    $battOpen .= $data["hubSer"];
                    $battOpen .= '</td>';
        
        
                    if(!$deviceObj){
                        $battOpen .= '<td>';
                        $battOpen .= 'N/A';
                        $battOpen .= '</td>';
                    }else{
        
                        $battOpen .= '<td>';
                        $battOpen .= $deviceObj[0]->date_time_registered;
                        $battOpen .= '</td>';
                    }
        
        
        
                    $battOpen .= '</tr>';
                }else if($totalHubDevice['state'] == '000'){
                    $battShort .= '<tr>';
    
                    if(!$deviceObj){
                        $battShort .= '<td>';
                        $battShort .= 'NO NAME';
                        $battShort .= '</td>';
        
                        $battShort .= '<td>';
                        $battShort .= 'NO TYPE';
                        $battShort .= '</td>';
                    }else{
        
                        $battShort .= '<td>';
                        $battShort .= $deviceObj[0]->device_name;
                        $battShort .= '</td>';
        
                        $deviceType = \DB::select('SELECT * FROM device_types WHERE code = "'.$deviceObj[0]->type.'"');
        
                        $battShort .= '<td>';
                        $battShort .= $deviceType[0]->name;
                        $battShort .= '</td>';
                    }
        
        
        
                    $battShort .= '<td>';
                    $battShort .= $totalHubDevice['serial_no'];
                    $battShort .= '</td>';
        
        
                    $battShort .= '<td>';
                    $battShort .= $data["hubSer"];
                    $battShort .= '</td>';
        
        
                    if(!$deviceObj){
                        $battShort .= '<td>';
                        $battShort .= 'N/A';
                        $battShort .= '</td>';
                    }else{
        
                        $battShort .= '<td>';
                        $battShort .= $deviceObj[0]->date_time_registered;
                        $battShort .= '</td>';
                    }
        
        
        
                    $battShort .= '</tr>';
                }else{
                    continue;
                }

                // switch($totalHubDevice['state']){
                //     case '009':
                //     case '000':
                //         if(isset($deviceStats[$hubForAccount->hubSerial]['off']))
                //             $deviceStats[$hubForAccount->hubSerial]['off']++;
                //         else
                //             $deviceStats[$hubForAccount->hubSerial]['off'] = 1;
                //         break;
                //     default:
                //         if(isset($deviceStats[$hubForAccount->hubSerial]['on']))
                //             $deviceStats[$hubForAccount->hubSerial]['on']++;
                //         else
                //             $deviceStats[$hubForAccount->hubSerial]['on'] = 1;
                //         break;


                // }

        
    
                    
            }

        }else{
            $offlineDevs = \DB::select('SELECT * FROM lastOnline WHERE hubSerial = "'.$data["hubSer"].'" AND extra = "Offline"');
    
            foreach($offlineDevs as $r){
                $deviceObj = \DB::select('SELECT * FROM devices WHERE serial_no = "'.$r->serial.'"');
    
    
                $offlineRet .= '<tr>';
    
                if(!$deviceObj){
                    $offlineRet .= '<td>';
                    $offlineRet .= 'NO NAME';
                    $offlineRet .= '</td>';
    
                    $offlineRet .= '<td>';
                    $offlineRet .= 'NO TYPE';
                    $offlineRet .= '</td>';
                }else{
    
                    $offlineRet .= '<td>';
                    $offlineRet .= $deviceObj[0]->device_name;
                    $offlineRet .= '</td>';
    
                    $deviceType = \DB::select('SELECT * FROM device_types WHERE code = "'.$deviceObj[0]->type.'"');
    
                    $offlineRet .= '<td>';
                    $offlineRet .= $deviceType[0]->name;
                    $offlineRet .= '</td>';
                }
    
    
    
                $offlineRet .= '<td>';
                $offlineRet .= $r->serial;
                $offlineRet .= '</td>';
    
    
                $offlineRet .= '<td>';
                $offlineRet .= $r->hubSerial;
                $offlineRet .= '</td>';
    
    
                if(!$deviceObj){
                    $offlineRet .= '<td>';
                    $offlineRet .= 'N/A';
                    $offlineRet .= '</td>';
                }else{
    
                    $offlineRet .= '<td>';
                    $offlineRet .= $deviceObj[0]->date_time_registered;
                    $offlineRet .= '</td>';
                }
    
    
    
                $offlineRet .= '</tr>';
    
                
            }

            $allDevs = \DB::select('SELECT * FROM lastOnline WHERE hubSerial = "'.$data["hubSer"].'"');

            foreach($allDevs as $r){
                $deviceObj = \DB::select('SELECT * FROM devices WHERE serial_no = "'.$r->serial.'"');
    
    
                $allDevices .= '<tr>';
    
                if(!$deviceObj){
                    $allDevices .= '<td>';
                    $allDevices .= 'NO NAME';
                    $allDevices .= '</td>';
    
                    $allDevices .= '<td>';
                    $allDevices .= 'NO TYPE';
                    $allDevices .= '</td>';
                }else{
    
                    $allDevices .= '<td>';
                    $allDevices .= $deviceObj[0]->device_name;
                    $allDevices .= '</td>';
    
                    $deviceType = \DB::select('SELECT * FROM device_types WHERE code = "'.$deviceObj[0]->type.'"');
    
                    $allDevices .= '<td>';
                    $allDevices .= $deviceType[0]->name;
                    $allDevices .= '</td>';
                }
    
    
    
                $allDevices .= '<td>';
                $allDevices .= $r->serial;
                $allDevices .= '</td>';
    
    
                $allDevices .= '<td>';
                $allDevices .= $r->hubSerial;
                $allDevices .= '</td>';
    
    
                if(!$deviceObj){
                    $allDevices .= '<td>';
                    $allDevices .= 'N/A';
                    $allDevices .= '</td>';
                }else{
    
                    $allDevices .= '<td>';
                    $allDevices .= $deviceObj[0]->date_time_registered;
                    $allDevices .= '</td>';
                }
    
    
    
                $allDevices .= '</tr>';
    
                
            }

        }


        $returnObj['offDev'] = $offlineRet;
        $returnObj['battOpen'] = $battOpen;

        $returnObj['onBattDev'] = $onBattRet;
        $returnObj['allDevices'] = $allDevices;

        $returnObj['battShort'] = $battShort;


        return response()->json($returnObj);

    }
    public function devices(){
        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
        // $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
        $allDevices = [];
        $deviceTypes = [];
        $master = 0;
        foreach($hubsForAccount as $hub){
            $devices = \DB::select('SELECT * FROM devices WHERE hub_serial_no ="'.$hub->hubSerial.'"');
            $allDevices = array_merge($allDevices, $devices);
            $master += \DB::table('devices')->where('hub_serial_no', $hub->hubSerial)->where('type', '045')->count();


        }
        foreach($allDevices as &$device){
            $lastOnline = \DB::select('SELECT * FROM lastOnline WHERE serial ="'.$device->serial_no.'"');
            $type = \DB::select('SELECT * FROM device_types WHERE code ="'.$device->type.'"');

            $device->d_area= 'Offline';
            if(array_key_exists(0, $lastOnline)){
                $device->d_area= $lastOnline[0]->extra;

            }

            if(array_key_exists(0, $type)){
                $deviceTypes[$device->type] = $type[0]->name;
                $device->type= $type[0]->name;

            }
        }
        //dd($devices);
        $num_hubs = count($hubsForAccount);

        return view('devices', [
            'devices'  => $allDevices,
            'hubs'  => $hubsForAccount,
            'master'  => $master,
            'types'  => $deviceTypes,



            'num_hubs'  => $num_hubs,

        ]);
    }


    public function networkstatus(){
        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
        // $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
        $allDevices = [];
        $deviceTypes = [];
        $master = 0;
        foreach($hubsForAccount as $hub){
            $devices = \DB::select('SELECT * FROM devices WHERE hub_serial_no ="'.$hub->hubSerial.'"');
            $allDevices = array_merge($allDevices, $devices);
            $master += \DB::table('devices')->where('hub_serial_no', $hub->hubSerial)->where('type', '045')->count();


        }
        foreach($allDevices as &$device){

            $lastOnline = \DB::select('SELECT * FROM lastOnline WHERE serial ="'.$device->serial_no.'"');
            $type = \DB::select('SELECT * FROM device_types WHERE code ="'.$device->type.'"');

            $device->d_area= 'Offline';
            if(array_key_exists(0, $lastOnline)){
                $v1 = (int)$lastOnline[0]->Val1;
                $state1Bat = $v1 % 10;
                $state1Gen = intval($v1 / 10);
                $device->d_area= $lastOnline[0]->extra;

                $devPic = '';
                $devStat = '';

                if ($state1Gen == 0 || $state1Gen == 4) {
                    switch ($state1Bat) {
                      case 0:
                        $devPic = '/images/battery/Faulty.png';
                        $devStat = 'Faulty';
                        break;
                      case 1:
                        $devPic =  '/images/battery/30AC.png';
                        $devStat =  '30% (On AC)';
                        break;
                      case 2:
                        $devPic =  '/images/battery/40AC.png';
                        $devStat =  '40% (On AC)';
                        break;
                      case 3:
                        $devPic =  '/images/battery/50AC.png';
                        $devStat =  '50% (On AC)';
                        break;
                      case 4:
                        $devPic =  '/images/battery/60AC.png';
                        $devStat =  '60% (On AC)';
                        break;
                      case 5:
                        $devPic =  '/images/battery/70AC.png';
                        $devStat =  '70% (On AC)';
                        break;
                      case 6:
                        $devPic =  '/images/battery/80AC.png';
                        $devStat =  '80% (On AC)';
                        break;
                      case 7:
                        $devPic =  '/images/battery/90AC.png';
                        $devStat =  '90% (On AC)';
                        break;
                      case 8:
                        $devPic =  '/images/battery/100AC.png';
                        $devStat =  '100% (On AC)';
                        break;
                      default:
                        $devPic =  '/images/battery/Faulty.png';
                        $devStat =  'Faulty';
                        break;
                    }
                  } else {
                    switch ($state1Bat) {
                      case 0:
                        $devPic =  '/images/battery/Faulty.png';
                        $devStat =  'Faulty';
                        break;
                      case 1:
                        $devPic =  '/images/battery/30B.png';
                        $devStat =  '30% (On Battery)';
                        break;
                      case 2:
                        $devPic =  '/images/battery/40B.png';
                        $devStat =  '40% (On Battery)';
                        break;
                      case 3:
                        $devPic =  '/images/battery/50B.png';
                        $devStat =  '50% (On Battery)';
                        break;
                      case 4:
                        $devPic =  '/images/battery/60B.png';
                        $devStat =  '60% (On Battery)';
                        break;
                      case 5:
                        $devPic =  '/images/battery/70B.png';
                        $devStat =  '70% (On Battery)';
                        break;
                      case 6:
                        $devPic =  '/images/battery/80B.png';
                        $devStat =  '80% (On Battery)';
                        break;
                      case 7:
                        $devPic =  '/images/battery/90B.png';
                        $devStat =  '90% (On Battery)';
                        break;
                      case 8:
                        $devPic =  '/images/battery/100B.png';
                        $devStat =  '100% (On Battery)';
                        break;
                      default:
                        $devPic =  '/images/battery/Faulty.png';
                        $devStat =  'Faulty';
                        break;
                    }
                  }
                  $device->registered = $devPic;
                  $device->userExceptions = $devStat;


            }

            if(array_key_exists(0, $type)){
                $deviceTypes[$device->type] = $type[0]->name;
                $device->type= $type[0]->name;

            }
        }
        //dd($devices);
        $num_hubs = count($hubsForAccount);

        return view('networkstatus', [
            'devices'  => $allDevices,
            'hubs'  => $hubsForAccount,
            'master'  => $master,
            'types'  => $deviceTypes,



            'num_hubs'  => $num_hubs,

        ]);
    }
    public function settings(){

        return view('settings', [
        ]);
    }

    public function reports(ProductDataTable $dataTable){
        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
        // $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
        // $allTests = [];
        // foreach($hubsForAccount as $hub){
        //     $tests = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hub->hubSerial.'"');
        //     $allTests = array_merge($allTests, $tests);

        // }
        $allDevices = 0;
        $master = 0;

        $hubSerials = [];
        foreach($hubsForAccount as $hub){
            $hubSerials[] = $hub->hubSerial;
            $devices = \DB::table('devices')->where('hub_serial_no', $hub->hubSerial)->count();
            $allDevices += $devices;
            $master += \DB::table('devices')->where('hub_serial_no', $hub->hubSerial)->where('type', '045')->count();


        }


        // foreach($allTests as &$test){
        //     $device = \DB::select('SELECT * FROM devices WHERE serial_no ="'.$test->deviceSerial.'"');

           
        //     if(array_key_exists(0, $device)){
        //         $type = \DB::select('SELECT * FROM device_types WHERE code ="'.$device[0]->type.'"');
        //         $test->extra1 =  $device[0]->device_name;

        //         if(array_key_exists(0, $type)){
        //             $test->extra2 = $type[0]->name;
    
        //         }
        //     }


        // }
        //dd($devices);
        $num_hubs = count($hubsForAccount);

        return $dataTable->with('hubs', $hubSerials)->render('reports', [
            'devices'  => $allDevices,

            'hubs'  => $hubsForAccount,

            'num_hubs'  => $num_hubs,
            'master'  => $master,

        ]);


    }

    public function index() {
        $sales = 0;
        $sale_returns = 0;
        $purchase_returns = 0;
        $product_costs = 0;


        $revenue = ($sales - $sale_returns) / 100;
        $profit = $revenue;

        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
       // $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
       $allDevices = 0;
       $master = 0;

       $hubSerials = [];
       foreach($hubsForAccount as $hub){
           $hubSerials[] = $hub->hubSerial;
           $devices = \DB::table('devices')->where('hub_serial_no', $hub->hubSerial)->count();
           $allDevices += $devices;
            $master += \DB::table('devices')->where('hub_serial_no', $hub->hubSerial)->where('type', '045')->count();


       }





        return view('home', [
            'num_hubs'         => count($hubsForAccount),
            'devices'          => $allDevices,
            'master'          => $master,


            'sale_returns'     => $sale_returns / 100,
            'purchase_returns' => $purchase_returns / 100,
            'profit'           => $profit
        ]);
    }

    public function hubs() {

        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
        //$hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE hubName LIKE "%GB%" GROUP BY hubName');

        $deviceStats = [];
        foreach($hubsForAccount as $hubForAccount){


            $deviceStats[$hubForAccount->hubSerial]['api_response'] = FALSE;     

            $deviceStats[$hubForAccount->hubSerial]['active'] = $hubForAccount->hubIsActive;


            $deviceStats[$hubForAccount->hubSerial]['off'] = '-';


            $deviceStats[$hubForAccount->hubSerial]['on'] = '-';

            $deviceStats[$hubForAccount->hubSerial]['total'] = '-';



            $deviceStats[$hubForAccount->hubSerial]['name'] = $hubForAccount->hubName;

            
            $percentageOff = 0;
            if(isset($deviceStats[$hubForAccount->hubSerial]['off']))   
                $percentageOff = 100;
            $deviceStats[$hubForAccount->hubSerial]['percentOff'] = '-';
            $deviceStats[$hubForAccount->hubSerial]['status'] = 'Connecting..';
            $deviceStats[$hubForAccount->hubSerial]['statusH'] = '#aaa';



                
        }
        return view('hubs', [
            'hubs' => $deviceStats
            
        ]);
    }

    public function hubOverviewInit(Request $request){
        $data = $request->all();

        $deviceStats = [];


        $totalHubDevices = [];
        $hubResDevices = $this->getDevicesS($data["hubSer"]);
        if(str_contains($hubResDevices, "IntelliHub not responding")){
            $hubForAccount = \DB::select('SELECT * FROM hubPermissions WHERE hubSerial = "'.$data["hubSer"].'"')[0];
            $deviceStats['on'] = 0;
            $deviceStats['off'] = 0;
            $lastOnlineDevs = \DB::select('SELECT * FROM lastOnline WHERE hubSerial ="'.$hubForAccount->hubSerial.'"');
            if(count($lastOnlineDevs) < 1){
                $deviceStats['api_response'] = false;     
                $deviceStats['active'] = $hubForAccount->hubIsActive;


                $deviceStats['off'] = 0;
 

                $deviceStats['on'] = 0;

                $deviceStats['total'] = 0;


    
                $deviceStats['name'] = $hubForAccount->hubName;
    
                
                $percentageOff = 0;
                if(isset($deviceStats['off']))   
                    $percentageOff = 100;
                $deviceStats['percentOff'] = $percentageOff;
                $deviceStats['status'] = 'Online';
                $deviceStats['statusH'] = '#ccc';
    
                if($percentageOff > 80){
                    $deviceStats['status'] = 'Offline';
                    $deviceStats['statusH'] = '#aaa';
    
                }
            }
            foreach($lastOnlineDevs as $lastOnlineDev){
    
                $deviceStats['api_response'] = false;
                $deviceStats['active'] = $hubForAccount->hubIsActive;

                $deviceStats[$lastOnlineDev->serial]['status'] = $lastOnlineDev->extra;
    
    
                switch($lastOnlineDev->extra){
                    case 'Offline':
                        if(isset($deviceStats['off']))
                            $deviceStats['off']++;
                        else
                            $deviceStats['off'] = 1;
                        break;
                    case 'Online':
                        if(isset($deviceStats['on']))
                            $deviceStats['on']++;
                        else
                            $deviceStats['on'] = 1;
                        break;
                }
                if(isset($deviceStats['total']))
                    $deviceStats['total']++;
                else
                    $deviceStats['total'] = 1;


    
                $deviceStats['name'] = $hubForAccount->hubName;
    
                
                $percentageOff = 0;
                if(isset($deviceStats['off']))   
                    $percentageOff = $deviceStats['off']/$deviceStats['total']*100;
                $deviceStats['percentOff'] = $percentageOff;
                $deviceStats['status'] = 'Online';
                $deviceStats['statusH'] = '#ccc';
    
                if($percentageOff > 80){
                    $deviceStats['status'] = 'Offline';
                    $deviceStats['statusH'] = '#aaa';
    
                }
    
                    
            }
        }else{
            $hubResDevices = json_decode($hubResDevices, true);
            array_push($totalHubDevices , ...$hubResDevices['live_response']);
            $page = 1;
            while(count($hubResDevices['live_response']) == 8){
                $page++;
                $hubResDevices = $this->getDevicesS($data["hubSer"], $page);
                $hubResDevices = json_decode($hubResDevices, true);
                array_push($totalHubDevices , ...$hubResDevices['live_response']);
    
            }
            //dd($totalHubDevices);
    
            $hubForAccount = \DB::select('SELECT * FROM hubPermissions WHERE hubSerial = "'.$data["hubSer"].'"')[0];
            $deviceStats['on'] = 0;
            $deviceStats['off'] = 0;
            //dd($totalHubDevices);
            foreach($totalHubDevices as $totalHubDevice){
    
                $deviceStats['api_response'] = true;
                $deviceStats['active'] = $hubForAccount->hubIsActive;
    
                $deviceStats[$totalHubDevice['serial_no']]['status'] = $totalHubDevice['state'];
    
    
    
                switch($totalHubDevice['state']){
                    case '019':
                    case '010':
                        if(isset($deviceStats['off']))
                            $deviceStats['off']++;
                        else
                            $deviceStats['off'] = 1;
                        break;
                    default:
                        if(isset($deviceStats['on']))
                            $deviceStats['on']++;
                        else
                            $deviceStats['on'] = 1;
                        break;
    
    
                }
                if(isset($deviceStats['total']))
                    $deviceStats['total']++;
                else
                    $deviceStats['total'] = 1;
    
    
    
                $deviceStats['name'] = $hubForAccount->hubName;
    
                
                $percentageOff = 0;
                if(isset($deviceStats['off']))   
                    $percentageOff = $deviceStats['off']/$deviceStats['total']*100;
                $deviceStats['percentOff'] = $percentageOff;
                $deviceStats['status'] = 'Online';
                $deviceStats['statusH'] = '#3CBC3C';
    
                if($percentageOff > 80){
                    $deviceStats['status'] = 'Offline';
                    $deviceStats['statusH'] = '#FF2828';
                }
            }
        }


        return response()->json($deviceStats);

        
    }




    function hubInfoResponse($liveResponse) {
        global $totalResponse;
      
        $respSplit = explode('&', $liveResponse);
        array_splice($respSplit, 0, 1);
      
        $type = "";
        switch ($respSplit[13]) {
          case '102\n' : $type = 'ProEM IntelliHub'; break;
          case '100\n' : $type = 'Control IntelliHub V1'; break;
          case '101\n' : $type = 'Control IntelliHub V2'; break;
          case '102' : $type = 'ProEM IntelliHub'; break;
          case '100' : $type = 'Control IntelliHub V1'; break;
          case '101' : $type = 'Control IntelliHub V2'; break;
          case 102 : $type = 'ProEM IntelliHub'; break;
          case 100 : $type = 'Control IntelliHub V1'; break;
          case 101 : $type = 'Control IntelliHub V2'; break;
          default : $type = 'IntelliHub - ' + $respSplit[13]; break;
        }
      
      
        $resp = ['type'=>$type];
        $resp['version'] = $respSplit[1];
        $resp['serial'] = $respSplit[0];
        $resp['hubTime'] = $respSplit[6];
        $resp['timeZone'] = $respSplit[7];
        $resp['connectivity'] = $respSplit[9];
        $resp['isUpgrading'] = $respSplit[12];
        $resp['radioChannel'] = $respSplit[10];
      
        $totalResponse['live_response'] = $resp;
        $response = json_encode($totalResponse);
        return $response;
      }

    function genericSLResponse($liveResponse) {
        global $totalResponse;
      
        $respSplit = explode('=', $liveResponse);
        array_splice($respSplit, 0, 1);
      
        $totalResponse['live_response'] = $respSplit;
        $response = json_encode($totalResponse);
        return $response;
    }

    function getResponseResponseBuilder($liveResponse, $hubSerial){

        global $totalResponse;
        global $conn;
      
        $cmd_type = $_POST['responseForCmdType'];
        $called = $_POST['responseForCmdType'];
      
        if($called == 'setGeyserSchedule'){
      
          $schArr = ['days'=>''];
          $schArr['days'] = '01010110';
          $schArr['index'] = '1';
          $schArr['startHour'] = '10';
          $schArr['startMins'] = '01';
          $schArr['duration'] = '300';
      
          $totalResponse['dummy_resp'] = $schArr;
        }else if($called == 'setTollenoSchedule'){
          $schArr = ['days'=>''];
          $schArr['days'] = '01010110';
          $schArr['index'] = '1';
          $schArr['startHour'] = '10';
          $schArr['startMins'] = '01';
          $schArr['duration'] = '300';
          $schArr['relay'] = '3';
      
          $totalResponse['dummy_resp'] = $schArr;
      
        }else if($called == 'createEditProEMSelfTest'){
      
          $schArr = ['days'=>''];
          $schArr['days'] = '255';
          $schArr['index'] = '1';
          $schArr['startHour'] = '10';
          $schArr['startMins'] = '01';
          $schArr['duration'] = '300';
          $schArr['w49t56'] = '255';
          $schArr['w41t48'] = '255';
          $schArr['w33t40'] = '255';
          $schArr['w25t32'] = '255';
          $schArr['w17t24'] = '255';
          $schArr['w9t16'] = '255';
          $schArr['w1t8'] = '255';
      
          $totalResponse['dummy_resp'] = $schArr;
      
      
      
          $respSplit = explode('=', $liveResponse);
          array_splice($respSplit, 0, 1);
      
          $ints = bin2hex($liveResponse);
            
              $index = hexdec(substr( $ints, 16, 2 )); 
              $days = hexdec(substr( $ints, 18, 2 )); 
              $hour = hexdec(substr( $ints, 20, 2 )); 
              $minutes = hexdec(substr( $ints, 22, 2 )); 
              $duration = hexdec(substr( $ints, 24, 4 )); 
              $w49t56 = hexdec(substr( $ints, 28, 2 )); 
              $w41t48 = hexdec(substr( $ints, 30, 2 )); 
              $w33t40 = hexdec(substr( $ints, 32, 2 )); 
              $w25t32 = hexdec(substr( $ints, 34, 2 )); 
              $w17t24 = hexdec(substr( $ints, 36, 2 )); 
              $w9t16 = hexdec(substr( $ints, 38, 2 )); 
              $w1t8 = hexdec(substr( $ints, 40, 2 )); 
      
      
          $liveRespArr['index'] = $index;
          $liveRespArr['days'] = $days;
          $liveRespArr['hour'] = $hour;
          $liveRespArr['minutes'] = $minutes;
          $liveRespArr['duration'] = $duration;
          $liveRespArr['w49t56'] = $w49t56;
          $liveRespArr['w41t48'] = $w41t48;
          $liveRespArr['w33t40'] = $w33t40;
          $liveRespArr['w25t32'] = $w25t32;
          $liveRespArr['w17t24'] = $w17t24;
          $liveRespArr['w9t16'] = $w9t16; 
          $liveRespArr['w1t8'] = $w1t8;
      
          $totalResponse['live_response'] = $liveRespArr;
      
          $response = json_encode($totalResponse);
          return  $response;
      
      
        //   $sql12 = "SELECT * FROM proEM_Schedules WHERE pSchedDSerial = '$deviceSerialForResponse' AND pSchedIdx = '$index'";
        //   $result12 = $conn->query($sql12);
      
        //   if ($result12->num_rows > 0) {
        //     $sql11 = "UPDATE proEM_Schedules SET pSchedDays = '$days', pSchedHour = '$hour', pSchedMin = '$minutes', pSchedDurA = '0', pSchedDurB = '$duration', pSchedw49t56 = '$w49t56', pSchedw41t48 = '$w41t48', pSchedw33t40 = '$w33t40', pSchedw25t32 = '$w25t32', pSchedw17t24 = '$w17t24', pSchedw9t16 = '$w9t16', pSchedw1t8 = '$w1t8', pSchedHex = '', pSchedHubSerial = '$hubSerial' WHERE pSchedDSerial = '$deviceSerialForResponse' AND pSchedIdx = '$index'";
        //   } else {
        //     $sql11 = "INSERT INTO proEM_Schedules (pSchedDSerial, pSchedIdx, pSchedDays, pSchedHour, pSchedMin, pSchedDurA, pSchedDurB, pSchedw49t56, pSchedw41t48, pSchedw33t40, pSchedw25t32, pSchedw17t24, pSchedw9t16, pSchedw1t8, pSchedHex, pSchedHubSerial) 
        //     VALUES ('$deviceSerialForResponse', '$index', '$days', '$hour', '$minutes', '0', '$duration', '$w49t56', '$w41t48', '$w33t40', '$w25t32', '$w17t24', '$w9t16', '$w1t8', '', '$hubSerial')";
        //   }
      
        //   $result11 = $conn->query($sql11);
      
      
        }else if($called == 'getGensenseTemps'){
      
          $schArr = ['upper'=>''];
          $schArr['upper'] = '210';
          $schArr['lower'] = '3';
      
          $totalResponse['dummy_resp'] = $schArr;
        }else if($called == 'getGeyserExtra'){
      
          $schArr = ['errors'=>''];
          $schArr['errors'] = '0';
          $schArr['geyserTemp'] = '25';
          $schArr['solarTemp'] = '55';
          $schArr['maxTemp'] = '50';
          $schArr['variance'] = '5';
          $schArr['schedActive'] = '1';
          $schArr['monitoring'] = '1';
      
          $totalResponse['dummy_resp'] = $schArr;
      
        }else if($called == 'getProEMExtra'){
      
          $schArr = ['vLoad'=>''];
          $schArr['vLoad'] = '750';
          $schArr['vc1'] = '740';
          $schArr['vc2'] = '650';
      
          $totalResponse['dummy_resp'] = $schArr;
      
          $respSplit = explode('=', $liveResponse);
          array_splice($respSplit, 0, 1);
      
          $ints = bin2hex($liveResponse);
            
              $num3 = hexdec(substr( $ints, 16, 2 )); 
              $num3b = hexdec(substr( $ints, 18, 2 )); 
              $num4 = hexdec(substr( $ints, 20, 4 )); 
              $num5b = hexdec(substr( $ints, 24, 4 )); 
              $num7 = hexdec(substr( $ints, 28, 4 )); 
              $num9 = hexdec(substr( $ints, 32, 4 )); 
              $num10 = hexdec(substr( $ints, 36, 4 )); 
      
      
          $liveRespArr['vLoad'] = $num4;
          $liveRespArr['vc1'] = $num5b;
          $liveRespArr['vc2'] = $num7;
      
          $totalResponse['live_response'] = $liveRespArr;
      
          $response = json_encode($totalResponse);
          return  $response;
      
        }else if($called == 'getProEMSchedules'){
      
          $schArr = ['days'=>''];
          $schArr['days'] = '255';
          $schArr['index'] = '1';
          $schArr['startHour'] = '10';
          $schArr['startMins'] = '01';
          $schArr['duration'] = '300';
          $schArr['w49t56'] = '255';
          $schArr['w41t48'] = '255';
          $schArr['w33t40'] = '255';
          $schArr['w25t32'] = '255';
          $schArr['w17t24'] = '255';
          $schArr['w9t16'] = '255';
          $schArr['w1t8'] = '255';
      
          $totalResponse['rawRes'] = $liveResponse;
      
      
      
          $respSplit = explode('=', $liveResponse);
          
          array_splice($respSplit, 0, 1);
      
          $ints = bin2hex($liveResponse);
            
              $index = hexdec(substr( $ints, 16, 2 )); 
              $days = hexdec(substr( $ints, 18, 2 )); 
              $hour = hexdec(substr( $ints, 20, 2 )); 
              $minutes = hexdec(substr( $ints, 22, 2 )); 
              $duration = hexdec(substr( $ints, 24, 4 )); 
              $w49t56 = hexdec(substr( $ints, 28, 2 )); 
              $w41t48 = hexdec(substr( $ints, 30, 2 )); 
              $w33t40 = hexdec(substr( $ints, 32, 2 )); 
              $w25t32 = hexdec(substr( $ints, 34, 2 )); 
              $w17t24 = hexdec(substr( $ints, 36, 2 )); 
              $w9t16 = hexdec(substr( $ints, 38, 2 )); 
              $w1t8 = hexdec(substr( $ints, 40, 2 )); 
      
      
          $liveRespArr['index'] = $index;
          $liveRespArr['days'] = $days;
          $liveRespArr['hour'] = $hour;
          $liveRespArr['minutes'] = $minutes;
          $liveRespArr['duration'] = $duration;
          $liveRespArr['w49t56'] = $w49t56;
          $liveRespArr['w41t48'] = $w41t48;
          $liveRespArr['w33t40'] = $w33t40;
          $liveRespArr['w25t32'] = $w25t32;
          $liveRespArr['w17t24'] = $w17t24;
          $liveRespArr['w9t16'] = $w9t16; 
          $liveRespArr['w1t8'] = $w1t8;
      
          $totalResponse['live_response'] = $liveRespArr;
      
          $response = json_encode($totalResponse);
          return $response;
      
        //   $sql13 = "SELECT * FROM proEM_Schedules WHERE pSchedDSerial = '$deviceSerialForResponse' AND pSchedIdx = '$index'";
        //   $result13 = $conn->query($sql13);
      
        //   if ($result13->num_rows > 0) {
        //     $sql14 = "UPDATE proEM_Schedules SET pSchedDays = '$days', pSchedHour = '$hour', pSchedMin = '$minutes', pSchedDurA = '0', pSchedDurB = '$duration', pSchedw49t56 = '$w49t56', pSchedw41t48 = '$w41t48', pSchedw33t40 = '$w33t40', pSchedw25t32 = '$w25t32', pSchedw17t24 = '$w17t24', pSchedw9t16 = '$w9t16', pSchedw1t8 = '$w1t8', pSchedHex = '', pSchedHubSerial = '$hubSerial' WHERE pSchedDSerial = '$deviceSerialForResponse' AND pSchedIdx = '$index'";
        //   } else {
        //     $sql14 = "INSERT INTO proEM_Schedules (pSchedDSerial, pSchedIdx, pSchedDays, pSchedHour, pSchedMin, pSchedDurA, pSchedDurB, pSchedw49t56, pSchedw41t48, pSchedw33t40, pSchedw25t32, pSchedw17t24, pSchedw9t16, pSchedw1t8, pSchedHex, pSchedHubSerial) 
        //     VALUES ('$deviceSerialForResponse', '$index', '$days', '$hour', '$minutes', '0', '$duration', '$w49t56', '$w41t48', '$w33t40', '$w25t32', '$w17t24', '$w9t16', '$w1t8', '', '$hubSerial')";
        //   }
      
        //   $result14 = $conn->query($sql14);
      

      
        }else if($called == 'getPairedDevices'){
      
          $schArr = ['devices'=>'111111111,222222222,333333333'];
      
          $totalResponse['dummy_resp'] = $schArr;
      
      
        }else if($called == 'onOff'){
          $totalResponse['dummy_resp'] = '200';
      
          // $respSplit = explode('=', $liveResponse);
          $respSplit = preg_split('/[=,]/', $liveResponse);
          array_splice($respSplit, 0, 1);
      
          $totalResponse['live_response'] = $respSplit[0];
          $response = json_encode($totalResponse);
          return $response;
        }
    }



    function deviceListResponse($liveResponse, $hubSerial) {
        global $totalResponse;
        global $conn;
      
        $respSplit = explode('&', $liveResponse);
        array_splice($respSplit, 0, 1);
      
        $devArr = [];
        foreach ($respSplit as $deviceInArr) {
          $singleDevice = $respSplit = preg_split('/[,<>]/', $deviceInArr);
      
          $device = ['index'=>$singleDevice[0]];
          $device['mac'] = $singleDevice[1];
          $device['serial'] = $singleDevice[2];
          $device['type'] = $singleDevice[3];
          $device['state'] = $singleDevice[4];
          $device['tier'] = $singleDevice[5];
          $device['route1'] = $singleDevice[6];
          $device['route2'] = $singleDevice[7];
          $device['route3'] = $singleDevice[8];
          $device['route4'] = $singleDevice[9];
          $device['route5'] = $singleDevice[10];
          $device['route6'] = $singleDevice[11];
          $device['route7'] = $singleDevice[12];
          $device['neighbourCount'] = $singleDevice[13];
          $device['neighbour1'] = $singleDevice[14];
          $device['neighbour2'] = $singleDevice[15];
          $device['neighbour3'] = $singleDevice[16];
          $device['neighbour4'] = $singleDevice[17];
          $device['state2'] = $singleDevice[19];
          $device['version'] = $singleDevice[20];
          //TODO: write to devices table
      
          $serial = $singleDevice[2];
          $idx = $singleDevice[0];
          $type = $singleDevice[3];
          $mac = $singleDevice[1];
          $state = $singleDevice[4];
          $state2 = $singleDevice[19];
          $state3 = $singleDevice[20];
          
      
          $name = "";
          $favorite = "";
          $area = "";
          $reg = "";
          $dtreg = "";
          $s4 = "";
          $e1 = "";
          $e2 = "";
          $ds1 = "";
          $ds2 = "";
          $ds3 = "";
          $ds4 = "";
          $linkedTo = "";
          $delay = "";
          $rc = "";
          $added = "";
          $ip = "";
          $sql2 = "SELECT * FROM devices WHERE serial_no = '$serial'";
            $device = \DB::select($sql2)[0];
            //dd($device);
      
          if ($device) {
              $name = $device->device_name; 
              $favorite = $device->favorite; 
              $area = $device->d_area; 
              $reg = $device->registered; 
              $dtreg = $device->date_time_registered; 
              $s4 = $device->state4; 
              $e1 = $device->extra1; 
              $e2 = $device->extra2; 
              $ds1 = $device->devSpecific1; 
              $ds2 = $device->devSpecific2; 
              $ds3 = $device->devSpecific3; 
              $ds4 = $device->devSpecific4; 
              $linkedTo = $device->linkedTo; 
              $delay = $device->responseDelay; 
              $rc = $device->retryCount; 
              $added = $device->added; 
              $ip = $device->device_ip; 
          }
      
          $sql5 = "REPLACE INTO devices (serial_no, device_index, device_name, type, mac_address, favorite, hub_serial_no, d_area, registered, date_time_registered, state, state2, state3, state4, extra1, extra2, devSpecific1, devSpecific2, devSpecific3, devSpecific4, linkedTo, responseDelay, retryCount, added, device_Ip) 
                        VALUES ('$serial', '$idx', '$name', '$type', '$mac', '$favorite', '$hubSerial', '$area', '$reg', '$dtreg', '$state', '$state2', '$state3', '$s4', '$e1', '$e2', '$ds1', $ds2, '$ds3', '$ds4', '$linkedTo', '$delay', '$rc', '$added', '$ip')";
        //$resp5 = \DB::statement($sql5);
          
          array_push($devArr, $device);
        }
      
        $totalResponse['live_response'] = $devArr;
        $response = json_encode($totalResponse);
        return $response;
      }

    

    function socketHandler($message,$hubSerial){
        $response = "";
        global $cmd;
      
        $host    = "156.38.138.36";
        $port    = 7419;
        // create socket
        $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
        // connect to server
        $result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");
        // The message array  ontains all 100 pages requests for a single hub as well as the handshake code.
        // I use &$m as I want to work with the actual array not an instance of it. This way I can dynamically edit and respond to the handshake without having to have multiple methods.
        // The & just means its pointing to that specific location in memory.
        foreach($message as &$m){
          socket_write($socket, $m, strlen($m)) or die("Could not connect to server\n");
          socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 3, 'usec' => 0));
          // get server response
          socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 3, 'usec' => 0));
          //I removed the code to kill the process if the hub doesn't respond so it will just keep trying other hubs.
          //I need to add code to check if a hub does not respond to stop trying it and move onto a different hub.
          $result = socket_read ($socket, 2048) or die("IntelliHub not responding\n");
          
      
      
          switch ($m) {
            case 'u':    $result_arr = explode ("?", $result);   $message[1] = "au?" . $result_arr[1] . "," . $hubSerial;  break;
            case (substr( $m, 0, 3 ) === "au?"):    break;
            default:   break;
          }
          switch ($result) {
            case (substr( $result, 0, 2 ) === "hl"):    $response .= $this->deviceListResponse($result, $hubSerial); break;
            case (substr( $result, 0, 3 ) === "eul"):    $response .=  $result; $response +=  "|"; break;
            case (substr( $result, 0, 2 ) === "hi"):    $response .= $this->hubInfoResponse($result); break;
            case (substr( $result, 0, 3 ) === "log"):    $response .= $this->logResponse($result); break;
            case (substr( $result, 0, 2 ) === "sl"): 
              if(strpos($cmd, 'Response') != false) {
                $response .= $this->getResponseResponseBuilder($result, $hubSerial); break;
              }else{
                $response .= $this->genericSLResponse($result); break;
              }

              break;
            case (substr( $result, 0, 2 ) === "hv"):    $response .= $this->genericSLResponse($result); break;
            case (substr( $result, 0, 2 ) === "cl"):    $response .= $this->genericSLResponse($result); break;
            default:   break;
          }
        }
        socket_close($socket);
        return $response;
    }
    function getDevicesS($hubSerial, $page = 0){

        global $totalResponse;
        $comsPass = \DB::select('SELECT coms_password FROM hubs WHERE hub_serial_no = "'.$hubSerial.'"')[0]->coms_password;
        //dd($comsPass);
      
        $totalResponse = ['errors'=>''];
        $totalResponse['sent'] = $hubSerial . ' | hub';
      
          $hiMessages = ["u"];
          array_push($hiMessages, "au?");
          array_push($hiMessages,"ss!".$hubSerial.",hl?pw=".$comsPass."&part=".$page."\n");
          return $this->socketHandler($hiMessages, $hubSerial);

    }

    public function testChart() {
        abort_if(!request()->ajax(), 404);

        $currentMonthSales = 10;
        $currentMonthPurchases = 10;
        $currentMonthExpenses = 10;
        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');


        $testsPassed = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'" AND testResult = "Passed" ORDER BY STR_TO_DATE(dateString, "%d-%m-%Y") DESC');
        $testsFailed = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'" AND testResult = "Failed" ORDER BY STR_TO_DATE(dateString, "%d-%m-%Y") DESC');

        return response()->json([
            'passed'     => count($testsPassed),
            'failed'     => count($testsFailed),
        ]);
    }

    public function testChartw() {
        abort_if(!request()->ajax(), 404);

        $currentMonthSales = 10;
        $currentMonthPurchases = 10;
        $currentMonthExpenses = 10;
        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');


        $testsPassed = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'" AND testResult = "Passed" AND testType = "Weekly" ORDER BY STR_TO_DATE(dateString, "%d-%m-%Y") DESC');
        $testsFailed = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'" AND testResult = "Failed" AND testType = "Weekly" ORDER BY STR_TO_DATE(dateString, "%d-%m-%Y") DESC');

        return response()->json([
            'passed'     => count($testsPassed),
            'failed'     => count($testsFailed),
        ]);
    }

    public function testChartm() {
        abort_if(!request()->ajax(), 404);

        $currentMonthSales = 10;
        $currentMonthPurchases = 10;
        $currentMonthExpenses = 10;
        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');


        $testsPassed = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'" AND testResult = "Passed" AND testType = "Monthly" ORDER BY STR_TO_DATE(dateString, "%d-%m-%Y") DESC');
        $testsFailed = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'" AND testResult = "Failed" AND testType = "Monthly" ORDER BY STR_TO_DATE(dateString, "%d-%m-%Y") DESC');

        return response()->json([
            'passed'     => count($testsPassed),
            'failed'     => count($testsFailed),
        ]);
    }

    public function testChartbi() {
        abort_if(!request()->ajax(), 404);

        $currentMonthSales = 10;
        $currentMonthPurchases = 10;
        $currentMonthExpenses = 10;
        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');


        $testsPassed = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'" AND testResult = "Passed" AND testType = "Bi-Annual" ORDER BY STR_TO_DATE(dateString, "%d-%m-%Y") DESC');
        $testsFailed = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'" AND testResult = "Failed" AND testType = "Bi-Annual" ORDER BY STR_TO_DATE(dateString, "%d-%m-%Y") DESC');

        return response()->json([
            'passed'     => count($testsPassed),
            'failed'     => count($testsFailed),
        ]);
    }

    public function testChartan() {
        abort_if(!request()->ajax(), 404);

        $currentMonthSales = 10;
        $currentMonthPurchases = 10;
        $currentMonthExpenses = 10;
        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');


        $testsPassed = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'" AND testResult = "Passed" AND testType = "Annual" ORDER BY STR_TO_DATE(dateString, "%d-%m-%Y") DESC');
        $testsFailed = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'" AND testResult = "Failed" AND testType = "Annual" ORDER BY STR_TO_DATE(dateString, "%d-%m-%Y") DESC');

        return response()->json([
            'passed'     => count($testsPassed),
            'failed'     => count($testsFailed),
        ]);
    }



    public function currentMonthChart() {
        abort_if(!request()->ajax(), 404);

        $currentMonthSales = 10;
        $currentMonthPurchases = 10;
        $currentMonthExpenses = 10;
        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
       // $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
        $lastOnlineDevs = \DB::select('SELECT * FROM lastOnline WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'"');
        $deviceStats = [];
        foreach($lastOnlineDevs as $lastOnlineDev){
    
            $deviceStats['api_response'] = false;
            //$deviceStats['active'] = $hubForAccount->hubIsActive;

            $deviceStats[$lastOnlineDev->serial]['status'] = $lastOnlineDev->extra;


            switch($lastOnlineDev->extra){
                case 'Offline':
                    if(isset($deviceStats['off']))
                        $deviceStats['off']++;
                    else
                        $deviceStats['off'] = 1;
                    break;
                case 'Online':
                    if(isset($deviceStats['on']))
                        $deviceStats['on']++;
                    else
                        $deviceStats['on'] = 1;
                    break;
            }
            if(isset($deviceStats['total']))
                $deviceStats['total']++;
            else
                $deviceStats['total'] = 1;



            //$deviceStats['name'] = $hubForAccount->hubName;

            
            $percentageOff = 0;
            if(isset($deviceStats['off']))   
                $percentageOff = $deviceStats['off']/$deviceStats['total']*100;
            $deviceStats['percentOff'] = $percentageOff;
            $deviceStats['status'] = 'Online';
            $deviceStats['statusH'] = '#ccc';

            if($percentageOff > 80){
                $deviceStats['status'] = 'Offline';
                $deviceStats['statusH'] = '#aaa';

            }

                
        }

        return response()->json([
            'sales'     => $deviceStats['on'],
            'purchases' => $currentMonthPurchases,
            'expenses'  => $deviceStats['off'],
        ]);
    }


    public function salesPurchasesChart() {
        abort_if(!request()->ajax(), 404);

        $sales = $this->salesChartData();
        $purchases = $this->purchasesChartData();

        return response()->json(['sales' => $sales, 'purchases' => $purchases]);
    }


    public function paymentChart() {
        abort_if(!request()->ajax(), 404);

        $dates = collect();
        foreach (range(-11, 0) as $i) {
            $date = Carbon::now()->addMonths($i)->format('m-Y');
            $dates->put($date, 0);
        }

        $date_range = Carbon::today()->subYear()->format('Y-m-d');

        $sale_payments = [];
        $sale_return_payments = [];

        $purchase_payments = [];

        $purchase_return_payments = [];

        $expenses = [];

        $payment_received = array_merge_numeric_values($sale_payments, $purchase_return_payments);
        $payment_sent = array_merge_numeric_values($purchase_payments, $sale_return_payments, $expenses);

        $dates_received = $dates->merge($payment_received);
        $dates_sent = $dates->merge($payment_sent);

        $received_payments = [];
        $sent_payments = [];
        $months = [];

        foreach ($dates_received as $key => $value) {
            $received_payments[] = $value;
            $months[] = $key;
        }

        foreach ($dates_sent as $key => $value) {
            $sent_payments[] = $value;
        }

        return response()->json([
            'payment_sent' => $sent_payments,
            'payment_received' => $received_payments,
            'months' => $months,
        ]);
    }

    public function salesChartData() {
        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addDays($i)->format('d-m-y');
            $dates->put($date, 0);
        }

        $date_range = Carbon::today()->subDays(6);

        $sales = [];
        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
        $testsPassed = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'" AND testResult = "Passed" ORDER BY STR_TO_DATE(dateString, "%d-%m-%Y") DESC');
        
        $dates = $dates->merge($sales);

        $data = [];
        $days = [];
        foreach ($testsPassed as $key => $value) {
            $data[] = 1;
            $days[] = $value->dateString;
        }

        return response()->json(['data' => $data, 'days' => $days]);
    }


    public function purchasesChartData() {
        $dates = collect();
        foreach (range(-6, 0) as $i) {
            $date = Carbon::now()->addDays($i)->format('d-m-y');
            $dates->put($date, 0);
        }

        $date_range = Carbon::today()->subDays(6);

        $purchases = [];        
        $hubsForAccount = \DB::select('SELECT * FROM hubPermissions WHERE email = "'.\Auth::user()->email.'"');
        $testsPassed = \DB::select('SELECT * FROM TestHistory WHERE hubSerial ="'.$hubsForAccount[0]->hubSerial.'" AND testResult = "Failed" ORDER BY STR_TO_DATE(dateString, "%d-%m-%Y") DESC');
        

        $dates = $dates->merge($testsPassed);


        $data = [];
        $days = [];
        foreach ($testsPassed as $key => $value) {
            $data[] = 1;
            $days[] = $value->dateString;
        }

        return response()->json(['data' => $data, 'days' => $days, 'dates' => $dates]);

    }

    public function login2(Request $request){
        
        $data = $request->all();
		$user = User::where('email', $data['email'])->where('password', $data['password'])->first();
		if($user){
            \Auth::login($user, false);
            return redirect()->route('home');
		}

		return redirect()->route('login');
    }
}
