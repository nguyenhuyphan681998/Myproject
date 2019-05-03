<?php session_start() ?>
<?php include_once('../backend/trade_system/cart/connect_db.php') ?>
<?php  
	$idu = $_SESSION['id'];
	$sql = "SELECT * FROM users WHERE id = '$idu'";
	$result = pg_query($conn,$sql);
	$row = pg_fetch_assoc($result);
	$total = $_POST['total'];
	$blance = $row['blance'];
	$newBlance = $blance-$total-2;
	$sql = "UPDATE users SET blance= '$newBlance' WHERE id = '$idu'";
	$result = pg_query($conn,$sql);
	$sql = "SELECT buy.quantity,product.name,product.price,product.brand,product.idp,product.img FROM buy JOIN product ON buy.idp = product.idp WHERE buy.idc='$idu' and buy.status =0";
	$a=pg_query($conn,$sql);
	while ($row1 = pg_fetch_assoc($a))
	{
		$sql = "UPDATE buy set status='1' where idp = '".$row1['idp']."' and idc='$idu'";
		pg_query($conn,$sql);
	}
?>