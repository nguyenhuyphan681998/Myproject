
<section id="advertisement">
		<?php 
			$fulUrl= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if(strpos($fulUrl,'sucess'))
			{
				echo "<script type='text/javascript'>
        			var timeout = setTimeout(function(){
            		 alert('Buy successfully!');
        			},1000);
        			
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
		
	</section>
	
	<section>
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Shop</li>
				</ol>
			</div><!--/breadcrums-->
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
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">All Items</h2>
						<?php include_once('./shop/feature.php') ?>
						
						
					</div><!--features_items-->
					<?php 
					echo "
								<ul class='pagination' style='margin-left:50%;'>";
								
								
									if(strpos($fulUrl,'?brand'))
									{
										if(strpos($fulUrl,'&page'))
										{
											$fulUrl = explode('&page',$fulUrl);
											array_pop($fulUrl);
											$fulUrl= implode($fulUrl);
											
											for($b=1;$b<=$a;$b++)
											{
											echo "<li><a href='".$fulUrl."&page=".$b."'>".$b."</a></li>";
											}
										}else
										{
											for($b=1;$b<=$a;$b++)
												{
													echo "<li><a href='".$fulUrl."&page=".$b."'>".$b."</a></li>";
												}
											
										}
										
									}else
									{
											for($b=1;$b<=$a;$b++)
												{
													echo "<li><a href='shop.php?page=".$b."'>".$b."</a></li>";
												}
										
										
									}
 ?>
				</div>
			</div>
		</div>
	</section>
<script type="text/javascript">
	    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });
</script>