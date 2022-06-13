<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Movie</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<?php
	$my_edit_title= $_GET['edit_title'];
	if (empty($my_edit_title)) {
	echo "Title not Recieved";
	}
	$edit_title= str_replace('~',' ', $my_edit_title);
	  //establish connection
	  $C = mysqli_connect("localhost", "root", "", "mycinema");
	  // Check connection
	  if ($C->connect_error) {
	    die("Connection failed: " . $C->connect_error);
	  }
		$movie_check_query = "SELECT * FROM movies WHERE title='$edit_title' LIMIT 1";
	  //$C->query($movie_check_query);
		$result = mysqli_query($C, $movie_check_query);
		$edit_movie = mysqli_fetch_assoc($result);

	?>
	<div class="header">
		<h2>Admin - Edit Movie</h2>
	</div>

	<form method="post" action="../functions.php">

		<?php echo display_error();
		?>

		<div class="input-group">
			<label>Title</label>
			<input type="text" value="<?php echo $edit_movie['title']; ?>" name="title" readonly >
		</div>
		<div class="input-group">
			<label>Synopsis</label>
			<input type="text" value="<?php echo $edit_movie['synopsis']; ?>" name="synopsis" required>
		</div>
		<div class="input-group">
			<label>Auditorium</label>
			<input type="number" value=<?php echo $edit_movie['Auditorium']; ?> name="auditorium" id="audi" required>
		</div>
		<div class="input-group">
			<label>Show time-1 <a style="color: #888;"><?php echo "previous: [".$edit_movie['show_time_1']; ?>]</a></label>
			<input type="datetime-local" value="<?php echo $edit_movie['show_time_1']; ?>" name="show_time_1" required>
		</div>
		<div class="input-group">
			<label>Seats-1</label>
			<input type="number" value="<?php echo $edit_movie['seats_1']; ?>" name="seats_1" required>
		</div>
		<div class="input-group">
			<label>Show time-2 <a style="color: #888;"><?php echo "previous: [".$edit_movie['show_time_2']; ?>]</a></label>
			<input type="datetime-local" value="<?php echo $edit_movie['show_time_2']; ?>" name="show_time_2" required>
		</div>
		<div class="input-group">
			<label>Seats-2</label>
			<input type="number" value="<?php echo $edit_movie['seats_2']; ?>" name="seats_2" required>
		</div>

		<div class="input-group">
			<label>Trailer</label>
			<input type="url" value="<?php echo $edit_movie['trailer']; ?>" name="trailer" required>
		</div>
		<div class="input-group">
			<label>Select Movie Poster <a  style="color: #888;"><?php echo "previous: [".$edit_movie['poster']; ?>]</a></label>
			<input type="file" value="<?php echo $edit_movie['poster']; ?>" name="poster" required>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="edit_movie_btn"> + Edit Movie</button>
		</div>
		<p>
			Back to main page? <a href="main_admin.php">Cancel</a>
		</p>

	</form>
<?php
	$C->close();
?>

</body>
</html>
