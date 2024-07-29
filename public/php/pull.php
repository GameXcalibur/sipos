<?php
error_reporting(E_ALL);
////echo '<head><style>body {background-color: black;color: white;}</style></head>';
////echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
////echo '<body>';
////echo '<div  class="row justify-content-center" style="background-color: black;">';
////echo '<input type="text" id="logSearch" placeholder="Hub Serial"/>';
////echo '</div>';
////echo '<div  id="logDiv" class="row justify-content-center" style="background-color: black;">';
$devDone = [];

$stepsAsArray = [[]];
$steps60AsArray = array();
$testRes = array();

$serials = [];
$finalArray = array();
$lastHub = "false";
$proEMHubs = array();
// //////echo $_GET['server'] . " : " . $_GET['group'];
$serverToUse = "B";
$group = "I";

$allDevicesOnHub = array();

$res1 = '';

$log_code = array();
$log_code[0] = "prev_net_cnt"; 
$log_code[1] = "req_status"; 
$log_code[2] = "cmd_disc";
$log_code[3] = "join_cnt";
$log_code[4] = "req_tier_disc";
$log_code[5] = "cmd_join";
$log_code[6] = "ack_ep_onoff";
$log_code[7] = "cmd_onoff";
$log_code[8] = "req_nbour";
$log_code[9] = "poll_status";
$log_code[10] = "main_idle";
$log_code[11] = "saving";
$log_code[12] = "restoring";
$log_code[13] = "dev_upgrading";
$log_code[14] = "resp_disc";
$log_code[15] = "resp_join";
$log_code[16] = "resp_onoff";
$log_code[17] = "resp_status";
$log_code[18] = "resp_nbours";
$log_code[19] = "rly_ep_onoff";
$log_code[20] = "unknown_cmd";
$log_code[21] = "passkey_incorr";
$log_code[22] = "cc1101_part";
$log_code[23] = "cc1101_ver";
$log_code[24] = "hub_ver";
$log_code[25] = "cfg_ver";
$log_code[26] = "hub_upgraded";
$log_code[27] = "data_flash";
$log_code[28] = "set_ver";
$log_code[29] = "ipd";
$log_code[30] = "dhcp";
$log_code[31] = "net_disc";
$log_code[32] = "net_socket";
$log_code[33] = "ntp";
$log_code[34] = "resp_upgrade";
$log_code[35] = "scene_initial";
$log_code[36] = "scene_or";
$log_code[37] = "scene_output";
$log_code[38] = "scene_compare";
$log_code[39] = "tcp_socket";
$log_code[40] = "udp_socket";
$log_code[41] = "find";
$log_code[42] = "resp_en_upgrade";
$log_code[43] = "change_channel";
$log_code[44] = "resp_chg_channel";
$log_code[45] = "cmd_hello";
$log_code[46] = "resp_hello";
$log_code[47] = "re_rly_ep_onoff";
$log_code[48] = "cc1101_rx_state";
$log_code[49] = "scene_out_upgrade";
$log_code[50] = "scene_out_notify";
$log_code[51] = "cmd_sch";
$log_code[52] = "resp_sch";
$log_code[53] = "cmd_extra";
$log_code[54] = "resp_extra";
$log_code[55] = "idle_join";
$log_code[56] = "remote_ka";
$log_code[57] = "remote_retry";
$log_code[58] = "scene_out_return";
$log_code[59] = "scene_out_delay";
$log_code[60] = "emc_status";
$log_code[61] = "mfind";

require "connect.php";

//First we send "s" to get a list of all hubs. the list is returned as a string formatted ready for the MySQLi statement IN()
if($serverToUse == "A"){
  socketHandler(["s"], "");
}else if($serverToUse == "B"){
  socketHandler(["list"], "");
}
//When we receive the hub serial list we pull all the passwords from the db and create an array containing the serial and the password of each hub connected to the server.
function breakAndGetHubs($hubList){
  global $conn;
  global $serverToUse;
  // //////echo $hubList . "<br>";
  $list = $hubList;
  if($serverToUse == "B"){
    $list = $str = substr($hubList, 9);
  }
  // //////echo "_+_+_+_+_+_+_+";
  // //////echo $list;
  // //////echo "_+_+_+_+_+_+_+";
  //$query = "SELECT hub_serial_no, coms_password FROM hubs WHERE hub_serial_no IN(". $list .")" ;
$query = "SELECT hubSerial FROM hubPermissions WHERE hubSerial = '".$_GET["h"]."'" ; //779878178

  $data=mysqli_query($conn,$query)or die(mysqli_error());
  $hubs = array();
  while($row=mysqli_fetch_array($data)){
    $query1 = "SELECT hub_serial_no, coms_password FROM hubs WHERE hub_serial_no = '".$row['hubSerial']."'" ;
    $data1=mysqli_query($conn,$query1)or die(mysqli_error());
    while($row1=mysqli_fetch_array($data1)){
      array_push($hubs, array("Serial"=>$row1['hub_serial_no'], "password"=>$row1['coms_password']));

    }

  }
  // buildLogMessages($hubs);
  getHIs($hubs);
}

