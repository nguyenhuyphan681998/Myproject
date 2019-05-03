<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="../backend/login_system/login_system.php" method="POST">
							<input type="username" placeholder="username" name="username"/>
							<input type="password" placeholder="Password" name="pwd"/>
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" name="submit">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="../backend/login_system/signup_system.php" method ="POST">
							
							<input type="text" placeholder="UserName" name = "username"/>
							<input type="password" placeholder="Password" name = "pwd"/>
							<input type="text" placeholder="Name" name = "name"/>
							<input type="text"  placeholder ="Age" name="age">
							<input type="text" placeholder ="Address" name="adress">
							<input type="email" placeholder="Email Address" name = "email"/>
							
							<button  style = "margin-left: 150px;" type="submit" name='submit'>Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	<?php
	//validiate from 
		$fulUrl= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if(strpos($fulUrl,'error=empty')){
			echo "<script>alert('Please fill all in field!');
			  </script>";
			
		}
		if(strpos($fulUrl,'error=notvail')){
			echo "<script>alert('The username or password is incorrect!')</script>";
		}
		if(strpos($fulUrl,'error=exist')){
			echo "<script>alert('The username is available!')</script>";
		}
		if(strpos($fulUrl,'error=email')){
			echo "<script>alert('The email is available!')</script>";
		}
	 ?>