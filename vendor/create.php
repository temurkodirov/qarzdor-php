<?php
session_start();
if(!isset($_SESSION['user']['id'])){
    header('Location: login.php');
    die('session empty');
}
$uid= $_SESSION['user']['id']; 
require_once '../db.php';


if(isset($_POST['add'])) {
    
    $name = (isset($_POST['name']) && $_POST['name'] !== '') ? htmlentities($_POST['name']) : '';
    $comment = (isset($_POST['comment']) && $_POST['comment'] !== '') ? htmlentities($_POST['comment']) : '';
    $contact = (isset($_POST['contact']) && $_POST['contact'] !== '') ? (int) $_POST['contact'] :0;
    $adress = (isset($_POST['adress']) && $_POST['adress'] !== '') ? htmlentities($_POST['adress']) : '';
    $amount = (isset($_POST['amount']) && $_POST['amount'] !== '') ? (int) $_POST['amount'] :0;
    $gDate = (isset($_POST['gDate']) && $_POST['gDate'] !== '') ? $_POST['gDate'] : date('Y-m-d');
    $rDate = (isset($_POST['rDate']) && $_POST['rDate'] !== '') ? $_POST['rDate'] : date('Y-m-d');

    $db = mysqli_query($db,"
        INSERT INTO `debt` 
        (`id`, `name`, `comment`, `contact`, `adress`, `amount`, `gDate`, `rDate`,`iduser`) 
        VALUES 
        (NULL, '$name', '$comment', '$contact' , '$adress', '$amount', '$gDate', '$rDate','$uid')");
    if(!$db) die('query error');
    
    back();
}
?>