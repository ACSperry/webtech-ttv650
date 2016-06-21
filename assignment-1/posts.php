<?php
	
	session_start();
	include('database.php');
	include('functions.php');	
	//Get data from the form
	$content = $_POST['content'];
	$UID = $_POST['UID'];
	//connect to DB
	$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$UID'");
	$row = mysqli_fetch_assoc($result);
	//Fetch User information	
	$name = $row["Name"];
	$profile_pic = $row["profile_pic"];

	//Sanitize content
	$content = strip_tags($content);
	$content = htmlentities($content);
	$content = stripslashes($content);
	$content = mysqli_real_escape_string($conn, $content);
	
	//Sanitize UID
	$UID = strip_tags($UID);
	$UID = htmlentities($UID);
	$UID = stripslashes($UID);
	$UID = mysqli_real_escape_string($conn, $UID);
	
	//Sanitize name
	$name = strip_tags($name);
	$name = htmlentities($name);
	$name = stripslashes($name);
	$name = mysqli_real_escape_string($conn, $name);
	
	//Sanitize pic
	$profile_pic = strip_tags($profile_pic);
	$profile_pic = htmlentities($profile_pic);
	$profile_pic = stripslashes($profile_pic);
	$profile_pic = mysqli_real_escape_string($conn, $profile_pic);
	
	//Insert post
	$result_insert = mysqli_query($conn, "INSERT INTO posts(content, UID, name, profile_pic, likes) VALUES ('$content', '$UID', '$name', '$profile_pic', 0)");

	//check if insert was okay
	if($result_insert){
		//redirect to feed page 
		header("Location: feed.php");
	}else{
		//throw an error	
		echo "Oops! Something went wrong! Please try again!";
	}
 
?>
