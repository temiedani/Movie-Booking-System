<?php
	session_start();

	// establish a connection to database
	$db = mysqli_connect('localhost', 'root', '', 'mycinema');

	// variable declaration
	$username = "";
	$email    = "";
	$errors   = array();

	// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}
	// call the login() function if login_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}
  //logout button is clicked Cancell All RESREVATIONS!
	if (isset($_GET['logout'])) {
		$user=$_SESSION['user']['username'];
		$Reservations="SELECT count(*) as reservations FROM booking WHERE b_username='$user' and status='RESERVED'";
		$result = mysqli_query($db, $Reservations);
		$data=mysqli_fetch_assoc($result);
		$reserved_count=$data['reservations'];
    //get details of RESERVED tickets by current user
		While($reserved_count>0){
			$get_tickets=" SELECT * FROM booking WHERE b_username='$user' and status='RESERVED'";
			$result = mysqli_query($db, $get_tickets);
			$cancelled_tickets = mysqli_fetch_assoc($result);
			$x=$cancelled_tickets['tickets'];
			$y=$cancelled_tickets['b_title'];
			$z=$cancelled_tickets['b_show_time'];
			$w=$cancelled_tickets['b_id'];
			//Cancel all movies Reserved by the user on each booking id
			$cancel_query = "UPDATE booking SET status='CANCELLED' WHERE b_username='$user' and  b_id='$w' and status='RESERVED'";
			mysqli_query($db, $cancel_query);

			//Return Cancelled tickets to movie seats number
			$update_seats_1 = "UPDATE movies SET seats_1=seats_1+'$x' WHERE show_time_1='$z' and title='$y'";
			mysqli_query($db, $update_seats_1);
			$update_seats_2 = "UPDATE movies SET seats_2=seats_2+'$x' WHERE show_time_2='$z' and title='$y'";
			mysqli_query($db, $update_seats_2);

			$reserved_count=$reserved_count-1;
		}
		//Destroy session and redirect user to login page.
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../login.php");
	}
	//Add Movie button is clicked
	if (isset($_POST['add_movie_btn'])) {
		addmovie();
	}
	//Edit Movie button is clicked
	if (isset($_POST['edit_movie_btn'])) {
		editmovie();
	}
	//Book Movie button is clicked
	if (isset($_POST['book_movie_btn'])) {
		bookmovie();
	}
	//Cancel booking button is clicked
	if (isset($_POST['cancel_booking_btn'])) {
		cancelbooking();
	}
	//Confirm booking button is clicked
	if (isset($_POST['confirm_booking_btn'])) {
		confirmbooking();
	}

	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  mysqli_real_escape_string($db,$_POST['username']);
		$email       =  mysqli_real_escape_string($db,$_POST['email']);
		$password_1  =  mysqli_real_escape_string($db,$_POST['password_1']);
		$password_2  =  mysqli_real_escape_string($db,$_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		//check if the password enterede are
		if (empty($password_1)) {
			array_push($errors, "Password is required");
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		// first check the database to make sure
		// a user does not already exist with the same username and/or email
		$user_check_query = "SELECT * FROM admin_users WHERE username='$username' OR email='$email' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // if user exists
			if ($user['username'] === $username) {
				array_push($errors, "Username already exists");
			}

			if ($user['email'] === $email) {
				array_push($errors, "email already exists");
			}
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			if (isset($_POST['user_type'])) {
				$user_type = mysqli_real_escape_string($db,$_POST['user_type']);
				$query = "INSERT INTO admin_users(username, email, user_type, password)
						  VALUES('$username', '$email', '$user_type', '$password')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
				header('location: main_admin.php');
			}else{
				$query = "INSERT INTO admin_users (username, email, user_type, password)
						  VALUES('$username', '$email', 'user', '$password')";
				mysqli_query($db, $query);

				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');
			}

		}

	}
	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM admin_users WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}
	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = mysqli_real_escape_string($db,$_POST['username']);
		$password = mysqli_real_escape_string($db,$_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM admin_users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in as an ADMIN";
					header('location: admin/main_admin.php');
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in as a USER";

					header('location: index.php');
				}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
	// check if user is Admin or Not
	function isLoggedIn(){
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}
	//check if the logged user is Admin
	function isAdmin(){
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}
	//Display any Errors
	function display_error(){
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}
	//Add new movies by Admin
	function addmovie(){
			global $db, $errors;

			// receive all input values from the add movie form
			$title =  mysqli_real_escape_string($db,$_POST['title']);
			$synosis  =  mysqli_real_escape_string($db,$_POST['synopsis']);
			$auditorium  =  mysqli_real_escape_string($db,$_POST['auditorium']);
			$show_time_1 =  mysqli_real_escape_string($db,$_POST['show_time_1']);
			$seats_1 =  mysqli_real_escape_string($db,$_POST['seats_1']);
			$show_time_2 =  mysqli_real_escape_string($db,$_POST['show_time_2']);
			$seats_2  =  mysqli_real_escape_string($db,$_POST['seats_2']);
			$trailer  =  mysqli_real_escape_string($db,$_POST['trailer']);
			$poster  =  mysqli_real_escape_string($db,$_POST['poster']);

			// form validation: ensure that the movie addition form is correctly filled
			if (empty($title)) {
				array_push($errors, "Title is required");
			}
			if (empty($auditorium)) {
				array_push($errors, " Auditorium is required!");
			}
			/*
			if (empty($synopsis)) {
				array_push($errors, "Synopsis is required");
			}*/
			if (empty($show_time_1)) {
				array_push($errors, " Show time-1 is required!");
			}
			if (empty($seats_1)) {
				array_push($errors, " Seat-1  is required!");
			}
			if (empty($show_time_2)) {
				array_push($errors, " Show time-1 is required!");
			}
			if (empty($seats_2)) {
				array_push($errors, " Seat-1  is required!");
			}
			if (empty($trailer)) {
				array_push($errors, " Movie Trailer is required!");
			}
			if (empty($poster)) {
				array_push($errors, " Movie Poster is required!");
			}
			// first check the database to make sure
			// a movies does not already exist with the same title
			$movie_check_query = "SELECT * FROM movies WHERE title='$title' LIMIT 1";
			$result = mysqli_query($db, $movie_check_query);
			$movie = mysqli_fetch_assoc($result);

			if ($movie) { // if movie exists
				if ($movie['title'] === $title) {
					array_push($errors, "Movie Title already exists");
				}

			}

			// Add movie  if there are no errors in the form
			if (count($errors) == 0) {

					$add_query = "INSERT INTO movies(title, synopsis,auditorium, show_time_1,seats_1,show_time_2,seats_2,trailer,poster)
								VALUES('$title', '$synosis','$auditorium','$show_time_1','$seats_1','$show_time_2','$seats_2','$trailer','$poster')";
					mysqli_query($db, $add_query);
					$_SESSION['success']  = "New Movie successfully created!!";
					header('location: main_admin.php');
		}
	}
	//Edit a movie by Admin
	function editmovie(){
		global $db, $errors;
		$edit_conn = mysqli_connect("localhost", "root", "", "mycinema");
	  // Check connection
	  if ($edit_conn->connect_error) {
	    die("Connection failed: " . $edit_conn->connect_error);
	  }

		// receive all input values from the edit movie form
		$title =$_POST['title'];
		$synosis  =  $_POST['synopsis'];
		$auditorium  =$_POST['auditorium'];
		$show_time_1 =  $_POST['show_time_1'];
		$seats_1 =  $_POST['seats_1'];
		$show_time_2 =  $_POST['show_time_2'];
		$seats_2=  $_POST['seats_2'];
		$trailer  = $_POST['trailer'];
		$poster  = $_POST['poster'];

		// form validation: ensure that the movie edit form is correctly filled
		if (empty($title)) {
			array_push($errors, "Title is required");
		}
		if (empty($auditorium)) {
			array_push($errors, " Auditorium is required");
		}
		if (empty($show_time_1)) {
			array_push($errors, " Show time-1 is required!");
		}
		if (empty($seats_1)) {
			array_push($errors, " Seat-1 is required!");
		}
		if (empty($show_time_2)) {
			array_push($errors, " Show time-2 is required!");
		}
		if (empty($seats_2)) {
			array_push($errors, " Seat-2 is required!");
		}
		if (empty($trailer)) {
			array_push($errors, " Movie Trailer is required!");
		}
		if (empty($poster)) {
			//array_push($errors, " Movie Poster is required!");
		}
		// first check the database to make sure
		// a movie already exist with the same title
		$movie_check_query = "SELECT * FROM movies WHERE title='$title' LIMIT 1";
		$result = mysqli_query($db, $movie_check_query);
		$movie = mysqli_fetch_assoc($result);

		if (!($movie)) { // if user exists
			array_push($errors, "Movie (Title) does not exists");
		}
		// Edit movie  if there are no errors in the form
		if (count($errors) == 0 ){
			$edit_query = "UPDATE movies SET synopsis='$synosis',Auditorium='$auditorium', show_time_1='$show_time_1',seats_1='$seats_1',show_time_2='$show_time_2',seats_2='$seats_2',trailer='$trailer',poster='$poster' WHERE title='$title'";
			$edit_conn->query($edit_query);
		  $edit_conn->close();
			$_SESSION['success']  = "Movie successfully Edited!!";
			header('location: admin/main_admin.php');
		}}
	//User booking a movie
	function bookmovie(){
		global $db, $errors;
	  $b_username=$_SESSION['user']['username'];
	  $b_title =mysqli_real_escape_string($db,$_POST['book_title']);
	  $b_auditorium =mysqli_real_escape_string($db,$_POST['book_auditorium']);
		$b_show_time =mysqli_real_escape_string($db,$_POST['book_show_time']);
		$b_tickets =mysqli_real_escape_string($db,$_POST['book_tickets']);
		$b_status =mysqli_real_escape_string($db,$_POST['book_status']);
		if (empty($b_title)) {
			array_push($errors, "Title is required");
		}
		if (empty($b_auditorium)) {
			array_push($errors, " Auditorium is required");
		}
		if (empty($b_show_time)) {
			array_push($errors, " Show time is required!");
		}
		if (empty($b_tickets)) {
			array_push($errors, " Tickets numbers is required!");
		}
		if (empty($b_status)) {
			array_push($errors, " Booking status is required!");
		}
		if (count($errors) == 0) {
				$book_query = "INSERT INTO booking(b_username,b_title,b_auditorium,b_show_time,tickets,status)
							VALUES('$b_username','$b_title','$b_auditorium','$b_show_time','$b_tickets','$b_status')";
				$result = mysqli_query($db, $book_query);

	      $update_seats_1 = "UPDATE movies SET seats_1=seats_1-'$b_tickets' WHERE show_time_1='$b_show_time' and title='$b_title'";
				$result = mysqli_query($db, $update_seats_1);

	      $update_seats_2= "UPDATE movies SET seats_2=seats_2-'$b_tickets' WHERE show_time_2='$b_show_time' and title='$b_title'";
				$result = mysqli_query($db, $update_seats_2);

				$_SESSION['success']  = "Movie successfully ".$b_status."!!";
				echo $_SESSION['success'];
				header('location: index.php');
			}
	}
	//User Confirming a Reserved booking
	function confirmbooking(){
		//establish connection
		$confirm_conn = mysqli_connect("localhost", "root", "", "mycinema");
		// Check connection
		if ($confirm_conn->connect_error) {
			die("Connection failed: " . $confirm_conn->connect_error);
		}
		$confirm =$_POST['confirm_b_id'];
		$confirm_query = "UPDATE booking SET status='BOOKED' WHERE b_id='$confirm'";
		$confirm_conn->query($confirm_query);
		header('location: mybooking.php');
	}
	//User cancelling a booking
	function cancelbooking(){
		//establish connection
		$cancel_conn = mysqli_connect("localhost", "root", "", "mycinema");
		// Check connection
		if ($cancel_conn->connect_error) {
			die("Connection failed: " . $cancel_conn->connect_error);
		}
		$cancel =$_POST['cancel_b_id'];
		$cancel_query = "UPDATE booking SET status='CANCELLED' WHERE b_id='$cancel'";
		$cancel_conn->query($cancel_query);

		$get_tickets=" SELECT * FROM booking WHERE b_id='$cancel'";
		//$result=$cancel_conn->query($get_tickets);
		$result = mysqli_query($cancel_conn, $get_tickets);
		$cancelled_tickets = mysqli_fetch_assoc($result);
		$a=$cancelled_tickets['tickets'];
		$b=$cancelled_tickets['b_title'];
		$c=$cancelled_tickets['b_show_time'];

		$update_seats_1 = "UPDATE movies SET seats_1=seats_1+'$a' WHERE show_time_1='$c' and title='$b'";
		echo $update_seats_1;
		$cancel_conn->query($update_seats_1);
		$update_seats_2 = "UPDATE movies SET seats_2=seats_2+'$a' WHERE show_time_2='$c' and title='$b'";
		echo $update_seats_2;
		$cancel_conn->query($update_seats_2);

		header('location: mybooking.php');
	}
	?>
