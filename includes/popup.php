<?php
sleep (5);
$WshShell = new COM("WScript.Shell");
$WshShell->Popup("�������", 1);
//4096 - always up
// $WshShell->Popup("����������� ������������� �����", 1, "MaxichromH - ���������, ���� ���������...", 4096+1); 

//16 Stop.
//32 Question.
//48 Exclamation.
//64 Information.


sleep(100);
exit();