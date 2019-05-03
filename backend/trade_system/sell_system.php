<?php 
	$conn = pg_connect("host=localhost dbname='cuonshop' port='5433' user='postgres' password='1'");
 ?>
<?php session_start(); ?>
<?php 
	if(isset($_POST['submit']))
	{
		
		$name = $_POST['name'];
		$price = $_POST['price'];
		$amount = $_POST['amount'];
		$brand = $_POST['brand'];
		$cate = $_POST['cate'];
		$exp = $_POST['exp'];
		$mfg= $_POST['mfg'];
		$des= $_POST['des'];
		$file = $_FILES['file'];
		$f_Name= $file['name'];
		$f_TmpName= $file['tmp_name'];
		$f_Size= $file['size'];
		$f_Type= $file['type'];
		
		//validiate 
		if (empty($name)||empty($price)||empty($amount)||empty($brand)||empty($cate)) {
			header("location:../../frontend/sell.php?error=empty");
			# code...
		}else
		{
			if(number_format($price)&&number_format($amount)){
				//save file to sell_product_image
				$f_Ext= explode('.',$f_Name);

				$f_ActualExt= strtolower(end($f_Ext));
				$allowed = array('jpg','jpeg','png');
				if(in_array($f_ActualExt,$allowed)) {
					

						$f_NameNew = uniqid('',true).".".$f_ActualExt;
						$f_Destination = 'productimg/'.$f_NameNew;
						move_uploaded_file($f_TmpName,$f_Destination);
						$id = $_SESSION['id'];
						$sql = "INSERT INTO product(idm,name,price,brand,category,quantity,img,des,exp,mfg) VALUES('$id','$name','$price','$brand','$cate','$amount','$f_NameNew','$des','$exp','$mfg');";
						pg_query($conn,$sql);
						header("location:../../frontend/sell.php?success");

					
				}else{
						header("location:../../frontend/sell.php?error=img");
					
				}
			}else
			{

				header('location:../../frontend/sell.php?error=number');
			}
		}

		
	}else
	{
		header('location:sell.php');
	}
 ?>