<?php include('functions.php') ?>

<!DOCTYPE html>
<html>
<head>
	<title>Book Movie <?php echo $_SESSION['user']['username'];?></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	$my_book_title = $_GET['book_title'];
	if (empty($my_book_title)) {
	echo "Title not Recieved";
	}
	$book_title= str_replace('~',' ', $my_book_title);
	  //establish connection
	  $book_conn = mysqli_connect("localhost", "root", "", "mycinema");
	  // Check connection
	  if ($book_conn->connect_error) {
	    die("Connection failed: " . $book_conn->connect_error);
	  }
		$movie_check_query = "SELECT * FROM movies WHERE title='$book_title' LIMIT 1";
	  //$C->query($movie_check_query);
		$result = mysqli_query($book_conn, $movie_check_query);
		$book_movie = mysqli_fetch_assoc($result);

		?>

	<div class="header">
		<h2>User - Book/Reserve Movie</h2>
	</div>
	<form method="post" action="functions.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Title</label>
			<input type="text" value="<?php echo $book_movie['title']; ?>" name="book_title" readonly >
		</div>

		<div class="input-group">
			<label>Auditorium</label>
			<input type="number"  value="<?php echo $book_movie['Auditorium']; ?>" name="book_auditorium" readonly >
		</div>

		<div class="input-group">
			<label>Show times</label>
      <select name="book_show_time" id="book_show_time" >
				<option value="<?php echo $book_movie['show_time_1']; ?>"><?php echo $book_movie['show_time_1']; ?></option>
				<option value="<?php echo $book_movie['show_time_2']; ?>"><?php echo $book_movie['show_time_2']; ?></option>
			</select>
		</div>
		<div class="input-group">
			<label>Tickets</label>
			<input type="number" min="1" max="5" value="1" placeholder="Please enter num of tickets you want? min=1 max=5."name="book_tickets" required>
		</div>
		<div class="input-group">
			<label>Status</label>
      <select name="book_status" id="book_status" >
				<option value="RESERVED" >Reserve</option>
				<option value="BOOKED">Book</option>
			</select>
		</div>
		<div class="input-group">
			<button type="submit" class="btn btn-primary btn-md" name="book_movie_btn">Book movie</button>
		</div>
		<p>
			Back to main page? <a href="index.php">Cancel</a>
		</p>
	</form>
</body>
</html>
