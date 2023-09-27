<?php  
require_once '../db.php';
     

      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=tolovi_yaqinlar.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('ID', 'name', 'comment', 'contact', 'adress', 'amount','gDate', 'rDate'));  
      $query = "SELECT * FROM debt WHERE  debt.rDate > now() AND
      debt.rDate < date_add(now(), INTERVAL 7 day) ORDER BY debt.rDate ASC";  
      $result = mysqli_query($db, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  

 ?>
