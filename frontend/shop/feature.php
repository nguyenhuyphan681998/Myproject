						
						<?php 
							$fulUrl= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							if(strpos($fulUrl,'page='))
							{

								$page=$_GET['page'];
								if($page=='1'||$page=='')
								{	
									
									$currentPage=0;
								}else{
									$currentPage= ($page*6)-6;
								}
							}else
							{
								
								$currentPage=0;
							}
			
		
							
							$sql = "SELECT * FROM product limit 9 offset $currentPage;";
							$result = pg_query($conn,$sql);

							//counting the number of page
							$fulUrl= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							$result = pg_query($conn,"SELECT max(price),min(price) from product;");
							$row = pg_fetch_assoc($result);
							$step = floor(($row['max']-$row['min'])/5);
							if(strpos($fulUrl,'?pricemin='))
							{

								$price = $_GET['pricemin'];
								
								$sql = "SELECT * FROM product WHERE price >= ".$price." AND price <=".($price + $step)." limit 6 offset $currentPage";
								$result=pg_query($conn,$sql);
								$sql1 = "SELECT * FROM product WHERE price >= ".$price." AND price <=".($price + $step)." ";
								$result1=pg_query($conn,$sql1);


								
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
											$sql = "SELECT * FROM product WHERE brand = '".$brand."' AND category='".$category."' AND price >=".$price." AND price <=".($price+$step)."  limit 6 offset $currentPage";
											$result = pg_query($conn,$sql);
											$sql1 = "SELECT * FROM product WHERE brand = '".$brand."' AND category='".$category."' AND price >=".$price." AND price <=".($price+$step)."";
											$result1 = pg_query($conn,$sql1);

										}
										else
										{
											
											$sql = "SELECT * FROM product WHERE brand = '".$brand."' AND category='".$category."' limit 6 offset $currentPage";
											$result = pg_query($conn,$sql);
											$sql1 = "SELECT * FROM product WHERE brand = '".$brand."' AND category='".$category."' ";
											$result1 = pg_query($conn,$sql1);
										}
										
									}else
									{
										if(strpos($fulUrl,'pricemin='))
										{
											$price = $_GET['pricemin'];
											$sql = "SELECT * FROM product WHERE brand = '".$brand."' AND price >=".$price." AND price <=".($price+$step)." limit 6 offset $currentPage";
											$result = pg_query($conn,$sql);
											$sql1 = "SELECT * FROM product WHERE brand = '".$brand."' AND price >=".$price." AND price <=".($price+$step)." order by idp";
											$result1 = pg_query($conn,$sql1);
										}
										else
										{
											$sql = "SELECT * FROM product WHERE brand = '".$brand."' order by idp limit 6 offset $currentPage";
											$result = pg_query($conn,$sql);
											$sql1 = "SELECT * FROM product WHERE brand = '".$brand."'";
											$result1 = pg_query($conn,$sql1);

										}
										
										
									}
								
								}
							
							else{
								$sql = "SELECT * FROM product order by idp limit 6 offset '$currentPage' ;";
								$result = pg_query($conn,$sql);
								$sql1 = "SELECT * FROM product ;";
								$result1 = pg_query($conn,$sql1);


							}

							$num=pg_num_rows($result1);
							//limit number of record
							
							$a = $num/6;
							$a = ceil($a);
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

							
						
								