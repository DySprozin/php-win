<?php
sleep (5);
$WshShell = new COM("WScript.Shell");
$WshShell->Popup("Успешно", 1);
//4096 - always up
// $WshShell->Popup("Копирование оригинального файла", 1, "MaxichromH - Подождите, идет обработка...", 4096+1); 

//16 Stop.
//32 Question.
//48 Exclamation.
//64 Information.


sleep(100);
exit();