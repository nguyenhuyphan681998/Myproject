<?php session_start() ?>
<?php include_once('./connect_db.php'); ?>
<?php 
	$id = $_POST['id'];
	$sql = "SELECT * FROM response where idpost = '$id'";
	$row = pg_fetch_assoc(pg_query($conn,$sql));
	$sql = "UPDATE response SET u='".($row['u']+1)."' where idpost = '$id'";
	pg_query($conn,$sql)
	;?>