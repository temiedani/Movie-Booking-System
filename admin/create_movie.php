<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Movie</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="header">
		<h2>Admin - Create Movie <i class="fa fa-file-video-o"></i> </h2>
	</div>

	<form method="post" action="create_movie.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Title</label>
			<input type="text" name="title" >
		</div>

		<div class="input-group">
			<label>Synopsis</label>
			<textarea name="synopsis" rows="5" cols="40"></textarea>
		</div>
		<div class="input-group">
			<label>Auditorium</label>
			<input type="number" name="auditorium">
		</div>
		<div class="input-group">
			<label>Show time-1</label>
			<input type="datetime-local" name="show_time_1">
		</div>
		<div class="input-group">
			<label>Seats_1</label>
			<input type="number" min="1" max="120"  name="seats_1">
		</div>
		<div class="input-group">
			<label>Show time-2</label>
			<input type="datetime-local" name="show_time_2">
		</div>
		<div class="input-group">
			<label>Seats_2</label>
			<input type="number" min="1" max="120" name="seats_2">
		</div>
		<div class="input-group">
			<label>Trailer</label>
			<input type="url" placeholder="youtube link?" name="trailer">
		</div>
		<div class="input-group">
			<label>Select Movie Poster</label>
			<input type="file" name="poster">
		</div>
		<div class="input-group">
			<button type="submit" class="btn btn-info btn-md" name="add_movie_btn"> + Add Movie</button>
		</div>
		<p>
			Back to main page? <i class="fa fa-backward"></i> <a href="main_admin.php">Cancel</a>
		</p>
	</form>
</body>
</html>
