<?php session_start() ?>
<?php include_once('./connect_db.php') ?>
<?php 
	$ids = $_SESSION['id'];
	$text = $_POST['text'];
	$idp = $_POST['idp'];
	$sql  = "INSERT INTO response(idsend,idp,post,date,time) values ('$ids','$idp','$text','".date('m/d/Y')."','".date('h:i:sa')."');";
	pg_query($conn,$sql);
 ?>