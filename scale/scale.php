<?php
include "includes/phpSerial.php";
use phpSerial\phpSerial;
$comport = "COM1";

// Let's start the class
$serial = new phpSerial;


$serial->_os = "windows";


// First we must specify the device. This works on both linux and windows (if
// your linux serial device is /dev/ttyS0 for COM1, etc)
$serial->deviceSet($comport);

// We can change the baud rate, parity, length, stop bits, flow control
$serial->confBaudRate(2400);
$serial->confParity("even");
$serial->confCharacterLength(8);
$serial->confStopBits(1);
$serial->confFlowControl("none");
exec("mode $comport: dtr=on");
// Then we need to open it
$serial->deviceOpen();

// To write into
$serial->sendMessage("Hello !");

// Or to read from
$read = "";
while(true) {
  usleep(1000);
//  echo $read;
  $read = $serial->readPort();
  if(preg_match("#.*g.*#isU",$read)) {
  $res = (float)$read;
  if ($res <= 201) $res = number_format($res,3);
  else $res = number_format($res,2);
  if ($res > 0.005 && $res_tmp != $res) echo $res . "\n";
  $res_tmp = $res;
  }
}
?>