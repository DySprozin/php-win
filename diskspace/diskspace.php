<?php

$WshShell = new COM("WScript.Shell");

while(TRUE) {
 $e_disk_free = disk_free_space("E:");
 $e_disk_all = disk_total_space("E:");
 $c_disk_free = disk_free_space("C:");
 $c_disk_all = disk_total_space("C:");
 $e_percent = round(($e_disk_free / $e_disk_all) * 100);
 $c_percent = round(($c_disk_free / $c_disk_all) * 100);
 sleep(1);
 echo "On disk E:\ free $e_percent%\n";
 echo "On disk C:\ free $c_percent%\n";
 if ($e_percent < 10) {
  $WshShell->Popup("А место-то на диске E:\ ... тютю... ( меньше $e_percent%", 0, "АХТУНГ!", 4096+64);
 }
 if ($c_percent < 10) {
  $WshShell->Popup("А место-то на диске C:\... тютю... ( меньше $c_percent%", 0, "АХТУНГ!", 4096+64);
 }
 echo "\n";
}