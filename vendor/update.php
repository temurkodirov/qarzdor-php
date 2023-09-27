<?php
session_start();

// check auth
if(!isset($_SESSION['user']['id'])){
    header('Location: login.php');
}
require_once '../db.php';
if (isset($_POST['name'])) {

	$id = (int) $_POST['id'];
	$name = htmlentities(trim($_POST['name']));
	$comment = htmlentities(trim($_POST['comment']));
	$contact = htmlentities(trim($_POST['contact']));
	$adress = htmlentities(trim($_POST['adress']));
	$amount = htmlentities(trim($_POST['amount']));
	$gDate = htmlentities(trim($_POST['gDate']));
	$rDate = htmlentities(trim($_POST['rDate']));


   $ab = mysqli_query($db,"UPDATE `debt` SET `name` = '$name', `comment` = '$comment', `contact` = '$contact',
    `adress` = '$adress', `amount` = '$amount', `gDate` = '$gDate', `rDate` = '$rDate' WHERE `debt`.`id` = '$id'");
	back();
}

?>