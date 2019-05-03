<?php session_start() ?>
<?php include_once('connect_db.php') ?>
<?php 
	$idp = $_POST['idp'],
	$quantity = $_POST['quantity'],
	$idc=$_SESSION['id'];

 	$sql = "UPDATE buy SET quantity= '$quantity' WHERE idc = '$idc' AND $idp='$idp'";
 	pg_query($conn,$sql);
 ?>