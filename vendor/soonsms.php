<?php
session_start();


// check auth
if(!isset($_SESSION['user']['id'])){
	header('Location: login.php');
}
$uid= $_SESSION['user']['id']; 

require_once '../db.php';
//require_once 'IpUrl.php';

$xrow = mysqli_query($db, "SELECT * FROM debt WHERE  debt.rDate > now()
 AND debt.rDate < date_add(now(), INTERVAL 7 day) AND debt.iduser = '$uid' ORDER BY debt.rDate ASC");
$xrow = mysqli_fetch_all($xrow);

function sendSms(int $number=0, string $text='')
{
	$url = 'http://192.168.193.224:8080';

	if ($number == 0 && $text == '') return null;
	$array = array(
	'number'    => $number,
	'text' => $text
	);		
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array, '', '&'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$json = curl_exec($ch);
	curl_close($ch);
	return $json;
}

// debug
// function print_s($key = null) {
//     echo "<pre>";
//     print_r($key);
//     echo "</pre>";
// }


// $send = sendSms(, ""); // json qaytaradi
// $obj = json_decode($send);

// if ($obj->status) echo 'ok';
// else echo $obj->message;


foreach($xrow as $xcell){
	$tex = "Xurmatli mijoz siz vada qilgan kun yaqinlashmoqda,  {$xcell[5]}  miqdordagi qarzingizni to'lab ketishingizni so'rab qolamiz. Xamjixat savdo lyuks";
	$num = $xcell[3];
	$num = (int) $num;
	if($num>1){
		sendSms($num,$tex);
	}
	print_s($xrow); // jsonni ko'rish
}

//header("Location: ../soon.php");
?>