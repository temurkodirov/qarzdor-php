<?php 
require_once '../db.php';
$id = (int) $_GET['id'];
mysqli_query($db,"DELETE FROM debt WHERE `debt`.`id` = $id" );
back();
?>