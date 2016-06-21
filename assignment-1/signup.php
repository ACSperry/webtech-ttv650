<?php
		
	//start session
	session_start();
	include('database.php');	
	include('functions.php');	
	//get user info from $_POST
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['fullname'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$question = $_POST['verification_question'];
	$answer = $_POST['verification_answer'];
	$location = $_POST['location'];
	$pic = $_POST['profile_pic'];
	
	//hash password
	$hashed_pass = password_hash($password, PASSWORD_DEFAULT);
	
	//connect to DB
	$conn = connect_db();
	
	//Sanitize
	$username = strip_tags($username);
	$username = htmlentities($username);
	$username = stripslashes($username);
	$username = mysqli_real_escape_string($conn, $username);
	
	$password = strip_tags($password);
	$password = htmlentities($password);
	$password = stripslashes($password);
	$password = mysqli_real_escape_string($conn, $password);
	
	$name = strip_tags($name);
	$name = htmlentities($name);
	$name = stripslashes($name);
	$name = mysqli_real_escape_string($conn, $name);
	
	$email = strip_tags($email);
	$email = htmlentities($email);
	$email = stripslashes($email);
	$email = mysqli_real_escape_string($conn, $email);
	
	$dob = strip_tags($dob);
	$dob = htmlentities($dob);
	$dob = stripslashes($dob);
	$dob = mysqli_real_escape_string($conn, $dob);
	
	$gender = strip_tags($gender);
	$gender = htmlentities($gender);
	$gender = stripslashes($gender);
	$gender = mysqli_real_escape_string($conn, $gender);
	
	$question = strip_tags($question);
	$question = htmlentities($question);
	$question = stripslashes($question);
	$question = mysqli_real_escape_string($conn, $question);
	
	$answer = strip_tags($answer);
	$answer = htmlentities($answer);
	$answer = stripslashes($answer);
	$answer = mysqli_real_escape_string($conn, $answer);
	
	$location = strip_tags($location);
	$location = htmlentities($location);
	$location = stripslashes($location);
	$location = mysqli_real_escape_string($conn, $location);
	
	$pic = strip_tags($pic);
	$pic = htmlentities($pic);
	$pic = stripslashes($pic);
	$pic = mysqli_real_escape_string($conn, $pic);
	//Insert
	$result = mysqli_query($conn, "SELECT * FROM users WHERE Username = '$username'");
	$row = mysqli_fetch_assoc($result);
	if($row > 0){
		//throw an error
		echo $row['Name']."<br>";
		echo "Oops! That username isn't available! Please try again!";
		//redirect to signup page 
	//	header("Location: signup.html");
	}
	else{
		$result_insert = mysqli_query($conn, "INSERT INTO users(Username, Password, Name, email, dob, gender, verification_question, verification_answer, location, profile_pic) VALUES ('$username', '$hashed_pass', '$name', '$email', '$dob', '$gender', '$question', '$answer', '$location', '$pic')");
		//check if insert was okay
		if($result_insert){
			//redirect to feed page 
			$_SESSION["username"] = $username;
			header("Location: feed.php");
		}else{
			//throw an error	
			echo "Oops! Something went wrong! Please try again!";
		}
	}
?>
