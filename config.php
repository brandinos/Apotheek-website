<?php
// Define credentials
define('DB_SERVER', 'localhost');	
define('DB_USERNAME', 'root');	
define('DB_PASSWORD', 'P@ssw0rd');	
define('DB_NAME', 'apotheek');	
// Attempt connection
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($conn == false)
{
	die("COULD NOT CONNECT. " .mysqli_connect_error());
}
?>