// 849572906,214994272,631199422,723582605,886644221,215276552,860608100,914774870,575183224,333043713,571180814,968411048,805828156,860330163,491889383,987504891,998496019,127374261,005512551,047013083,795791026,163668474,533954946,099326840,090466034,168751551,669280592,987654300,078008493,512602924,702949104,481282822,988275046 14994272,631199422,723582605,886644221,215276552,860608100,914774870,575183224,333043713,571180814,968411048,805828156,860330163,491889383,987504891,998496019,127374261,005512551,047013083,795791026,163668474,533954946,099326840,090466034,168751551,669280592,987654300,078008493,512602924,702949104,481282822,988275046

// http://156.38.138.34/RelayServerPullLogs/pullLogsA.php?server=A&group=A
// lynx -dump http://156.38.138.34/RelayServerPullLogs/pullLogsA.php?server=A&group=A
function getHIs($hubs){

// //////echo "<br>";
// print_r($hubs);
  global $group;
  global $proEMHubs;
  $hubsSplit = array();

    foreach ($hubs as $h) {
     // if(substr( $h["Serial"], 0, 1 ) == "1"){
         array_push($hubsSplit, array("Serial"=>$h["Serial"], "password"=>$h["password"]));
     // }
    }

  foreach ($hubsSplit as $value) {
    $hiMessages = ["u"];
    array_push($hiMessages, "au?");
    array_push($hiMessages,"ss!".$value["Serial"].",hi?pw=".$value["password"]."\n");
    // array_push($logMessages,"ss!".$value["Serial"].",hi?pw=".$value["password"]);
    socketHandler($hiMessages, $value["Serial"]);
  }

  // //////echo "Well it reaches this ";
  // print_r($proEMHubs);
  // print_r($proEMHubs);
  if(count($proEMHubs) > 0){
    buildLogMessages($proEMHubs);
  }else{
    //////echo "No proEM Hubs Connected";
  }
}

// This is our socket function. It also accepts an array of messages.
// The idea is that it opens the socket, sends all its messages and retrieves responses then closes. this saves time and requests cause I dont need to handshake everytime and spares opens and closes
// The switch case isn't great as it doesn't work according to the response but rather the message. so I am not checkign if I am gettign the correct response. this needs improving. But for now it works.
// It calls the relevant method to handle the response depending on the messages sent.
function socketHandler($message,$hubSerial){
  global $proEMHubs;
  global $serverToUse;
  $poes = array();

  if($serverToUse == "A"){
    $host    = "156.38.138.34";
  }else if($serverToUse == "B"){
    // //////echo "B" . "<br>";
    $host    = "156.38.138.36";
  }

  $port    = 7419;
  // create socket
  $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
  // connect to server
  $result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");
  // The message array  ontains all 100 pages requests for a single hub as well as the handshake code.
  // I use &$m as I want to work with the actual array not an instance of it. This way I can dynamically edit and respond to the handshake without having to have multiple methods.
  // The & just means its pointing to that specific location in memory.

  foreach($message as &$m){
    socket_write($socket, $m, strlen($m)) or die("Could not send data to server\n");
    socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 3, 'usec' => 0));
    // get server response
    socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 3, 'usec' => 0));
    //I removed the code to kill the process if the hub doesn't respond so it will just keep trying other hubs.
    //I need to add code to check if a hub does not respond to stop trying it and move onto a different hub.
    // //////echo $m . "<br>";
    $result = socket_read ($socket, 2048); //or die("Could not read server response\n")

    // //////echo $result . "<br>";

    ////echo $result;
    switch ($m) {
      case 's':           breakAndGetHubs(substr($result, 0, -1));  break; //   $breakandsplit = str_replace(",","<br>",$result); //////echo $breakandsplit; break; //
      case 'list':        breakAndGetHubs($result);  break; //   $breakandsplit = str_replace(",","<br>",$result); //////echo $breakandsplit; break; //
      case 'u':    $result_arr = explode ("?", $result);   $message[1] = "au?" . $result_arr[1] . ",".$hubSerial;  break;
      case (substr( $m, 0, 3 ) === "au?"):    break;
      case (substr( $m, 13, 2 ) === "hi"):
      if(strlen($result) < 81 ){
        $result = $result . "&100";
      }
      if (substr( $result, 80, 3 ) == "102" || substr( $result, 77, 3 ) == "102"){  array_push($proEMHubs, array("Serial"=>substr($m, 3, 9), "password"=>substr($m, 19, strpos($m, "\n", 19))));  }
      break;
      case (substr( $result, 0, 7 ) === "log=200"):   $page = explode('&',$m);  getLogs($result,$hubSerial,$page[1]);  break;
      // Use explode to get page number by splitting at &
      default:  //////echo "I missed a cmd <br>" . $m . "<br>"; break;
    }
  }
  // Set timeout options for writing and reading
  socket_close($socket);
  // return $result;
}

// hi=200&208358472&03,197,21,21&011&000&020&2&3784534447&7200&196,26,5,10&1&9&1&0&102
// hi=200&215276552&03,195,21,21&011&000&020&2&3784534451&0&196,26,5,10&1&7&1&0&102

