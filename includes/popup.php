<?php
sleep (5);
$WshShell = new COM("WScript.Shell");
$WshShell->Popup("�������", 3);

sleep(100);
exit();