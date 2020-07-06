<?php

$com = "COM2";

$output = exec("mode $com: BAUD=2400 PARITY=N data=8 stop=1 XON=off TO=on dtr=off odsr=off octs=off rts=on idsr=off");
$fp = fopen("COM2", "r+b");
if (!$fp)
{
  exit("Unable to establish a connection");
}
while(true) {
 sleep(0.1);
 $t = "Q1\r";
 $writtenBytes = fwrite($fp, $t);
 
 $j=0;
 $dataset1 = [];
 while(!stream_get_line($fp,1)) { 1; }
 while(!$buffer=stream_get_line($fp,45)) { 1; }
 
 if (!preg_match("#\s00000001$#isU",$buffer)) echo date("d.m.Y H:i:s ") . $buffer . "\r\n";
 
 
}
 fclose($fp);

?>
