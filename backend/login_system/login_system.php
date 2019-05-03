<?php include_once('connect_db.php'); ?>
<?php session_start(); ?>
<?php 
	
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$pwd = $_POST['pwd'];
		if(empty($username)||empty($pwd)){
			header('location:../../frontend/login.php?error=empty');
		}else{
			$sql ="SELECT * FROM users WHERE username='$username' AND password='$pwd'";
			$result=pg_query($conn,$sql);
			$num=pg_num_rows($result);
			if($num==0){
				header('location:../../frontend/login.php?error=notvail');
			}else
			{
				
				$result=pg_fetch_assoc($result);
				$_SESSION['id']= $result['id'];
				$_SESSION['username']= $result['username'];
				$_SESSION['name']= $result['name'];
				$_SESSION['pass']=$result['pwd'];
				header('location:../../frontend/index.php');

			}
		}
	}