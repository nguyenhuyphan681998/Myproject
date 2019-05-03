<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p style="color: orange;font-weight: 700;font-size: 35px;">Bill To</p>
							<div class="form-one">
								<form>
									<input type="text" placeholder="Company Name">
									<input type="text" placeholder="Email*">
									
									<input type="text" placeholder="Full Name *">
									<input type="text" placeholder="Address">
									
								</form>
							</div>
							<div class="form-two">
								<form>
									<input type="text" placeholder="Zip / Postal Code *">
									<select>
										<option>-- Country --</option>
										<option>Vietnam</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>United Kingdom</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<select>
										<option>-- State / Province / Region --</option>
										<option>Ha Noi</option>
										<option>Hai Phong</option>
										<option>Hai Duong</option>
										<option>Thanh Hoa</option>
										<option>Quang Ninh</option>
										
									</select>
									
									<input type="text" placeholder="Phone *">
									
									<input type="text" placeholder="Fax">
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p  style="color: orange;font-weight: 700;font-size: 35px;" >Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="10"></textarea>
							
						</div>	
					</div>					
					<div class = "col-sm-3">
						<div class="order-message">
							<p  style="color: orange;font-weight: 700;font-size: 35px;" >Check out</p>

						<div></div>	
						</div>	
						<?php include_once('../backend/trade_system/cart/connect_db.php') ?>
							<?php 
	//sql process
							$idBuy = $_SESSION['id'];
							$total = 0;

							$sql = "SELECT buy.quantity,product.name,product.price,product.brand,product.idp,product.img FROM buy JOIN product ON buy.idp = product.idp WHERE buy.idc='$idBuy' and buy.status ='0'";
							$a=pg_query($conn,$sql);
							while ($row1 = pg_fetch_assoc($a))
							{ 
								$total = $row1['price']*$row1['quantity']+$total;
							}
							?>
							<div class="total_area">
								<ul>
									<li>Cart Sub Total <span id = "total">$<?php echo $total ?></span></li>
									<li>VAT<span>$2</span ></li>
									<li>Shipping Cost <span>Free</span></li>
									<li>Total <span>$<?php echo $total+2; ?></span></li>
									<li>Blance <span>$<?php 
										$idu = $_SESSION['id'];
										$sql = "SELECT * FROM users WHERE id= '$idu'";
										$row = pg_fetch_assoc(pg_query($conn,$sql));
										echo $row['blance'];
									 ?></span></li>
								</ul>
									
							<a class="btn btn-default check_out" href="" onclick="check(<?php echo $total; ?>)" style = "margin-left: 100px;">Check Out</a>
					</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				function check(total){
					if(total==0)
					{
						alert('Empty cart!');
					}else{
						if(<?php echo $row['blance']; ?>>=total)
					{
					 $.ajax({
					
					
					url : "checkout_result.php",
					data : "total="+total,
					type : 'post',
					success : function(response) {
						$('#blance').val(<?php echo $row['blance'] ?>-total);
						alert('Successfully!');}
						});}
					 else
					 {
					 	 alert('Not enough money!');
					 }
					}
				}
			</script>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					
					<tbody>
						<tr>
							<?php include_once('../backend/trade_system/cart/connect_db.php') ?>
							<?php 
	//sql process
							$idBuy = $_SESSION['id'];
							$total = 0;

							$sql = "SELECT buy.quantity,product.name,product.price,product.brand,product.idp,product.img FROM buy JOIN product ON buy.idp = product.idp WHERE buy.idc='$idBuy' and status ='0'";
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
										<td class="cart_description">
											<h4><a><?php echo "".$row1['name'].""; ?></a></h4>
											
										</td>
										<td class="cart_price">
											<p><?php echo "".$row1['price'].""; ?></p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button" style="height: 28px;">
												<a class="cart_quantity_up" onclick = "up(<?php echo "".$row1['idp'].""; ?>)" href=""> + </a>
												<input class="cart_quantity_input" type='text' name='quantity' value=<?php echo $row1['quantity'];  ?> autocomplete='off' size='2' id ="<?php echo "".$row1['idp'].""; ?>">
												<a class="cart_quantity_down" onclick="down(<?php echo "".$row1['idp'].""; ?>)" href = ""> - </a>
											</div>
										</td>
										<td class='cart_total'>
											<p class='cart_total_price'><?php echo "".($row1['price']*$row1['quantity']).""; ?>$</p>
										</td>
										<td class='cart_delete'>
											<a class='cart_quantity_delete' onclick="drop(<?php echo $row1['idp']; ?>)" href="" ><i class='fa fa-times'></i></a>
										</td>
									</tr>
							</TBODY>
						</tr>
							
					</tbody>
				<?php } ?>
				</table>
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
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->