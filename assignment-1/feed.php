<!DOCTYPE html>
<html>
<head>
	<title>My Facebook Feed</title>
</head>
<body>
<?php
	include('database.php');
	
	session_start();

	$conn = connect_db();

	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	//user information 
	$row = mysqli_fetch_assoc($result);
	$id = $row['id'];
	echo "<h1>Welcome back, ".$row['Name']."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";
	echo "<hr>";

	echo "<form method='POST' action='posts.php'>";
	echo "<p><textarea name='content'>Say something...</textarea></p>";
	echo "<input type='hidden' name='UID' value='$id'>";
	echo "<p><input type='submit'></p>";	
	echo "</form>";

	echo "<br>";

	$result_posts = mysqli_query($conn, "SELECT * FROM posts WHERE UID='$id'");
	$num_of_rows = mysqli_num_rows($result_posts);

	echo "<h2>My Feed</h2>";
	if ($num_of_rows == 0) {
		echo "<p>No new posts to show!</p>";
	}

	//show all posts on myfacebook
	for($i = 0; $i < $num_of_rows; $i++){

		$row = mysqli_fetch_row($result_posts);
		//Display post
		echo "$row[3] said: <blockquote>'$row[1]' --- $row[6]</blockquote>";
	
		//likes form
		echo "<form action='likes.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'> <input type='submit' value='Like'>($row[5] likes)</form> ";
		
		//comments form
		echo "<form action='comments.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'> <input type='submit' value='Comment'>";
		//comment content
		echo "<p><textarea name='comment'>Comments go here...</textarea></p>";
		//Display comments between comment button and text area
		$result_comments = mysqli_query($conn, "SELECT * FROM comments WHERE post_id='$row[0]'");
		$num_of_rows_comments = mysqli_num_rows($result_comments);
		for ($j = 0; $j < $num_of_rows_comments; $j++){
			$row_comment = mysqli_fetch_row($result_comments);
			
			echo "<p>$row_comment[4] commented: <blockquote>'$row_comment[2]' --- $row_comment[5]</blockquote></p><br>";
		}
			//PostID
		echo "<input type='hidden' name='PID' value='$row[0]'>";
			//ID of commenter
		echo "<input type='hidden' name='UID' value='$row[2]'>";
		echo "<input type='hidden' name='name' value='$row[3]'>";
		echo "</form>";
		echo "<br>";
		echo "<hr>";
	}

?>


</body>
</html>
