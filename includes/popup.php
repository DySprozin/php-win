<?php
sleep (5);
$WshShell = new COM("WScript.Shell");
$WshShell->Popup("�������", 1);

sleep(100);
exit();