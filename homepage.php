<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
    header("location: loginpage.php");
    exit;
}
else
{
	echo "You're logged in! Welcome " .$_SESSION["username"];
}


?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="">
</head>
<body>
<div>
    <form action="logoutpage.php" method="POST">
		<input type="submit" value="logout" />
	</form>
</div>
</body>
</html>