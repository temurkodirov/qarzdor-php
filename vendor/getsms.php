
<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: *"); 
header('Access-Control-Allow-Methods: *'); 
header('Access-Control-Allow-Credentials: true'); 

$curl = curl_init();

$sms = [
    [
        'phone' => '998889997730',
        'text'  => 'Salom men ',
    ]
   
];
$data = 'login='.urlencode('Temur');
$data .= '&password='.urlencode('BpEX1gdMEV6pElDdZ9d3');
if (isset($nickname)) {
    $data .= '&nickname='.urlencode($nickname);
}
$data .= '&data='.urlencode(json_encode($sms));
curl_setopt($curl, CURLOPT_URL, 'http://185.8.212.184/smsgateway/');
curl_setopt($curl, CURLOPT_HEADER, 0); 
curl_setopt($curl, CURLOPT_POST, 1); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5); 
curl_setopt($curl, CURLOPT_TIMEOUT, 5); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 
curl_setopt($curl, CURLOPT_USERAGENT, 'Opera 10.00');
 
$res = curl_exec($curl); 
echo $res; 
curl_close($curl);