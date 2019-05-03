
	<section>

		<?php 
			$fulUrl= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if(strpos($fulUrl,'sucess'))
			{
				echo "<script type='text/javascript'>
        			var timeout = setTimeout(function(){
            		 alert('Buy successfully!');
        			},1000);
        			$(document).ready(function(){
     					$('body,html').animate({scrollTop: 800}, 800); 
					});
    				</script>";
				
			}
			if(strpos($fulUrl,'?'))
			{
				echo "<script type='text/javascript'>
        			
        			$(document).ready(function(){
     					$('body,html').animate({scrollTop: 800}, 800); 
					});
    				</script>";
				
			}
			if(strpos($fulUrl,'fail'))
			{
				echo "<script type='text/javascript'>
        			var timeout = setTimeout(function(){
            		 alert('Fail to add to cart!');
        			},1000);
        			$(document).ready(function(){
     					$('body,html').animate({scrollTop: 800}, 800); 
					});
    				</script>";
				
			}
			

		?>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<?php
									$sql = "SELECT distinct category from product order by category;";
									$result = pg_query($conn,$sql);
									while($row = pg_fetch_assoc($result))
									{
										echo "
									<div class='panel-heading'>
									<h4 class='panel-title'>
										<a data-toggle='collapse' data-parent='#accordian' href='#".$row['category']."'>
											<span class='badge pull-right'><i class='fa fa-plus'></i></span>
											".$row['category']."
										</a>
									</h4>
									</div>
									<div id='".$row['category']."' class='panel-collapse collapse'>
									<div class='panel-body'>
										<ul>";
										$sql1 = "SELECT brand,category from product group by category,brand";
										$result1= pg_query($conn,$sql1);
										while($row1=pg_fetch_assoc($result1)){
											if($row1['category']==$row['category'])
											{
												echo "
													<li><a href='?brand=".$row1['brand']."&category=".$row['category']."'> ".$row1['brand']."</a></li>
												";
											}

										}	
										echo "</ul>
									</div>
								</div>

									";
									}									
									 
								 ?>
							</div>
							
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>

							<div class="brands-name">

								<ul class="nav nav-pills nav-stacked">
								<?php 
									$sql = "SELECT brand,count(idp) from product group by brand;";
									$result = pg_query($conn,$sql);
									while($row = pg_fetch_assoc($result)){
										echo "<li><a href='?brand=".$row['brand']."'> <span class='pull-right'>(".$row['count'].")</span>".$row['brand']."</a></li>";

									}
								 ?>
										
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items" id="to"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						
						<?php 
							$fulUrl= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							if(strpos($fulUrl,'page='))
							{

								$page=$_GET['page'];
								if($page=='1'||$page=='')
								{	
									
									$currentPage=0;
								}else{
									$currentPage= ($page*10)-10;
								}
							}else
							{
								
								$currentPage=0;
							}
							//counting the number of page
							
							// lay url
							$fulUrl= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$result = pg_query($conn,"SELECT max(price),min(price) from product;");
							$row = pg_fetch_assoc($result);
							$step = floor(($row['max']-$row['min'])/5);
							if(strpos($fulUrl,'?pricemin='))
							{

								$price = $_GET['pricemin'];
								
								$sql = "SELECT * FROM product WHERE price >= ".$price." AND price <=".($price + $step)." limit 6";
								$result=pg_query($conn,$sql);

								
							}
							else if(strpos($fulUrl,'?brand='))
								{
									$brand = $_GET['brand'];

									if(strpos($fulUrl,'category='))
									{
										$category = $_GET['category'];
										if(strpos($fulUrl,'pricemin='))
										{
											$price = $_GET['pricemin'];
											$sql = "SELECT * FROM product WHERE brand = '".$brand."' AND category='".$category."' AND price >=".$price." AND price <=".($price+$step)." limit 6";
											$result = pg_query($conn,$sql);

										}
										else
										{
											
											$sql = "SELECT * FROM product WHERE brand = '".$brand."' AND category='".$category."' limit 6";
											$result = pg_query($conn,$sql);
										}
										
									}else
									{
										if(strpos($fulUrl,'pricemin='))
										{
											$price = $_GET['pricemin'];
											$sql = "SELECT * FROM product WHERE brand = '".$brand."' AND price >=".$price." AND price <=".($price+$step)." limit 6";
											$result = pg_query($conn,$sql);
										}
										else
										{
											$sql = "SELECT * FROM product WHERE brand = '".$brand."' limit 6 offset $currentPage";
											$result = pg_query($conn,$sql);

										}
										
										
									}
								
								}
							
							else{
								$sql = "SELECT * FROM product where quantity>=(select avg(quantity) from product) limit 6 offset $currentPage;";
								$result = pg_query($conn,$sql);

							}

							

							while($row = pg_fetch_assoc($result))
							{
								
								echo "
									<div class='col-sm-4'>
										<div class='product-image-wrapper' >
											<div class='single-products'>
												<div class='productinfo text-center'>
													<img src='../backend/trade_system/productimg/".$row['img']."'   style = 'height:300px' alt='' />
													<h2>$".$row['price']."</h2>
													<p>Name:	".$row['name']."</p>
													<p>Brand:	".$row['brand']."</p>


													<a href='#'' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>
												</div>
												<div class='product-overlay'>

													<div class='overlay-content'>

														";
								$sql1 = "SELECT quantity from product where idp = '".$row['idp']."'";
								$result1 = pg_query($conn,$sql1);
								$row1 = pg_fetch_assoc($result1);
								if($row1['quantity']==0)
								{
									echo "<p>Out of stock</p>
									</div>
									</div>
									<div class='choose'>
												<ul class='nav nav-pills nav-justified'>
													<li><a href=''><i class='fa fa-plus-square'></i>Add to wishlist</a></li>
													<li><a href=''><i class='fa fa-plus-square'></i>Add to compare</a></li>
												</ul>
											</div>
										</div>
									</div>";

								}
								else{

								echo "
														<a href='product_details.php?idp=".$row['idp']."' class='btn btn-default add-to-cart'></i>Views detail</a>
														<p>Or</p>
														";
														
														
									if(isset($_SESSION['id']))
														{

								echo "
														<form name='form' action='../backend/trade_system/cart/buy_system.php?idp=".$row['idp']."' method='post' name = 'formoverlay'>
  														
														
														<p>Select quantity:
														<select style ='width:20%;' name ='select'>
															";
														for($i=0;$i<$row1['quantity'];$i++)
														{
															echo "<option>".($i+1)."</option>";
														}
								echo "
														</select></p>

														<button  class='btn btn-default add-to-cart' type='submit' name = 'submitform'><i class='fa fa-shopping-cart'></i>Add to cart</button>
														</form>
														";
									}else
									{
										echo "<a href='login.php' class='btn btn-default add-to-cart'></i>Login to buy product</a>";
									}
								echo "
														</div>
												</div>
											</div>
											<div class='choose'>
												<ul class='nav nav-pills nav-justified'>
													<li><a href=''><i class='fa fa-plus-square'></i>Add to wishlist</a></li>
													<li><a href=''><i class='fa fa-plus-square'></i>Add to compare</a></li>
												</ul>
											</div>
										</div>
									</div>
								";		


							}
						}
						
							?>
						

						
					</div><!--features_items-->
						
						<!--featuers items-->
					
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">

							<ul class="nav nav-tabs">
								
								<?php 
								
								$sql = "SELECT category FROM product  group by category limit 1 offset 0;";
								$result = pg_query($conn,$sql);
								$row = pg_fetch_assoc($result);
								
								echo "<li class='active'><a href='#".strtolower($row['category'])."' data-toggle='tab'>".$row['category']."</a></li>";
								$sql = "SELECT category FROM product  group by category offset 1;";
								$result = pg_query($conn,$sql);
								while($row = pg_fetch_assoc($result)){
								 	echo "<li><a href='#".strtolower($row['category'])."' data-toggle='tab'>".$row['category']."</a></li>";
								}
								
								?>
								
								
							</ul>
						</div>
						<div class="tab-content">
							<?php 
								
								
								$sql = "SELECT category from product group by category limit 1";
								$result = pg_query($conn,$sql);
								$row = pg_fetch_assoc($result);

								$sql1 = "SELECT * FROM product WHERE category='".$row['category']."';";
								echo "<div class='tab-pane fade active in' id='".strtolower($row['category'])."' >";
								$result1 = pg_query($conn,$sql1);
								while($row1 = pg_fetch_assoc($result1))
								{
									echo "
										<div class='col-sm-3'>
											<div class='product-image-wrapper'>
												<div class='single-products'>
													<div class='productinfo text-center'>
														<img src='../backend/trade_system/productimg/".$row1['img']."' alt='' />
														<h2>$".$row1['price']."</h2>
														<p>".$row1['name']."</p>
														<a href='../backend/trade_system/cart/buy_system.php?idp=".$row1['idp']."' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>
													</div>
													
												</div>
											</div>
										</div>
										";
								}
								
								echo "
									</div>
										";
										

							?>
							<?php
									$sql  = "SELECT category from product group by category offset 1;";
									$result = pg_query($conn,$sql);
									while($row = pg_fetch_assoc($result))
									{
										echo "<div class='tab-pane fade' id='".strtolower($row['category'])."' >";
										$sql1 = "SELECT * FROM product WHERE category = '".$row['category']."' limit 4;";
										$result1 = pg_query($conn,$sql1);
										while($row1 = pg_fetch_assoc($result1))
										{
											echo "
										<div class='col-sm-3'>
											<div class='product-image-wrapper'>
												<div class='single-products'>
													<div class='productinfo text-center'>
														<img src='../backend/trade_system/productimg/".$row1['img']."' alt='' />
														<h2>$".$row1['price']."</h2>
														<p>".$row1['name']."</p>
														<a href='../backend/trade_system/cart/buy_system.php?idp=".$row1['idp']."' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>
													</div>
											
												</div>
											</div>
										</div>

										";
										}
										echo "</div>";
									} 
									
							?>
							
					</div><!--/category-tab-->
				</div>
			</div>
		</div>
	</section>