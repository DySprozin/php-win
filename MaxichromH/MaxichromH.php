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
 $g = glob("C:/Users/Админ/Desktop/1.03 H/Хроматограммы/*.crm");
 $local_chr = glob("chr_orig/*.crm");
 foreach ($g as $value) {
 	if (!in_array('chr_orig/' . basename($value), $local_chr)) {
			copy($value, 'chr_orig/' . basename($value));
 		chrome($value);
 		break;
 	}
 }
	sleep(10);
}

function chrome($f) {
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
		 $i++;
			$value = $value + $min;
			$value = str_replace(".", ",", $value);
 	 $result .= $i . ";" . ($value) . "\r\n";
	}
	$ftmp = fopen($fout, "w+");
 fwrite($ftmp, $result);
 fclose($ftmp);
 $im = imagegrabwindow($handle);
 imagepng($im, $sout);
 imagedestroy($im);
	unlink("tmp_chr.txt");
}
?>