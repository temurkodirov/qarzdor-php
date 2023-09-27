<?php
require_once '../db.php';


if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];
	$post = mysqli_query($db, "select * from debt where id = '$id' ");
	if (mysqli_num_rows($post) > 0)
	{
		die(json_encode([
			'status' => true,
			'data' => mysqli_fetch_assoc($post)
		]));
	}
	else
	{
		die(json_encode([
			'status' => false
		]));
	}
}


?>