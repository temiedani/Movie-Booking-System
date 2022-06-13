<?php
	include('../functions.php');
?>
<!DOCTYPE html>
<html>
<head>
</head>

<body>
<?php
$my_delete_title = $_GET['delete_title'];
if (empty($my_delete_title)) {
echo "Title not Recieved";
}
$delete_title= str_replace('~',' ', $my_delete_title);
  //establish connection
  $C = mysqli_connect("localhost", "root", "", "mycinema");
  // Check connection
  if ($C->connect_error) {
    die("Connection failed: " . $C->connect_error);
  }
  $delete = "DELETE FROM movies WHERE title='$delete_title'";
  $C->query($delete);
	$unavailable_query = "UPDATE booking SET status='Unavailable' WHERE b_title='$delete_title'";
	$C->query($unavailable_query);
  $C->close();

  header('location: main_admin.php');
?>
</body>
</html>