$ii = 1;
function buildLogMessages($hubs){
  global $ii;
  global $lastHub;
  foreach ($hubs as $value) {
    $logMessages = ["u"];
    array_push($logMessages, "au?");
    for ($i=100; $i >= 0 ; $i--) {
      array_push($logMessages,"ss!".$value["Serial"].",log?pw=".$value["password"]."&".$i."\n");
    }
    // array_push($logMessages,"ss!".$value["Serial"].",hi?pw=".$value["password"]);


    $ii++;
    if(count($hubs) == $ii){
      $lastHub = "true";
    }

    socketHandler($logMessages, $value["Serial"]);

  }



}

// startGetLogs($socket, $initiate);
// function startGetLogs(){
//   socket_write($socket, $initiateS, strlen($initiateS)) or die("Could not send data to server\n");
//   // get server response
//   $result = socket_read ($socket, 1024) or die("Could not read server response\n");
//
//   // Set timeout options for writing and reading
//   socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
//   socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));
//
//   //////echo "Reply From Server  :".$result."<br>";
//
//   if (substr( $result, 0, 3 ) === "au?") {
//     $result_arr = explode ("?", $result);
//
//     $handShakeResponse = "au?" . $result_arr[1] . ",333043713";
//
//     // Write the response
//     socket_write($socket, $handShakeResponse, strlen($handShakeResponse)) or die("Could not send data to server\n");
//     // get server response
//     $result = socket_read ($socket, 1024) or die("Could not read server response\n");
//     //////echo "Reply From Server  :".$result."<br>";
//
//     if ($result == "au"){
//       getLogs($socket, 1);
//     }
//   }
// }

