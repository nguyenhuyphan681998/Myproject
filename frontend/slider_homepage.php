<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
							<li data-target="#slider-carousel" data-slide-to="3"></li>
							<li data-target="#slider-carousel" data-slide-to="4"></li>
							<li data-target="#slider-carousel" data-slide-to="5"></li>
							
						</ol>
						
						<div class="carousel-inner">
							<?php include_once('../backend/login_system/connect_db.php') ?>
							<?php 
							$sql = "SELECT * FROM product WHERE idp IN ( SELECT idp FROM product GROUP BY quantity,idp HAVING quantity > (select avg(quantity) from product)) LIMIT 1 offset 0 ;";
							$result = pg_query($conn,$sql);
							while($row = pg_fetch_assoc($result))
							{
							echo "
							<div class='item active'>
								<div class='col-sm-6'>
									<h1><span>CUỐN</span>-SHOPPER</h1>
									<h2>".$row['name']."</h2>
									<p>".$row['des']." </p>
									<button type='button' class='btn btn-default get'>Get it now</button>
								</div>
								<div class='col-sm-6'>
									<img src='../backend/trade_system/productimg/".$row['img']."' class='girl img-responsive' style = 'width:300px; height: 400px' />
									<img src='images/home/pricing.png' style='position: absolute;right: 8%;top: 58%;' alt='' />
									<div style='position: absolute;right:16%;top: 65%;display:block;width: 100px;height: 100px;background: #eeeeee;-moz-border-radius: 50px;-webkit-border-radius: 50px;--border-radius: 50px;border-radius: 50px;text-align:center;'>
									<h2 style='color:#dd0000;font-size:30px;font-weihgt:700;line-height:0.2em;display:block;margin-top:45px;';>ONLY</h2>
									<h2 style='color:#dd0000;font-size:20px;font-weihgt:200;line-height:0.2em;'>$".$row['price']."</h2>
									</div>
									
								</div>
							</div>
							";
							}
							$sql = "SELECT * FROM product WHERE idp IN ( SELECT idp FROM product GROUP BY quantity,idp HAVING quantity > (select avg(quantity) from product)) LIMIT 4 offset 1 ;";
							$result = pg_query($conn,$sql);
							while($row = pg_fetch_assoc($result))
							{
							echo "<div class='item'>

								<div class='col-sm-6'>
									<h1><span>CUỐN</span>-SHOPPER</h1>
									<h2>".$row['name']."</h2>
									<p>".$row['des']." </p>
									<button type='button' class='btn btn-default get'>Get it now</button>
								</div>
								<div class='col-sm-6'>
									<img src='../backend/trade_system/productimg/".$row['img']."' class='girl img-responsive' style = 'width:300px; height: 400px' />
									<img src='images/home/pricing.png' style='position: absolute;right: 8%;top: 58%;' alt='' />
									<div style='position: absolute;right:16%;top: 65%;display:block;width: 100px;height: 100px;background: #eeeeee;-moz-border-radius: 50px;-webkit-border-radius: 50px;--border-radius: 50px;border-radius: 50px;text-align:center;'>
									<h2 style='color:#dd0000;font-size:30px;font-weihgt:700;line-height:0.2em;display:block;margin-top:45px;';>ONLY</h2>
									<h2 style='color:#dd0000;font-size:20px;font-weihgt:50;line-height:0.2em;'>$".$row['price']."</h2>
									</div>
									
								</div>
							</div>";
						   }
							 ?>

							
							
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	