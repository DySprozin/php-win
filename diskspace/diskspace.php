<?php

$WshShell = new COM("WScript.Shell");

while(TRUE) {
 $disk_free = disk_free_space("E:");
 $disk_all = disk_total_space("E:");
 $percent = round(($disk_free / $disk_all) * 100);
 sleep(1);
 echo "On disk E:\ free $percent%\n";
 if ($percent < 10) {
  $WshShell->Popup("� �����-�� �� �����... ����... ( ������ $percent%", 0, "������!", 4096+64);
 }
}