
<?php 
	include('database.php');
	include('functions.php');	

	//connect to DB
	$conn = connect_db();
	//get data from the form
	$PID = $_POST['PID'];
	$comment = $_POST['comment'];
	$UID = $_POST['UID'];
	$name = $_POST['name'];
	
	$PID = strip_tags($PID);
	$PID = htmlentities($PID);
	$PID = stripslashes($PID);
	$PID = mysqli_real_escape_string($conn, $PID);
	
	$comment = strip_tags($comment);
	$comment = htmlentities($comment);
	$comment = stripslashes($comment);
	$comment = mysqli_real_escape_string($conn, $comment);
	
	$UID = strip_tags($UID);
	$UID = htmlentities($UID);
	$UID = stripslashes($UID);
	$UID = mysqli_real_escape_string($conn, $UID);
	
	$name = strip_tags($name);
	$name = htmlentities($name);
	$name = stripslashes($name);
	$name = mysqli_real_escape_string($conn, $name);
	
	//Query and insert comment
	$result = mysqli_query($conn, "INSERT INTO comments (post_id, comment, UID, name_of_poster) VALUES ('$PID', '$comment', '$UID', '$name')");
	if($result){
		header('Location: feed.php');
	}else{
		echo "Something is wrong!";
	}
 ?>

