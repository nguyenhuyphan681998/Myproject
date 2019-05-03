
<?php include_once('../backend/trade_system/cart/connect_db.php');  ?>
<section>
		<div class="container">
			<div class="row">
				
				<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li><a href="shop.php">Product</a></li>
				  <li class="active">Detail</li>
				</ol>
			</div>
				<div class="col-sm-12 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<?php
									$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
									if(strpos($fullUrl,'idp='))
									{
										$idp = $_GET['idp'];
										$sql ="SELECT * FROM product where idp = '$idp'";
										$rowpro = pg_fetch_assoc(pg_query($conn,$sql));

									}else
									{
										$sql ="SELECT * FROM product ";
										$rowpro = pg_fetch_assoc(pg_query($conn,$sql));
									}
								 ?>
								<img src="../backend/trade_system/productimg/<?php echo $rowpro['img']; ?>" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
								    	
										<div class="item active">
										<?php 
								    		$sql = "SELECT * FROM product LIMIT 3 OFFSET 0;";
								    		$result = pg_query($conn,$sql);
								    		while($row = pg_fetch_assoc($result))
								    		{

								    	 ?>
										  <a href="product_details.php?idp=<?php echo $row['idp']; ?>"><img src="../backend/trade_system/productimg/<?php echo $row['img'] ?>" style="width: 80px;height:80px;" alt=""></a>
										  <?php } ?>
										</div>
										<div class="item">
										  <?php 
								    		$sql = "SELECT * FROM product LIMIT 3 OFFSET 3;";
								    		$result = pg_query($conn,$sql);
								    		while($row = pg_fetch_assoc($result))
								    		{

								    	 ?>
								    	 <a href="product_details.php?idp=<?php echo $row['idp']; ?>"><img src="../backend/trade_system/productimg/<?php echo $row['img'] ?>" style="width: 80px;height:80px;" alt=""></a>
										  <?php } ?>
										</div>
										<div class="item">
										  <?php 
								    		$sql = "SELECT * FROM product LIMIT 3 OFFSET 3;";
								    		$result = pg_query($conn,$sql);
								    		while($row = pg_fetch_assoc($result))
								    		{

								    	 ?>
								    	 <a href="product_details.php?idp=<?php echo $row['idp']; ?>"><img src="../backend/trade_system/productimg/<?php echo $row['img'] ?>" style="width: 80px;height:80px;" alt=""></a>
										  <?php } ?>
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2><?php echo $rowpro['name']; ?></h2>
								<p>Web ID: <?php echo $rowpro['idp'] ?>cuonshopper</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span>USD $<?php echo $rowpro['price'] ?></span>
									<label>Quantity:</label>
									<input type="text" value="<?php echo $rowpro['quantity'] ?>" />
									<button type="button" class="btn btn-fefault cart" onclick = "addToCart(<?php echo $rowpro['idp'] ?>)">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> <?php echo $rowpro['brand']; ?></p>
								<p><b>MFG:</b> <?php echo $rowpro['mfg']; ?></p>
								<p><b>EXP:</b> <?php echo $rowpro['exp']; ?></p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					<script type="text/javascript">
						function addToCart(idp)
						{
							$.ajax({
							url : "../backend/trade_system/cart/buy_system_detail.php",
							data : "idp="+idp+"&select=1",
							type : 'post',
							success : function(response) {
							alert('Buy successfully!');
							}
						});
						
						}
						
					</script>
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-15">
							<ul class="nav nav-tabs">
								
								<li class="active"><a href="#reviews" data-toggle="tab">FeedBack (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								
							</div>
							
							<div class="tab-pane fade" id="tag" >
								
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									
					<div class="response-area" class="col-sm-12">
						<?php 
							include_once('./connect_db.php');
							$sql = "SELECT count(idpost) FROM response where idp = '".$rowpro['idp']."' ;";
							$result = pg_query($conn,$sql);
							$row = pg_fetch_assoc($result);
							$count = $row['count'];

						 ?>
						<h2><?php echo $count; ?> RESPONSES</h2>
						<?php 
							$sql = "SELECT * FROM response JOIN users ON response.idsend= users.id where idp='".$rowpro['idp']."' order by response.idpost desc";
							$result = pg_query($conn,$sql);
							while($row= pg_fetch_assoc($result))
							{

						 ?>
						<ul class="col-sm-15 media-list" >
							<li class="media" style="background-color:#fff;box-shadow: 5px 5px 5px #666;display: block;">
								
								<a class="pull-left" href="#">
									<img class="media-object" src="users.png"  alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i><?php echo $row['name'] ?></li>
										<li><i class="fa fa-clock-o"></i> <?php echo $row['time'] ?> AM</li>
										<li><i class="fa fa-calendar"></i> <?php echo $row['date'];	 ?></li>
									</ul>
									<p style="color: gray;display: block;height: 50px;"><?php echo $row['post'] ?>.</p>
									<button type="button" class="btn btn-default btn-sm" style="float: left;" onclick="like(<?php echo $row['idpost'];?>)">
          								<span class="glyphicon glyphicon-thumbs-up"></span> Like <span  id="<?php echo $row['idpost'] ?>"><?php echo $row['l'] ?></span>
        							</button>
        							<button type="button" class="btn btn-default btn-sm" style="float: left;margin-left: 10px;" onclick="unlike(<?php echo $row['idpost'];?>)">
          								<span class="glyphicon glyphicon-thumbs-down"></span> Unlike <span  id="u<?php echo $row['idpost'] ?>"><?php echo $row['u'] ?></span>
        							</button>
								</div>
							</li>
							
						<?php } ?>	
						<script type="text/javascript">
							function like(id){
								var input = $("#"+id);
								var like = parseInt(input.html());

								
								$.ajax({
									url : "like.php",
									data : "id="+id,
									type : 'post',
									success : function(response) {
										
										input.html(like+1);
										
										
									}
								});

							}
							function unlike(id)
							{
								var input = $("#u"+id);
								var like = parseInt(input.html());
								
								$.ajax({
									url : "unlike.php",
									data : "id="+id,
									type : 'post',
									success : function(response) {
										
										input.html(like+1);
										
										
									}
								});
							}
							
						</script>
											
					</div><!--/Response-area-->
								
									<ul>
										<li><a href=""><i class="fa fa-user"></i><?php 
										$sql = "SELECT * FROM users where id = ".$_SESSION['id']."";
										$row = pg_fetch_assoc(pg_query($conn,$sql));
										echo $row['username'];
										 ?></a></li>
										<li><a href=""><i class="fa fa-clock-o"></i><?php echo date("h:i:sa"); ?></a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i><?php echo date('m/d/Y') ?></a></li>
									</ul>
									
										<span>
											
										</span>
										<textarea name="text" placeholder="Enter your comment" id ="text" ></textarea>
										<a href="" class="btn btn-default " onclick="uppost()">Submit</a> 
								
									
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<script type="text/javascript">
						function uppost()
						{
						var idp = <?php echo $rowpro['idp'] ?>;
						var text = $('#text').val();
						
						$.ajax({
							url : "post.php",
							data : "idp="+idp+"&text="+text,
							type : 'post',
							success : function(response) {
							
								
							}
						});
						
						}
					</script>
					
				</div>
			</div>
		</div>
	</section>