function getLogs($result,$hubSerial,$page){
  // global $socket;
  global $stepsAsArray;
  global $steps60AsArray;
  global $finalArray;
  global $lastHub;
  global $conn;
  global $allDevicesOnHub;


  // global $conn;

  // //////echo

  // //////echo $page . '<br>';

  $splitSerials = array();
  // global $serials;
  // // Request logs
  // // $requestLogs = "ss!112081985,log?pw=ek1wt0f9o1vm4y&".$page."\n";
  // $requestLogs = "ss!333043713,log?pw=btdzp01j2ubkmf&".$page."\n";
  //
  // // Write the response
  // socket_write($socket, $requestLogs, strlen($requestLogs)) or die("Could not send data to server\n");
  // // get server response
  // // sleep(1);
  // $result = socket_read ($socket, 2048) or die("Could not read server response\n");
  // //////echo "Reply From Server  :".$result."<br>";
  $fullResponceHex = unpack("H*",$result);
  // //////echo $fullResponceHex;
  // $first4Characters = substr($fullResponceHex[1], 16, 8);

  responseToSteps($fullResponceHex[1], $hubSerial);
  // $first4CharactersSwapped = swapEndianness($first4Characters);
  // $first4CharactersAsDecimal = hexdec($first4CharactersSwapped);
  // //////echo $first4CharactersAsDecimal . "<br>";

  //uncomment this

  if ($page == 0){






    // //////echo '\n\n-----------------------------------------------------------\n';
    //print_r($fullResponceHex[1]);
    // //////echo '\n\n-----------------------------------------------------------\n';

    ksort($stepsAsArray);
    // //////echo '\n\n-----------------------------------------------------------\n';
    //print_r($stepsAsArray);
    // //////echo '\n\n-----------------------------------------------------------\n';
    foreach ($stepsAsArray as $key => $value) {
      if (count($value) > 0){
        if ($value["Code"] == 60){
          // //////echo "Time " . $value["Time"] . " Serial " . $value["Serial"] . " Hub Serial " . $hubSerial . "<br>";
          // //////echo $timeStamp = date('D, d M Y, h:i:s', ($value["Time"] - 2208988800));
          // //////echo '<br>';
          $serials[$value["Serial"]] = ["Time"=>$value["Time"], "Serial"=>$value["Serial"], "Val1"=>$value["Val1"], "Val2"=>$value["Val2"], "HubSerial"=>$hubSerial, "Val3"=>$value["Val3"]];
        }
      }
    }
    array_push($finalArray,$serials);
    $serials = [];
    $stepsAsArray = [];
    if ($lastHub == "true"){

      $query9 = "SELECT serial FROM lastOnline WHERE hubSerial = '$hubSerial'" ;
      $data9=mysqli_query($conn,$query9)or die(mysqli_error($conn));
      while($row9=mysqli_fetch_array($data9)){
        array_push($allDevicesOnHub, $row9['serial']);
      }

      $control = false;

      // 3816870033
      // 3816872501
      // 3816873325
      // 3816874151
      // 3816874992
      // 3816875820
      // 3816876771
  //     // //////echo "<br>";
  //     // //////echo "=======";
  //     // //////echo "<br>";
  //     // //////echo "<br>";
  //     // //////echo "=======";
  //     // //////echo "<br>";
  //     // print_r($finalArray);
      writetolastOnlineTable($finalArray);
  //
  //     // print_r($steps60AsArray);
      ksort($steps60AsArray);

      foreach ($steps60AsArray as $value) {
        // //////echo "<br>";
        // print_r($value);
        $splitSerials[$value["Serial"]] = array();

        // //////echo "<br>";
      }
  //
      foreach ($steps60AsArray as $value) {
        // //////echo "<br>";

        array_push($splitSerials[$value["Serial"]], $value);


      }
  //
      $dateS = "";
      $deviceS = "";
      $s1 = "";
      $s2 = "";
      $s3 = "";
      $testR = "n";
      $testT = "n";
      $dateAsS = "";
      $hubS = "";
  //


      foreach($splitSerials as $value){

        $oldState1Gen = $value[0]["Val1"] / 10;
        $oldState1Bat = $value[0]["Val1"] % 10;
  //
        // //////echo $oldState1Gen . "<br>";
        // //////echo $oldState1Bat . "<br>";
        $oldState2 = $value[0]["Val2"];
        // //////echo $oldState2 . "<br>";
        // //////echo "This is the old state st <br>";
        foreach($value as $v){
          // print_r($v);
          // //////echo "<br>";
  //
          $dateS = $v["TimeStamp"];
          $deviceS = $v["Serial"];
          $s1 = $v["Val1"];
          $s2 = $v["Val2"];
          $s3d = $v["Val3"];
          $dateAsS = $v["Time"];
          $hubS = $v["HubSerial"];

          $state1Bat = $v["Val1"] % 10;
          $state1Gen = $v["Val1"] / 10;
  //
          $s3b = sprintf( "%08d", decbin( $s3d ));

          $s3 = "";

          if(substr($s3b, 7, 1) == 1){$s3 .= " | Load short circuit";}
          if(substr($s3b, 6, 1) == 1){$s3 .= " | No load connected";}
          if(substr($s3b, 5, 1) == 1){$s3 .= " | Battery error";}
          if(substr($s3b, 4, 1) == 1){$s3 .= " | Battery low";}
  //
  //
  //
          // if($state1Gen != $oldState1Gen){
          //   //////echo $state1Gen . "<br>";
          //   if($state1Gen == 2){  //////echo "Load Error";  $testR = "Load Error";  $testT = "General"; writetoTestHistory($dateS,$deviceS,$s1,$s2,$testR,$testT,$dateAsS,$hubS,$s3);}
          //
          // }
          // if($state1Bat != $oldState1Bat){
          //   //////echo $state1Bat . "<br>";
          //   if($state1Bat == 6){  //////echo "Faulty Battery";  $testR = "Faulty Battery";  $testT = "General"; writetoTestHistory($dateS,$deviceS,$s1,$s2,$testR,$testT,$dateAsS,$hubS,$s3);  }
          //
          // }


          if(count($allDevicesOnHub) > 0){
            if (($key = array_search($deviceS, $allDevicesOnHub)) !== false) {
              unset($allDevicesOnHub[$key]);
            }
          }

          if($v["Val2"] != $oldState2){
            // //////echo $v["Val2"] . "<br>";
            $bin = decbin($v["Val2"]);
            while(strlen($bin) < 8){
              $bin = "0" . $bin;
            }

            if ($bin != "00000000"){




            //////echo $bin . "<br>";
            if (substr($bin, 6, 2) == 10){
                //////echo "Weekly Passed" . "<br>";

                $control = true;

                $testR = "Passed";
                $testT = "Weekly";
                $testIdx = 1;
                writetoTestHistory($dateS,$deviceS,$s1,$s2,$testR,$testT,$dateAsS,$hubS,$s3d,$testIdx);
                //////echo $dateS.' - '.$deviceS.' - '.$s1.' - '.$s2.' - '.$testR.' - '.$testT.' - '.$dateAsS.' - '.$hubS.' - '.$s3d . '<br>';
            }else if (substr($bin, 6, 2) == 11){
                //////echo "Weekly Failed" . "<br>";

$control = true;

                $testR = "Failed";
                $testT = "Weekly";
                $testIdx = 1;
                writetoTestHistory($dateS,$deviceS,$s1,$s2,$testR,$testT,$dateAsS,$hubS,$s3d,$testIdx);
                //////echo $dateS.' - '.$deviceS.' - '.$s1.' - '.$s2.' - '.$testR.' - '.$testT.' - '.$dateAsS.' - '.$hubS.' - '.$s3d . '<br>';
            }

            if (substr($bin, 4, 2) == 10){
                //////echo "Monthly Passed" . "<br>";

$control = true;

                $testR = "Passed";
                $testT = "Monthly";
                $testIdx = 2;
                writetoTestHistory($dateS,$deviceS,$s1,$s2,$testR,$testT,$dateAsS,$hubS,$s3d,$testIdx);
                //////echo $dateS.' - '.$deviceS.' - '.$s1.' - '.$s2.' - '.$testR.' - '.$testT.' - '.$dateAsS.' - '.$hubS.' - '.$s3d . '<br>';
            }else if (substr($bin, 4, 2) == 11){
                //////echo "Monthly Failed" . "<br>";

$control = true;

                $testR = "Failed";
                $testT = "Monthly";
                $testIdx = 2;
                writetoTestHistory($dateS,$deviceS,$s1,$s2,$testR,$testT,$dateAsS,$hubS,$s3d,$testIdx);
                //////echo $dateS.' - '.$deviceS.' - '.$s1.' - '.$s2.' - '.$testR.' - '.$testT.' - '.$dateAsS.' - '.$hubS.' - '.$s3d . '<br>';
            }

            if (substr($bin, 2, 2) == 10){
                //////echo "Bi Annual Passed" . "<br>";

                $control = true;

                $testR = "Passed";
                $testT = "Bi-Annual";
                $testIdx = 3;
                writetoTestHistory($dateS,$deviceS,$s1,$s2,$testR,$testT,$dateAsS,$hubS,$s3d,$testIdx);
                //////echo $dateS.' - '.$deviceS.' - '.$s1.' - '.$s2.' - '.$testR.' - '.$testT.' - '.$dateAsS.' - '.$hubS.' - '.$s3d . '<br>';
            }else if (substr($bin, 2, 2) == 11){
                //////echo "Bi Annual Failed" . "<br>";

                $control = true;

                $testR = "Failed";
                $testT = "Bi-Annual";
                $testIdx = 3;
                writetoTestHistory($dateS,$deviceS,$s1,$s2,$testR,$testT,$dateAsS,$hubS,$s3d,$testIdx);
                //////echo $dateS.' - '.$deviceS.' - '.$s1.' - '.$s2.' - '.$testR.' - '.$testT.' - '.$dateAsS.' - '.$hubS.' - '.$s3d . '<br>';
            }

            if (substr($bin, 0, 2) == 10){
                //////echo "Annual Passed" . "<br>";

                $control = true;

                $testR = "Passed";
                $testT = "Annual";
                $testIdx = 4;
                writetoTestHistory($dateS,$deviceS,$s1,$s2,$testR,$testT,$dateAsS,$hubS,$s3d,$testIdx);
                //////echo $dateS.' - '.$deviceS.' - '.$s1.' - '.$s2.' - '.$testR.' - '.$testT.' - '.$dateAsS.' - '.$hubS.' - '.$s3d . '<br>';
            }else if (substr($bin, 0, 2) == 11){
                //////echo "Annual Failed" . "<br>";

                $control = true;

                $testR = "Failed";
                $testT = "Annual";
                $testIdx = 4;
                // writetoTestHistory($dateS,$deviceS,$s1,$s2,$testR,$testT,$dateAsS,$hubS,$s3d,$testIdx);
                //////echo $dateS.' - '.$deviceS.' - '.$s1.' - '.$s2.' - '.$testR.' - '.$testT.' - '.$dateAsS.' - '.$hubS.' - '.$s3d . '<br>';
            }
          }
          }
          $oldState2 = $v["Val2"];
          $oldState1Gen = $v["Val1"] / 10;
          $oldState1Bat = $v["Val1"] % 10;
          // //////echo "<br>";
        }
      }
  //     // sortResults($finalArray);

      if($control){
        foreach($allDevicesOnHub as $valu){
          //////echo 'Updated device as offline - '.$dateS.' - '.$deviceS.' - '.$s1.' - '.$s2.' - Offline - '.$testT.' - '.$dateAsS.' - '.$hubS.' - '.$s3d . '<br>';
          // writetoTestHistory($dateS,$valu,$s1,$s2,'Offline',$testT,$dateAsS,$hubS,$s3d);
        }
      }
    }








  }
  // uncomment this
}
$GLOBALS['stepsAsArray'] = [[]];
function sortResults($fullArray){

  // //////echo $fullArray[2]["544498533"]["Time"];
}

