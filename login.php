<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to KU Cinema</title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

	<div class="header">
		<h2>Login</h2>
	</div>

	<form method="post" action="login.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button class="btn btn-md btn-info" type="submit"  name="login_btn">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>

	<!-- Footer -->
	<footer class="page-footer font-small teal pt-4">
	  <!-- Copyright -->
	  <div style=" text-align: center" class="footer-copyright text-center py-3">© 2019 Copyright:
	    <a href="https://www.ku.ac.ae/"> Ku.ac.ae</a>
	  </div>
	  <!-- Copyright -->
	</footer>
</body>
</html>
