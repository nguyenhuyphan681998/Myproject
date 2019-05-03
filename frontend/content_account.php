<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Account</li>
				</ol>
			</div><!--/breadcrums-->

			

			<div class="shopper-informations">
				<div class="row">
					<div class = "col-sm-12">
						<div class="order-message">
							<p  style="color: orange;font-weight: 700;font-size: 35px;text-align: center;" >Account Information </p>

							
						</div>	
						<?php include_once('../backend/trade_system/cart/connect_db.php') ?>
							
							<div class="total_area" style="padding:10px 200px 50px 200px;">
								<ul>
									<li>Name <span><?php echo $_SESSION['name'] ?></span></li>
									<li>Username <span><?php echo $_SESSION['username'] ?></span></li>
									
									<li>Bank account<span><?php 
										$idu = $_SESSION['id'];
										$sql = "SELECT * FROM users WHERE id='$idu' ;";
										$result = pg_query($conn,$sql);
										$row = pg_fetch_assoc($result);
										if($row['bank']==0)
										{
											echo "<input type = 'text' id = 'bank'>";
										}
										else
										{
											echo "<input type = 'text' id = 'bank' value='".$row['bank']."'>";
										}
									 ?></span></li>
									<li>Blance <span>
										<?php 
										if($row['blance']==0)
										{
											echo "<input type = 'text' value = '0' id = 'blance'>";
										}
										else
										{

										 	echo "<input type = 'text' value = '".$row['blance']."' id='blance'>";
										}
										?>
									</span></li>
								</ul>
									
							<a class="btn btn-default check_out" href="" onclick="update_infor()" style = "margin-left: 50%;">Update</a>
					</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				function update_infor(){

					var bank = document.getElementById("bank");
					var blance = document.getElementById("blance");
					blance = parseFloat(blance.value);

					$.ajax({
					url : "update_infor.php",
					data : {bank:bank.value,blance:blance},
					type : 'post',
					success : function(response) {
						bank.innerHTML = bank.value;
						blance.innerHTML = blance;
						}
					});
				}
			</script>

					
					<div class="col-sm-13">
						<div class="table-responsive cart_info">
							<div class="order-message">
							<p  style="color: orange;font-weight: 700;font-size: 35px;" >Orders</p>
						</div>	
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td class ="total">Customer</td>
							<td class ="total">Status</td>

						</tr>
					</thead>
					
					<tbody>
						<tr>
							<?php include_once('../backend/trade_system/cart/connect_db.php') ?>
							<?php 
	//sql process
							$idm = $_SESSION['id'];
							$total = 0;

							$sql = "SELECT buy.quantity,product.name,product.price,product.brand,product.idp,product.img,buy.idc,buy.status FROM buy JOIN product ON buy.idp = product.idp WHERE product.idm='$idm'";
							$a=pg_query($conn,$sql);
							while ($row1 = pg_fetch_assoc($a))
							{ 
								$total = $row1['price']*$row1['quantity']+$total;

								?>
								<tbody>
									<tr>
										<td class="cart_product" id = "to">
											<a href=""><img src="../backend/trade_system/productimg/<?php echo "".$row1['img'].""; ?>" style = "width:110px;height:110px;"></a>
										</td>
										<td class="cart_name" style="font-size: 15px;color: black;">
											<h4><a><?php echo "".$row1['name'].""; ?></a></h4>
											
										</td>
										<td class="cart_price">
											<p><?php echo "".$row1['price'].""; ?></p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button" style="height: 28px;">
												
												<input class="cart_quantity_input" type='text' name='quantity' value=<?php echo $row1['quantity'];  ?> autocomplete='off' size='2' id ="<?php echo "".$row1['idp'].""; ?>">
												
											</div>
										</td>
										<td class='cart_total'>
											<p class='cart_total_price'><?php echo "".($row1['price']*$row1['quantity']).""; ?>$</p>
										</td>
										<td class='cart_name' >
											<p class='cart_total_price' style="color: black;font-size: 15px;"><?php 
											$sql2 = "SELECT name FROM users WHERE id=".$row1['idc']."";
											$row2 = pg_fetch_assoc(pg_query($conn,$sql2));
											echo $row2['name'];
											 ?></p>
										</td>
										<td class='cart_price' >
											<p class='cart_total_price' style="color: black;"><?php 
											if($row1['status']==1)
											{
												echo "<p style = 'color:green;font-size:15px'>OK</p>";
											 
											}else
											{
												echo "<p style = 'color:red;font-size:15px'>Pending</p>";
											}
											?></p>
										</td>
									</tr>
							</TBODY>
						</tr>
							
					</tbody>
				<?php } ?>
				</table>
			</div>
					</div>					
					
			
		</div>
	</section> <!--/#cart_items-->
	<script type="text/javascript">
		function up(idp)
		{
			var input = document.getElementById(idp);
			var newQuantity = parseInt(input.value)+1;
			input.value = newQuantity;

			save(idp,newQuantity);
			
     		
				
			
		}
		function down(idp)
		{
			var input = document.getElementById(idp);
			var newQuantity = parseInt(input.value)-1;
			input.value = newQuantity;

			save(idp,newQuantity);

			
		}

		function save(idp,quantity){
			var inputQuantityElement = document.getElementById(idp);
			    $.ajax({
					url : "update_cart.php",
					data : "idp="+idp+"&quantity="+quantity,
					type : 'post',
					success : function(response) {
						(inputQuantityElement).innerHTML= quantity;
						
     					
					
						
					}
				});
		}
		function drop(idp){
			$.ajax({
					url : "drop_cart.php",
					data : "idp="+idp,
					type : 'post',
					success : function(response) {
					
						
					}
				});
		}
	</script>
			
		</div>
	</section> <!--/#cart_items-->