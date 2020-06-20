<?php


$token = trim(join('',file("c:\\smstoken")));

if (!empty($_POST['sms'])) {
 $mts_var = array(910, 915, 916, 917, 919, 985, 986);
 $sms = $_POST['sms'];
 $phone = $_POST['phone'];
 $code = substr($phone,1,3);
 if (!in_array($code,$mts_var)) exit("mts only!");

 $MSXML2 = new COM("MSXML2.XMLHTTP");
 $MSXML2->open("GET","https://semysms.net/api/3/sms.php?token=$token&device=active&phone=$phone&msg=$sms","false");
 $MSXML2->send();

 Header("Location: sms.php");
 exit();
}

// echo '<meta http-equiv="refresh" content="5">';
echo <<<TEST
<form action="" method="post">
Телефон: <input type="text" name="phone" style="width:200px" placeholder="891231231234"><br>
Сообщение: <input type="text" name="sms" style="width:200px"><br>
<input type="submit">
</form>
TEST;


