<?php session_start() ?>
<?php include_once('../../login_system/connect_db.php') ?>

<?php 	
		
		
			
			
			$idp = $_POST['idp'];

			$sql = "SELECT * FROM product WHERE idp = ".$idp."";
			$result = pg_query($conn,$sql);
			$row = pg_fetch_assoc($result);
			$idm = $row['idm'];
			$idc = $_SESSION['id'];
			$quantity = $_POST['select'];
			if($idc==$idm)
			{
				header('location:../../../frontend/index.php?fail');
			}else
			{
			$sql = "SELECT * FROM buy WHERE idc = '$idc' AND idp = '$idp' and status =0";
			$result = pg_query($conn,$sql);
			$num=pg_num_rows($result);
			$add = pg_fetch_assoc($result);

			if($num==0)
			{
				$sql = "INSERT INTO buy(idc,idp,quantity,date) values ('$idc','$idp','$quantity','".date("m/d/Y")."')";
				$result = pg_query($conn,$sql);
				$sql = "SELECT * FROM product WHERE idp ='$idp'";
				$result= pg_query($conn,$sql);
				$row = pg_fetch_assoc($result);
				$row['quantity'] = $row['quantity']-$quantity;
				echo $row['quantity'];
				$sql = "UPDATE product SET quantity = '".$row['quantity']."' WHERE idp = ".$idp." ";
				$result=pg_query($conn,$sql);
				
			}
			else
			{
				$sql = "SELECT * FROM buy WHERE idc = '$idc' AND idp = '$idp'";
				$result = pg_query($conn,$sql);
				$add = pg_fetch_assoc($result);
				$add['quantity']=  $add['quantity'] + $quantity;
				$sql = "UPDATE buy SET quantity = ".$add['quantity']." WHERE idp = '$idp' AND idc= '$idc'";
				pg_query($conn,$sql);
				$sql = "SELECT * FROM product where idp = '$idp'";
				$result = pg_query($conn,$sql);
				$row= pg_fetch_assoc($result);
				$row['quantity']=$row['quantity']-$quantity;

				$sql = "UPDATE product SET quantity = '".$row['quantity']."' WHERE idp = ".$idp." ";
				pg_query($conn,$sql);

			}
			
			

			
		}
		
 ?>