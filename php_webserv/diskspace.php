<?php

 echo '<meta http-equiv="refresh" content="5">';

 $e_disk_free = disk_free_space("E:");
 $e_disk_all = disk_total_space("E:");
 $c_disk_free = disk_free_space("C:");
 $c_disk_all = disk_total_space("C:");
 $e_percent = round(($e_disk_free / $e_disk_all) * 100);
 $c_percent = round(($c_disk_free / $c_disk_all) * 100);
 echo "On disk E:\ free $e_percent%<br>";
 echo "On disk C:\ free $c_percent%";

