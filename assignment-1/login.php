<?php
		
	//start session
	session_start();	
	include('database.php');
	//get username and password from $_POST
	$username = $_POST["username"];
	//user's password
	$password = $_POST["password"];
	
	//connect to DB
	$conn = connect_db();
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
	$num_of_rows = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
	//stored hashed_password
	$hashed_pass = $row["Password"];
	//Check in the DB
	if($num_of_rows > 0){
		//Authenticate hash
		$verified = password_verify ($password, $hashed_pass);
		if($verified){
			//If authenticated: say hello!
			$_SESSION["username"] = $username;
			header("Location: feed.php");
			//echo "Success!! Welcome ".$username;
		}
	}else{
		//else ask to login again..	
		echo "Invalid password! Try again!";
	}
?>
