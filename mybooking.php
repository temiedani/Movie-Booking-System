<?php
	include('functions.php');

	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home-User</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
		<a class="navbar-brand" href="#">
			<img src="images/KU.png" width="35" height="35" class="d-inline-block align-top" alt="">
			KU Cinema</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php"><i class="fa fa-backward"></i> Back to Main-Page</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right ml-auto">
				<!-- logged in user information -->
				<?php  if (isset($_SESSION['user'])) : ?>
					<li class="nav-item active">
						<a style="color: white; " ><?php echo $_SESSION['user']['username']; ?></a>
						<i  style="color:#888;">(<?php echo ($_SESSION['user']['user_type']); ?>)</i>
					</li>
				<?php endif ?>
				<li class="nav-item active">
					<a class="btn btn-info btn-sm"  href="index.php?logout='1'" style="color: white; ">Logout <i class='fa fa-sign-out' style="font-size:24px"></i></a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="description">
		<br><br><br>
		<!-- notification message -->
		<h1 style=" text-align: center;text-transform: uppercase;color: #4CAF50">Your Booking@<?php echo $_SESSION['user']['username']; ?>: </h1>
	</div>
	<header class="page-header header container-fluid">
	<div class="container features">
<!--Table-->
<table  class="table table-striped table-bordered ">
<!--Table head-->
<thead class="thead-dark">
  <tr >
    <th>#</th>
    <th>Booking ID</th>
    <th>Movie Title</th>
    <th>Auditorium</th>
    <th>Show Time</th>
    <th>Tickets</th>
    <th>Status</th>
    <th>Actions</<th>
		<th></<th>

  </tr>
</thead>
<!--Table head-->
<tbody>
<?php
$conn = mysqli_connect("localhost", "root", "", "mycinema");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$user=$_SESSION['user']['username'];
$sql = "SELECT * FROM booking WHERE b_username='$user' ORDER BY b_id DESC";
$result = $conn->query($sql);
$counter=1;
while($row = $result->fetch_assoc()) {
  ?>
  <!--Table body-->
    <tr>
      <th scope="row"><?php echo $counter; ?></th>
			<?php $counter++ ?>
      <td><?php echo $row["b_id"]; ?></td>
      <td><?php echo $row["b_title"]; ?></td>
      <td><?php echo $row["b_auditorium"]; ?></td>
      <td><?php echo $row["b_show_time"]; ?></td>
      <td><?php echo $row["tickets"]; ?></td>
      <td><?php echo $row["status"]; ?></td>
      <?php  if ($row["status"]=='RESERVED') : ?>
        <form method="post" action="functions.php">
          <input type="hidden" name="confirm_b_id" value="<?php echo $row["b_id"]; ?>">
          <td href="#"><button class="btn btn-sm btn-success " name="confirm_booking_btn">Book <i class="fa fa-bars"></i></button></td>
        </form>
      <?php endif ?>
      <?php  if ($row["status"]=='BOOKED') : ?>
        <th></th>
      <?php endif ?>
      <?php  if ($row["status"]=='BOOKED' or $row["status"]=='RESERVED' ) : ?>
      <form method="post" action="functions.php">
        <input type="hidden" name="cancel_b_id" value="<?php echo $row["b_id"]; ?>">
        <td href="#"><button class="btn btn-sm btn-danger" type="submit"  name="cancel_booking_btn">Cancel <i class="fa fa-trash"></i></button></td>
      </form>
		<?php endif ?>
    </tr>
<?php
}
 ?>
</tbody>
<!--Table body-->
</table>
<!--Table-->
<?php
$conn->close();
?>
</div>
<!-- Footer -->
<footer class="page-footer font-small teal pt-4">
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2019 Copyright:
    <a href="https://www.ku.ac.ae/"> Ku.ac.ae</a>
  </div>
  <!-- Copyright -->
</footer>
</header>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
