
<?php include_once('header_sell.php') ?>
<section>
		<div class="container">
					<div>
						<div class="col-sm-7" style="padding-bottom: 100px;">
							<div class="product-information"  style ="background:#FFc125;padding-right: 60px;padding-bottom:150px;border-radius: 10% 10%;"><!--/product-information-->
								
								<h1 class="title text-center" style ="color:#ffffff">Sell Product</h1>
								<div class="login-form"  style="padding: 10%;background: white;display: block;"><!--sell form-->

									<form action="../backend/trade_system/sell_system.php" method="POST" enctype="multipart/form-data"	onsubmit="return formSubmit()" id ="frmForm">
										<input type="text" placeholder="Product name" name="name" id = "name" onkeyup="showname()" />
										<input type="text" placeholder="Price" name="price" id= "price" onkeyup="showprice()"/>
										<input type="text" placeholder="Quantity" name="amount" onkeyup="showquantity()" id= "quantity" />
										<input type="text" placeholder="Brand" name="brand" id= "brand" onkeyup="showbrand()"  />
										<h4 style= "color:orange;">EXP:</h4>
										<input name = "exp" dateformat="d M y" type="date"/>
										<h4 style= "color:orange;">MFG:</h4>
										<input type="date" name="mfg"  />
		
										
										<h4 style= "color:#ffffff;" >Category</h4>
											<select name = "cate" id = "cate" onchange="showcate()">
											  <option value="Sportswear">Sportswear</option>
											  <option value="Men">Men</option>
											  <option value="Women">Women</option>
											  <option value="Kids">Kids</option>
											  <option value="Drink">Drink</option>
											  <option value="Food">Food</option>
											  <option value="Vehicles">Vehicles</option>
											  <option value="Books">Books</option>
											  <option value="Others">Others</option>
											</select>
										<h4 style= "color:#ffffff	;">Image</h4>
										<label class="btn btn-default">
    										Image<input type="file" name ="file" id="file" hidden onchange="showfile()">
										</label>
										<br><br>	
										<textarea name = "des" placeholder="Description" rows="5" id = "des" onkeyup="showdes()"></textarea>
										<button type="submit" name="submit" style="position: absolute;bottom: 20px; right: 45%;display: block;border-radius: 50% 50%;width: 100px;height: 100px;text-align: center;">SELL</button>
									</form>
								</div><!--/sell form-->
								
							
							</div><!--/product-information-->
						</div>
					</div>
					<!---xu li java scrip-->
					
					 <div class="col-sm-5" >
					 	<div class="product-information"><!--/product-information-->
					 		<h1 class = "title text-center">REVIEW</h1>
						 		<div class="view-product" id= "uploaded">

								
							</div>
								
								<h2 id= "showname"></h2>
								
								<span>
									<span id = "showtext"></span><span id ="showprice"></span>
									<label id = "showtextquan"></label>
									<input type="text" value="" id = "showquantity" />
									<button type="button" class="btn btn-fefault cart" id = "cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
								<p ><b id="status">Availability: In stock</b> </p>
								<p ><b id="showcate">Category: </b></p>
								<p ><b id="showbrand">Brand: </b></p>
								<p ><b id="showdes"></b></p>

								
							</div>
					 	
					 	<div class ="product-information">
					 		<div id = "showname"></div>
					 		
					 		<span id="uploaded"></span>
					 	</div>
					 	
					 </div>
					
					
<script type="text/javascript">
	$(document).ready(function(){
		$('#cart').hide();
		$('#showquantity').hide();
		$('#status').hide();
		$('#showcate').hide();
		$('#showbrand').hide();
		
		
	});

	function showname(){
		var input = document.getElementById("name");
		var div = document.getElementById("showname");
		div.innerHTML = input.value;
	}
	function showprice(){
		var input = document.getElementById("price");
		var div = document.getElementById("showprice");
		var text = document.getElementById("showtext");
		text.innerHTML = "USD ";
		div.innerHTML = "$"+input.value;

	}
	function showquantity(){
		$('#showquantity').show();
		var input = document.getElementById("quantity");
		var div = document.getElementById("showquantity");

		var text = document.getElementById("showtextquan");
		text.innerHTML = "Quantity";
		div.value= input.value;
		$('#cart').show();
		
		$('#status').show();
		
		

	}
	function showcate(){
	
		$('#showcate').html('Category: '+ $('#cate').val());
		$('#showcate').show();
	}
	function showbrand(){
		$('#showbrand').html('Brand: '+ $('#brand').val());
		$('#showbrand').show();
	}
	function showdes(){
		$('#showdes').html('Description:  '+$('#des').val());
		$('#showdes').show();
	}
	function showfile(){
		var input = document.getElementById('file');
		property = input.files[0];
		
		var image_name = property.name;
		var image_extension = image_name.split('.').pop().toLowerCase();

		if(jQuery.inArray(image_extension,['gif','png','jpg','jpeg'])==-1)
		{
			alert('Not the correct type!');
		}else{
			var form_data = new FormData();
			form_data.append('file',property);
			$.ajax(
				{
					url:"./upload.php",
					data:form_data,
					type:"POST",
					processData: false,
					contentType:false,
					success: function(data){
						$('#uploaded').html(data);
						$('#condition').show();
					}
				}
				);
		}

	};	


</script>
			
		
	</section>
	<?php include_once('footer_page.php') ?>