function writetolastOnlineTable($finalArray){
global $conn;

// //////echo '<pre>';
// print_r($finalArray);
// //////echo '</pre>';

  foreach ($finalArray as $value) {
    foreach ($value as $final) {

      $stmt = $conn->prepare(  "REPLACE INTO `lastOnline`(`serial`, `time`, `Val1`, `Val2`, `hubSerial`, `extra`)
      VALUES ('". $final["Serial"] ."','". $final["Time"] ."','". $final["Val1"] ."','". $final["Val2"] ."','". $final["HubSerial"] ."','Online')");
      // //////echo $final["HubSerial"] . " " . $final["Serial"] . "<br>";
      //////echo("Updated Last online : " . $final["Serial"] . " : " . $final["HubSerial"] . " : " . $final["Time"] . " : " . $final["Val1"] . " : " . $final["Val2"] . "<br>");
      $stmt->execute();

      $stmt2 = $conn->prepare(  "UPDATE `devices` SET state = '" . $final["Val1"] . "', state2 = '" . $final["Val2"] . "' WHERE serial_no = '" . $final["Serial"] . "'");
      // //////echo $final["HubSerial"] . " " . $final["Serial"] . "<br>";
      //////echo("Updated device table : " . $final["Serial"] . " : " . $final["HubSerial"] . " : " . $final["Time"] . " : " . $final["Val1"] . " : " . $final["Val2"] . "<br>");
      $stmt2->execute();
      // //////echo $stmt->error;
      // $stmt->close();


      writeToStoredLogsProem($final["Serial"], $final["HubSerial"], $final["Time"], $final["Time"], $final["Val1"], $final["Val2"]);
    }
  }
			// $conn->close();
}

function writetoTestHistory($dateS,$deviceS,$s1,$s2,$testR,$testT,$dateAsS,$hubS,$s3,$testIdx){
  global $conn;
  
    // foreach ($finalArray as $value) {


  
    $sql2 = " SELECT * from TestHistory WHERE dateAsSeconds='$dateAsS' AND deviceSerial='$deviceS' AND hubSerial='$hubS'";
    $result2 = $conn->query($sql2);
    
    
    if($result2->num_rows > 0)
    {
      // $stmt = $conn->prepare(  "UPDATE `TestHistory` SET (`dateString`, `deviceSerial`, `state1`, `state2`, `testResult`, `testType`, `dateAsSeconds`, `hubSerial`, `extra3`)
      // VALUES ('$dateS','$deviceS','$s1','$s2','$testR','$testT','$dateAsS','$hubS','$s3')");
      // $stmt->execute();
      //////echo "already exists : " . $deviceS . " <br>";
    }else{
      // switch($testT){
      //   case "Weekly":
      //     $index = 1;
      //     break;
      //   case "Monthly":
      //     $index = 2;
      //     break;
      //   case "Bi-Annual":
      //     $index = 3;
      //     break;
      //   case "Annual":
      //     $index = 4;
      //     break;      
      // }
  
      // $sql = "SELECT * FROM proEM_Schedules WHERE pSchedIdx = ? AND (pSchedDSerial = ? OR pSchedHubSerial = ?);";
      // $stmnt = $conn->prepare($sql);
      // $stmnt->bind_param("sss", $index, $deviceS, $hubS);
      // $stmnt->execute();
      // $result = $stmnt->get_result();
  
      // foreach($result->fetch_all(MYSQLI_ASSOC) as $row) {
      //   if (empty($row['pSchedHubSerial'])){
      //     $returnSchedule = $row['pSchedDays'];
      //     break;
      //   } else {
      //     $returnSchedule = $row['pSchedDays'];
      //   }
      // }
  
      // function dayOfWeekFromSchedule($binaryDay){
      //   // gets the number representation of the day of the
      //   // week in same pattern as PHP DateTime week
      //   switch($binaryDay){
      //     case "2":
      //       return 1;
      //     case "4":
      //       return 2;
      //     case "8":
      //       return 3;
      //     case "16":
      //       return 4;
      //     case "32":
      //       return 5;
      //     case "64":
      //       return 6;
      //     case "128":
      //       return 0;
      //   }
      // }
  
      // $dayOfWeekSchedule = dayOfWeekFromSchedule($returnSchedule);
  
      // $testingDate = new DateTime($dateS);
      // $dayOfWeekTest = (int) $testingDate->format("w");
  
      // function getCorrectDate($finalDateOfTest, $weekDayPresented, $weekDayInSchedule){
      //   if ($weekDayPresented == $weekDayInSchedule){
      //     // return date if it was set to that day of the week.
      //     return $finalDateOfTest->format("D, d M Y, H:i:s");
      //   } else {
      //     // modify the day by how many days prior the test was (based on week day index):
      //       if ($weekDayInSchedule > $weekDayPresented){
      //         // if the schedule day is higher than test day, we're going
      //         // to set the days to remove to 1 week plus the negative value remaining after
      //         // we minus the schedule day of week number from week day presented number, for
      //         // example: test day says wed, schedule says fri. fri == 5 and wed == 3.
      //         // 5 - 3 = -2. 7 + (-2) = 5. wed - 5 days = previous week fri.
      //         $daysApart = 7 + ($weekDayPresented - $weekDayInSchedule);
      //       } else if ($weekDayInSchedule < $weekDayPresented){
      //         // if schedule day is lower, minus the amount it is away from the presented day
      //         // leaving the days in between the dates, eg:
      //         // weekday presented = fri = 5, week day in schedule = wed = 3.
      //         // 5 - 3 = 2.
      //         $daysApart = $weekDayPresented - $weekDayInSchedule;
      //       }
      //       // go back n days for the n calculated above.
      //       $finalDateOfTest->modify("-" . $daysApart . " days");
          
      //     return $finalDateOfTest->format("D, d M Y, H:i:s");
      //   }
      // }
      // $correctTestDate =  getCorrectDate($testingDate, $dayOfWeekTest, $dayOfWeekSchedule);


      $dateAsSControl = $dateAsS;
      $sql15 = "SELECT * from proEM_Schedules WHERE pSchedDSerial='$deviceS' AND pSchedIdx='$testIdx'";
      $result15 = $conn->query($sql15);
//var_dump($sql15);
      $dayOfWeek = 0;
  
      if($result15->num_rows > 0){
        while($rows = $result15->fetch_assoc()){
          switch ($rows['pSchedDays']) {
            case 2: $dayOfWeek = 1; break;
            case 4: $dayOfWeek = 2; break;
            case 8: $dayOfWeek = 3; break;
            case 16: $dayOfWeek = 4; break;
            case 32: $dayOfWeek = 5; break;
            case 64: $dayOfWeek = 6; break;
            case 128: $dayOfWeek = 7; break;
            default:
              $dayOfWeek = 1;
          }
        }
      }else{
            //////echo "SCHEDULE DOES NOT EXIST\n";
            return;
        }

      $dayOfReportAsInt = date('N', ($dateAsSControl - 2208988800));

      // //////echo '<br>';
      // //////echo $testIdx;
      // //////echo '<br>';
      // //////echo $deviceS;
      // //////echo '<br>';
      // //////echo $dayOfWeek;
      // //////echo '<br>';
      // //////echo $dayOfReportAsInt;
      // //////echo '<br>';
      while($dayOfReportAsInt != $dayOfWeek) {
        $dayOfReportAsInt -= 1;
          if($dayOfReportAsInt <= 0) {
            $dayOfReportAsInt = 7;
          }
          $dateAsSControl -= 86400;
      }
      
      $final = date('D, d M Y, h:i:s', ($dateAsSControl - 2208988800));

      $finalDateString = preg_replace("/\\s+/iu"," ",$final);
      // //////echo '<br>';
      // //////echo $final;
      // //////echo '<br>';
      // //////echo '<br>';

      // $conn->set_charset('latin1');
      $stmt = $conn->prepare(  "INSERT INTO `TestHistory`(`dateString`, `deviceSerial`, `state1`, `state2`, `testResult`, `testType`, `dateAsSeconds`, `hubSerial`, `extra3`, `printed`, `reportedDate`)
      VALUES ('$finalDateString','$deviceS','$s1','$s2','$testR','$testT','$dateAsS','$hubS','$s3', '0','$dateS')");
      $stmt->execute();
      //////echo "Stored : " . $finalDateString . " - " . $deviceS . " - " . $s1 . " - " . $s2 . " - " . $testR . " - " . $testT . " - " . $dateAsS . " - " . $hubS  . " - " . $dateS . " <br>";
  
  
  
      // $emailArr = Array();
      $mailList = "";
      $sql3 = " SELECT email from hubPermissions WHERE hubSerial='$hubS'";
      $result3 = $conn->query($sql3);
  
      if($result3->num_rows > 0){
        while($row = $result3->fetch_assoc()){
          // array_push($emailArr,$row['email']);
          $mailList .= $row['email'] . ",";
        }
      }
  
  
  
      $data =array( 'emails'=>'kyle@siluxcontrol.com,', 'devName'=>$deviceS, 'state3'=>$s3 );
      
      $options = array(
                       'http' => array(
                                       'header'  => "Content-type: application/x-www-form-urlencoded\r\n",  //the type of the content
                                       'method'  => 'POST',
                                       'content' => http_build_query($data),
                                       )
                       );
      
      $context  = stream_context_create($options);
      $result = file_get_contents("http://siluxcontrol.com/siluxcontrol/send/sendFailedDev.php", false, $context);
      //////echo $result;
  
  
  
    }
    // $stmt->close();
  
  
    // $conn->close();
  }


function writeToStoredLogsProem($deviceS,$hubS,$dateS,$dateAsS,$s1,$s2){
  global $conn;




  $date = new DateTime();
  $fin = $date->getTimestamp() + 2208988800;
  // $toDel = $fin - 2630000; // 1 Month
  $toDel = $fin - 7890000;


  $sql9 = " DELETE FROM stored_logs_proem WHERE unixTime < $toDel";
  $result9 = $conn->query($sql9);


  $sql2 = " SELECT * from stored_logs_proem WHERE unixTime='$dateAsS' AND devSerial='$deviceS' AND hubSerial='$hubS'";
  $result2 = $conn->query($sql2);

  if($result2->num_rows > 0){
    //////echo 'Already Exists <br>';
  }else{
    $stmt = $conn->prepare(  "INSERT INTO `stored_logs_proem`(`devSerial`, `hubSerial`, `unixTime`, `state1`, `state2`)
    VALUES ('$deviceS','$hubS','$dateAsS','$s1','$s2')");
    $stmt->execute();
    //////echo "Stored to storedLogs Proem : <br>";
  }
}



function responseToSteps($response, $hS){
  global $conn;

global $stepsAsArray;
global $steps60AsArray;
global $log_code;
global $testRes;
global $devDone;
$testInd = 1;
  $i = 1;
  $start = 16;
  // //////echo $response;
  while($i <= 33){
    // Get the 32 characters starting from the start value
    // Start value starts at 16 to skip the ascii part.
    $step = substr($response, $start, 32);
    // From there it increments by 32 characters to create 16 byte steps (2 Characters = 1 byte)
    $start = $start + 32;

    // Seperate the different values. Time, serial and val 3 are all 32bit (8 characters) and the rest are all 8bit (2 Characters)
    $timeD = substr($step, 0, 8);
    $levelD = substr($step, 8, 2);
    $codeD = substr($step, 10, 2);
    $serialD = substr($step, 12, 8);
    $val1D = substr($step, 20, 2);
    $val2D = substr($step, 22, 2);
    $val3D = substr($step, 24, 8);



    // Swap the byte order for the 32bit values
    $timeSD = swapEndianness($timeD);
    $serialSD = swapEndianness($serialD);
    $val3SD = swapEndianness($val3D);

    $val3SD2 = substr($val3SD, 0, 2);
    $val4SD = substr($val3SD, 2, 2);
    $val5SD = substr($val3SD, 4, 2);
    $val6SD = substr($val3SD, 6, 2);

    // Convert the values to decimal
    // //////echo $timeSD . '<br>';
    $time = hexdec($timeSD);
    $level = hexdec($levelD);
    $code = hexdec($codeD);
    $serial = hexdec($serialSD);
    $val1 = hexdec($val1D);
    $val2 = hexdec($val2D);
    $val3 = hexdec($val3SD2);
    $val4 = hexdec($val4SD);
    $val5 = hexdec($val5SD);
    $val6 = hexdec($val6SD);

    // $timeStamp = date('r', ($time - 2208988800));

    $mod = $val1 % 10;

    $timeStamp = date('D, d M Y, h:i:s', ($time - 2208988800));
    if($code == 60 ){

      if(strlen($serial) == 7){
        $serial = "00".$serial;
      }
      if(strlen($serial) == 8){
        $serial = "0".$serial;
      }


      $sql3 = " SELECT * from devices WHERE serial_no='$serial'";
      $result3 = $conn->query($sql3);
      $name = 'NOT FOUND';
      $type = 'NOT FOUND';

      if($result3->num_rows > 0){
        while($row = $result3->fetch_assoc()){
          // array_push($emailArr,$row['email']);
          $name = $row['device_name'];
          $type = $row['type'];

        }
      }

      $total = $val1+$val2+$val3+$val4+$val5+$val6;
      //if($val1 < 10 && $val2 < 10 && $val3 < 10 && $val4 < 10 && $val5 < 10 && $val6 < 10 ){
        if($type == '046'){
          $devDone[$serial] = 1;
          echo  $timeStamp.' - Serial: '.$serial.' ('.$name.') - Level: '.$level.' - Code: '.$code.' - Val 1: '.$val1.' - Val 2: '.$val2.' - Val 3: '.$val3.' - Val 4: '.$val4.' - Val 5: '.$val5.' - Val 6: '.$val6.'\r\n';

        }

      //}


    }
    
        //$testRes[$serial] = $testInd++;

    


   
        //if($code == 60 )
      ////echo '<div class="logCon col-md-5" style="background: #005522; border-radius: 10px; box-shadow: 5px 10px #888888; padding: 20px; margin: 5px; cursor: pointer; opacity: 1"><p style="color: black; font-size: 24px;">'.$hS.'</p><br>----------------------------------------------<br><b><span style="color: #11ee33">TIME: '.$timeStamp . "<br>CODE: " . $log_code[$code] . "<br>DEVICE SERIAL: " . $serial . "<br>VAL1: " . $val1 . "<br>VAL2: " . $val2 . "<br>VAL3: " . $val3 . "</span></b><br>----------------------------------------------<br></div>";


    if ($serial != 0 && strlen($serial) != 10){
        while (strlen($serial) < 9){
          $serial = "0".$serial;
        }
        // //////echo strlen($serial) . " " . $serial . "<br>";
        // array_push($stepsAsArray, array("Time"=>$time, "Level"=>$level, "Code"=>$code, "Serial"=>$serial, "Val1"=>$val1, "Val2"=>$val2, "Val3"=>$val3));
        $stepsAsArray[$time] = array("Time"=>$time, "Level"=>$level, "Code"=>$code, "Serial"=>$serial, "Val1"=>$val1, "Val2"=>$val2, "Val3"=>$val3);
        if ($code == "60"){
          // //////echo $code . " - " . $serial . " - " . $val1 . "<br>";
          // array_push($steps60AsArray[$time], array("Time"=>$time, "Level"=>$level, "Code"=>$code, "Serial"=>$serial, "Val1"=>$val1, "Val2"=>$val2, "Val3"=>$val3, "TimeStamp"=>$timeStamp, "HubSerial"=>$hS));
          $steps60AsArray[$time] = array("Time"=>$time, "Level"=>$level, "Code"=>$code, "Serial"=>$serial, "Val1"=>$val1, "Val2"=>$val2, "Val3"=>$val3, "TimeStamp"=>$timeStamp, "HubSerial"=>$hS);
        }
    }
    // while(strlen($serial) < 9){
    //   $serial = "0".$serial;
    //   //////echo $serial;
    // }

    // $timeConv = date('r', ($time - 2208988800)) . "<br>";
    // Insert all values into an array

    $i++;
  }
  // $testRes['total'] = $testInd;
  // echo json_encode($testRes);
}



function swapEndianness($hex) {
    return implode('', array_reverse(str_split($hex, 2)));
}
// close socket
$conn->close();
// socket_close($socket);
////echo '</div>';
////echo '<script>';
////echo'var input = document.getElementById("logSearch");';
////echo'input.addEventListener("input", myFunction);';
////echo'function myFunction(e) {';
////echo'var filter = e.target.value.toUpperCase();';
////echo'var list = document.getElementById("logDiv");';
////echo'var divs = list.getElementsByTagName("div");';
////echo'for (var i = 0; i < divs.length; i++) {var a = divs[i].getElementsByTagName("p")[0];if (a) {if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {divs[i].style.display = "";} else {divs[i].style.display = "none";}}}';
////echo'}';
////echo '</script>';
////echo '</body>';

echo $res1;
?>



