<?php 
session_start();

// check auth
if(!isset($_SESSION['user']['id'])){
    header('Location: login.php');
}
$uid= $_SESSION['user']['id']; 
require_once '../db.php';

if(isset($_POST['importSubmit'])){
    
    $csvMimes = array('text/x-comma-separated-values','text/x-comma-separated-values','application/octet-stream',
    'text/csv','application/csv','application/excel','application/vnd.msexcel','text/plain' );


    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        //if the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            //Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'],'r');
            

            
            
          
            //Skip the first line
            fgetcsv($csvFile);

            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                
                $name = $line[0];
                $comment = $line[1];
                $contact = $line[2];
                $adress = $line[3];
                $amount = $line[4];
                $gDate = $line[5];
                $rDate = $line[6];
                // dump($name);  
                mysqli_query($db, "INSERT INTO `debt` ( `id`,`name`, `comment`, `contact`, `adress`, `amount`, `gDate`, `rDate`,`iduser`) 
                VALUES        (NULL,'$name', '$comment', '$contact',  '$adress', '$amount','$gDate', '$rDate','$uid')"); 
            }
                fclose($csvFile);
                // $qstring = '?staus=succ';
        }else{
            // $qstring = '?status=err';
        }
    }else{
        // $qstring = '?status=invalid_file';
    }
}
header("Location:../index.php");

?>