						
						<?php 
								if(isset($_POST['submit']))
								{
									$a = $_POST['search'];
									$sql = "SELECT * FROM product where name LIKE '%".$a."%';";
									$result = pg_query($conn,$sql);
									$num = pg_num_rows($result);
									if($num == 0)
									{
										echo "<h2>Cannot found result available!</h2>";
									}
									else
									{
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
									}
								}
								else
								{
									
									$sql = "SELECT * FROM product ;";
									$result = pg_query($conn,$sql);
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
									}
								?>