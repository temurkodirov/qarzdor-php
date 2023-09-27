
<button><a onclick="ortga()" href="../sendmsg.php">ortga qaytish</a></button>
<?php
session_start();

// check auth
if(!isset($_SESSION['user']['id'])){
    header('Location: login.php');
}
$uid= $_SESSION['user']['id']; 

require_once '../db.php';
//require_once 'IpUrl.php';



function sendSms(int $number=0, string $text='')
{
	$url = 'http://192.168.137.68:8080';
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

// function print_s($key = null, $die = FALSE) {
    
//     echo "<pre>";
//     print_r($key);
//     echo "</pre>";

//     if ($die) die;

// }


// print_s($_POST,1); // jsonni ko'rish

foreach($_POST['check_list'] as $dataID){
    $xrow = mysqli_query($db, "SELECT * FROM debt WHERE  id = $dataID
    AND debt.iduser = '$uid' ORDER BY debt.rDate ASC");
    $xrow = mysqli_fetch_assoc($xrow);

    // print_s($xrow);

	$tex = "Xurmatli mijoz siz vada qilgan kun yaqinlashmoqda,  {$xrow['amount']}  miqdordagi qarzingizni to'lab ketishingizni so'rab qolamiz. Xamjixat savdo lyuks";
	$num = $xrow['contact'];
	
	$num = (int) $num;
	if($num>1){
		sendSms($num,$tex);
	}
    
	print_s($xrow);
}
echo("Muvaffiqiyatlik jo'natildi");
// header("Location: ../past.php");
?>

<script>
	function ortga(){
		var result = confirm ('Ortga qaytaylikmi?');
		if (result == false) {
			event.preventDefault();
		}
	};
</script>

