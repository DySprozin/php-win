<?php
sleep (5);
$WshShell = new COM("WScript.Shell");
$WshShell->Popup("Успешно", 3);

sleep(100);
exit();