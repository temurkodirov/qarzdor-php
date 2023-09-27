<?php
// require_once 'db.php';



// 	$db = mysqli_query($db,"SELECT * FROM debt ORDER BY id DESC");
// 	$res = mysqli_fetch_assoc($db);
	
// 	$data = "name,comment,contact,adress,amount,gDate,rDate
// 	{$res['name']},{$res['comment']},{$res['contact']},{$res['adress']},{$res['amount']},{$res['gDate']},{$res['rDate']}";

// 	$fileName = "export". '.csv';
// 	file_put_contents($fileName, $data);
	

// 	header('Location: index.php');



?>


<?php  
session_start();

// check auth
if(!isset($_SESSION['user']['id'])){
    header('Location: login.php');
}
$uid= $_SESSION['user']['id']; 
require_once '../db.php';
          
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');
          mb_convert_encoding( 'UTF-16LE', 'UTF-8');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('name', 'comment', 'contact', 'adress', 'amount','gDate', 'rDate'));  
      $query = "SELECT * from debt 
      WHERE debt.iduser = '$uid' ORDER BY id DESC";  
      
      $result = mysqli_query($db, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
  
 ?>