<?php
	session_start();
	
	//Check button press
	if(isset($_POST['Login']))
	{
		echo 'Working';
	}
	else
	{
		echo 'Fuck you';
	}
	//Create connection and select database
	$conn = mysqli_connect("localhost", "root", "", "apotheek");
	//Check connection
	if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}
	else
		{
			echo "Connected successfully";
		}
	
	
	//Get values from a filled in login page (loginpage.php)
	if ($_POST['user'] != NULL && $_POST['pass'] != NULL)
	{
		$username = $_POST['user'];
		$password = $_POST['pass'];
	}
	
	
	//SQL injection prevention
	$username = stripcslashes($username);
	$password = stripcslashes($password);
	
	
	//Query the database
	$result = mysqli_query($conn, "select * from login where username = '$username' and password = '$password'")
		or die("Failed to query database ".mysqli_error());
	$row = mysqli_fetch_array($result);
	if ($row['username'] != NULL && $row['password'] != NULL)
	{
		if ($row['username'] == $username && $row['password'] == $password)
		{
			echo "Login Success!  Welcome ".$row['username'];
		}
		else
		{ 
			echo "Login failed!";
		}
	}
	else
	{
		echo "Vul de velden in!";
	}
	
	
	
	
?>