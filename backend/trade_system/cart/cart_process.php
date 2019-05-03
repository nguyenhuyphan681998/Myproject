
<?php include_once('connect_db.php') ?>
<?php 
	//sql process
	$idBuy = $_SESSION['id'];

	$sql = "SELECT * FROM buy JOIN product ON buy.idp = product.idp WHERE buy.idc='$idBuy'";
	$a=pg_query($conn,$sql);
			while ($row1 = pg_fetch_assoc($a))
			{
				echo "
				<tbody>
						<tr>
							<td class='cart_product'>
								<a href=''><img src='../backend/trade_system/productimg/".$row1['img']."' alt='' style = 'width:110px;height:110px;'></a>
							</td>
							<td class='cart_description'>
								<h4><a href=''>".$row1['name']."</a></h4>
								
							</td>
							<td class='cart_price'>
								<p>".$row1['price']."</p>
							</td>
							<td class='cart_quantity'>
								<div class='cart_quantity_button'>
									<a class='cart_quantity_up' id='".$row1['idp']."up' onclick = 'up".$row1['idp']."()' href=''> + </a>
									<input class='cart_quantity_input' type='text' name='quantity' value='".$row1['quantity']."' autocomplete='off' size='2' id = '".$row1['idp']."''>
									<a class='cart_quantity_down id ='".$row1['idp']."down' onclick='down()' href=''> - </a>
								</div>
							</td>
							<td class='cart_total'>
								<p class='cart_total_price'>".($row1['price']*$row1['quantity'])."$</p>
							</td>
							<td class='cart_delete'>
								<a class='cart_quantity_delete' href=''><i class='fa fa-times'></i></a>
							</td>
						</tr>
				</TBODY>
				";
				
			}
			?>
