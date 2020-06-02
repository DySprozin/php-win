<?php
echo "Searching HANDLE...\r\n";
$handle = hexdec(system("hwnd_chr.exe"));

if ($handle == 0) {
	echo "\n\nERR. APP NOT FOUND!";
	sleep(10);
	exit();
}

echo "\r\nHANDLE IS FOUND! OK!";

while (true) {
 $g = glob("C:/Program Files (x86)/Цвет-Аналитик/ 1.03 H/Хроматограммы/_*.crm");
 $local_chr = glob("chr_orig/_*.crm");
 foreach ($g as $value) {
 	if (!in_array('chr_orig/' . basename($value), $local_chr)) {
			copy($value, 'chr_orig/' . basename($value));
 $WshShell = new COM("WScript.Shell");
 $WshShell->Popup("Копирование оригинального файла...", 1, "MaxichromH - Подождите, идет обработка...", 4096+1+48);

 		chrome($value);
 		break;
 	}
 }
	sleep(5);
}

function chrome($f) {
 $WshShell = new COM("WScript.Shell");
 $handle = $GLOBALS['handle'];
 $file_name = $f;
 $fout = "./converted/" . basename($f) . ".csv";
 $sout = "./converted/" . basename($f) . ".png";
 
 $file = gzopen($file_name, 'rb');
 $out_file = fopen("tmp_chr.txt", 'wb'); 
 
 // Keep repeating until the end of the input file
 while (!@gzeof($file)) {
     fwrite($out_file, @gzread($file, 100));
 }

 // Files are done, close files
 fclose($out_file);
 gzclose($file);
 
 $arr = file("tmp_chr.txt");
 $arr = $arr[10];
 $arr = str_replace("  ", " ", $arr);
 $arr = str_replace("  ", " ", $arr);
 $arr = str_replace("  ", " ", $arr);
 //$arr = str_replace(".", ",", $arr);
 $arr = explode(' ', $arr);
 $i = 0;
 $res_arr = array();
 foreach($arr as $value){
		$i++;
 	if (!($i % 25)) { //every 25'th string
 	 $value = round($value, 4);
 	 $res_arr[] = $value;
 	}
 }
	$min = -min($res_arr);
	$i = 0;
	$result = '';
	foreach ($res_arr as $value) {
		$value = $value + $min;
		$value = str_replace(".", ",", $value);
		$result .= $i . ";" . ($value) . "\r\n";
		$i++;

	}
	
 $WshShell->Popup("Распаковка...", 1, "MaxichromH - Подождите, идет обработка...", 4096+1+64);

	
 $ftmp = fopen($fout, "w+");
 fwrite($ftmp, $result);
 fclose($ftmp);
 $im = imagegrabwindow($handle);
 imagepng($im, $sout);
 imagedestroy($im);
	unlink("tmp_chr.txt");
 $WshShell->Popup("Заливка на github...", 1, "MaxichromH - Подождите, идет обработка...", 4096+1+64);	
 system('cd "C:\G\php-win\MaxichromH\converted" && git add . && git commit . -m "add converted files" && git push');
 $WshShell = new COM("WScript.Shell");
 $WshShell->Popup("Успешно!", 2, "MaxichromH", 4096+1+64);
}
?>