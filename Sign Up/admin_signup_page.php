<!doctype html>
<html lang="en">
  <head>
  	<title>PRICEWIZ</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="../top_nav.css">

	</head>
	<body>
		<header>
			<section>
				<?php include '../top_nav.html';?>
			</section>
		
		</header>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Admin Sign Up</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<div class="icon"><span class="fa fa-soccer-ball-o"></span></div>
								<h2>Admin Registration</h2>
								<p>Already have an account?</p>
								<a href="#" class="btn btn-white btn-outline-white">Sign In</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<h3 class="mb-4">Hello! <span>Please sign up to continue</span></h3>
				
							<form action="register_admin.php" class="signup-form" name="admin_signup_page.html" method="POST">
			      		<div class="form-group mb-4">
			      			<label class="label" for="full_name">Full Name:</label>
			      			<input
								type="varchar"
								class="form-control" 
								name="fullName"
								placeholder="John Smith"
								required>
			      		</div>
			      		<div class="form-group mb-4">
			      			<label class="label" for="user_name">Username:</label>
			      			<input 
								type="varchar"
								class="form-control"
								name="userName"
								placeholder="JohnSmith22"
								required>

							</div>
		            <div class="form-group mb-4">
		            	<label class="label" for="password">Password:</label>
		              <input 
					  	type="varchar"
						name="password"
						class="form-control" 
						placeholder="Password"
						required>
		            </div>
		            
		            <div class="form-group">
		            	<button type="submit" class="btn btn-primary rounded submit p-3" name="signup">Sign Up</button>
		            </div>
		          </form>
		          <div class="w-100 social-wrap">
					<p class="mt-4">I'm already a member! <a href="/PRICEWIZ/Login/admin_login_page.html">Sign In</a></p>
		          </div>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

