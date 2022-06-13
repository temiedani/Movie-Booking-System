  <?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL - Create user</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.header {
			background: #5F9EA0;
		}
		button[name=register_btn] {
			background: #5F9EA0;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - create user <i class="fa fa-user-plus"></i></h2>
	</div>

	<form method="post" action="create_user.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
    <div class="input-group">
			<label>Skype username</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>User type</label>
			<select name="user_type" id="user_type" >
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
			<button type="submit" class="btn btn-info btn-md" name="register_btn">Create user <i class="fa fa-user-plus"style="color:black"></i></button>
    <p>
			Back to main page?  <i class="fa fa-backward"></i> <a href="main_admin.php">Cancel</a>
		</p>
	</form>
</body>
</html>
