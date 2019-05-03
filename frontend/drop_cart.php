<?php session_start() ?>
<?php include_once('../backend/trade_system/cart/connect_db.php') ?>
<?php 
	$idp = $_POST['idp'];
	
	$idc=$_SESSION['id'];
	$sql = "SELECT * from buy where idc = '$idc' and idp = '$idp'";
	$result = pg_query($conn,$sql);
	$row = pg_fetch_assoc($result);
	$sql1 = "SELECT * FROM product WHERE idp = '$idp'";
	$result1 = pg_query($conn,$sql1);
	$row1 = pg_fetch_assoc($result1);
	$quantity = $row1['quantity']+ $row['quantity'];

	$sql = "UPDATE product SET quantity = ".$quantity." WHERE idp = '$idp' ";
	pg_query($conn,$sql);
 	$sql = "DELETE FROM buy WHERE idc = '$idc' AND idp='$idp'";
 	pg_query($conn,$sql);
 ?>