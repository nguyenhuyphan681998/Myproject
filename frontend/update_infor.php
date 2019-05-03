<?php session_start() ?>
<?php include_once('../backend/trade_system/cart/connect_db.php') ?>
<?php 
	$iduser = $_SESSION['id'];
	$bank = $_POST['bank'];
	$blance = $_POST['blance'];
	$sql = "UPDATE users SET bank = '$bank' WHERE id= '$iduser'";
	$sql1 = "UPDATE users SET blance = '$blance' WHERE id = '$iduser'";
	pg_query($conn,$sql);
	pg_query($conn,$sql1);
 ?>