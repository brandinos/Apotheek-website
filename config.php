<?php
//Start connection
define('DB_SERVER', 'localhost');	
define('DB_USERNAME', 'root');	
define('DB_PASSWORD', '');	
define('DB_NAME', 'apotheek');	

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn == false)
{
	die("COULD NOT CONNECT. " .mysqli_connect_error());
}
?>

JEMOEDER! hahahahaa