<?php

foreach (glob("json/*") as $value) {
echo $value;
$f = join('', file($value));
echo $f;
$f1 = json_decode($f);
$f = json_encode($f1, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
echo $f;
fwrite(fopen("json_pretty/".basename($value), "w+"),$f);
}