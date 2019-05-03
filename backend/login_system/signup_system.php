<?php $conn = pg_connect("host=localhost dbname='cuonshop' port='5433' user='postgres' password='1'"); ?>
<?php session_start(); ?>
<?php 
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd'];
		$ad = $_POST['adress'];
		$age = $_POST['age'];
		if(empty($username)||empty($pwd)||empty($email)||empty($name)){
			header('location:../../frontend/login.php?error=empty');
		}else{
			$sql = "SELECT * FROM users WHERE username='$username';";
			$result=pg_query($conn,$sql);
			$num=pg_num_rows($result);
			if($num==0){
				$sql = "SELECT * FROM users WHERE email='$email';";
				$result=pg_query($conn,$sql);
				$num=pg_num_rows($result);
				if($num==0)
				{
					$sql ="INSERT INTO users(username,email,password,name,adress,age) VALUES ('$username','$email','$pwd','$name','$ad','$age');";
					$result=pg_query($conn,$sql);
					
					
					
					header('location:../../frontend/index.php?ok');
				}
				else
				{
					header('location:../../frontend/login.php?error=email');
				}
			}else
			{
				header('location:../../frontend/login.php?error=exist');
			}

		}
	}
 ?>