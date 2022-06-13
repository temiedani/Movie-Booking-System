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
	<!-- Add icon library -->
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
					<a class="nav-link" href="mybooking.php">My Booking <i class="fa fa-folder"></i></a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right ml-auto">
				<!-- logged in user information -->
				<?php  if (isset($_SESSION['user'])) : ?>
					<li class="nav-item active">
						<a  style="color: white; " ><?php echo $_SESSION['user']['username']; ?></a>
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
			<?php if (isset($_SESSION['success'])) : ?>
				<div class="alert alert-success">
					<strong>Welcome to KU Cinema!</strong>
					<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</div>
			<?php endif ?>
			<h1 style=" text-align: center;text-transform: uppercase; color: #4CAF50">Available Movies</h1>
		</div>
	<header class="page-header header container-fluid">
	<div class="container features">
		<div class="row">
			<?php
			$conn = mysqli_connect("localhost", "root", "", "mycinema");
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$sql = "SELECT title, synopsis,auditorium,show_time_1,seats_1,show_time_2,seats_2,trailer,poster FROM movies";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()) {
				$movie_title=$row["title"];
				$mytitle= str_replace(' ', '~', $movie_title);
				$movie_synopsis=$row["synopsis"];
				$movie_auditorium=$row["auditorium"];
				$movie_show_time_1=$row["show_time_1"];
				$movie_seats_1=$row["seats_1"];
				$movie_show_time_2=$row["show_time_2"];
				$movie_seats_2=$row["seats_2"];
				$movie_trailer=$row["trailer"];
				$movie_poster=$row["poster"];
				?>
				<div class="col-lg-3 col-md-3 col-sm-12">
					<div class="card" style="width: 18rem;">
						<img src="<?php echo "images/".$movie_poster; ?>" class="card-img-top" alt="...">
						<div class="card-body">
							<h4 class="card-title"><?php echo $movie_title; ?></h4>
							<p class="card-text"><?php echo $movie_synopsis; ?></p>
							<h4 class="text-muted"><?php echo "Audi: ".$movie_auditorium; ?></h4>
							<i class="fa fa-clock-o"></i>
							<strong style="color:Tomato;"><?php echo "Time: ".$movie_show_time_1; ?></strong>
							<br>
							<strong style="text-align:center;" ><?php echo "Seats: ".$movie_seats_1; ?></strong>
							<i class="fa fa-user"></i>
							<br>
							<i class="fa fa-clock-o"></i>
							<strong style="color:DodgerBlue;"><?php echo "Time: ".$movie_show_time_2; ?></strong>
							<br>
							<strong style="text-align:center;"><?php echo "Seats: ".$movie_seats_2; ?></strong>
							<i class="fa fa-user"></i>
							<br><br>
							<div class="row">
								<button class="btn btn-info" onclick="window.open('<?php echo $movie_trailer;?>','popUpWindow','height=500,width=650,left=150,top=150');">
								<i class="fa fa-youtube-play"></i>  Trailer</button>
									&nbsp;
								<a class="btn btn-success" href="book_movie.php?book_title=<?php echo $mytitle; ?>">Book movie <i class="fa fa-bookmark"></i></a>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			$conn->close();
			?>
		</div>
	</div>
<!-- Footer -->
<footer class="page-footer font-small teal pt-4">
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2019 Copyright:
    <a href="https://www.ku.ac.ae/"> Ku.ac.ae</a>
  </div>
  <!-- Copyright -->
</footer>
<div class="skypebutton">
	<span class="skype-button rounded" data-contact-id="amulove80" data-text="Request Service from Doctor"></span>
	<span class="skype-chat" data-color-message="#27555B"></span>
	<script src="https://swc.cdn.skype.com/sdk/v1/sdk.min.js"></script>
</div>
</header>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
