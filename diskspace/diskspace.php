<?php

$WshShell = new COM("WScript.Shell");

while(TRUE) {
 $disk_free = disk_free_space("E:");
 $disk_all = disk_total_space("E:");
 $percent = round(($disk_free / $disk_all) * 100);
 if ($percent < 10) {
  $WshShell->Popup("� �����-�� �� �����... ����... ( ������ $percent%", 0, "������!", 4096+64);
 }
}