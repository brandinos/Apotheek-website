<?php
require_once "config.php";

$passkey = $_GET['passkey'];
$sql1 = "SELECT activation_code FROM login WHERE activation_code = ?";
$sql2 = "UPDATE login SET activation_status = '1' WHERE activation_code = ?";
<<<<<<< HEAD
=======
$sql3 = "UPDATE login SET activation_code = NULL WHERE activation_code = ?";
>>>>>>> 327d380028e9918d3bc18b430e40dc875ebb6b67
        if($stmt = mysqli_prepare($conn, $sql1))
		{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_passkey);
            // Set parameters
            $param_passkey = $passkey;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
			{
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1)
				{                    
                    // Bind result variables
                 
                    if(mysqli_stmt_fetch($stmt))
					{
						if($stmt = mysqli_prepare($conn, $sql2))
						{
							 mysqli_stmt_bind_param($stmt, "s", $param_passkey);
<<<<<<< HEAD
							 $param_status = 1;
							 mysqli_stmt_execute($stmt);
						}
                            echo "Your account has been activated!"; 
                            
                            // Redirect user to welcome page  header("location: homepage.php");
							
=======
							 mysqli_stmt_execute($stmt);
							 if($stmt = mysqli_prepare($conn, $sql3))
							 {
								mysqli_stmt_bind_param($stmt, "s", $param_passkey);
								mysqli_stmt_execute($stmt);
							 }
						}
                            echo "Your account has been activated!"; 
>>>>>>> 327d380028e9918d3bc18b430e40dc875ebb6b67
                    }       
                    else
					{
                        // Display an error message if password is not valid
					    echo "passkey doesnt exist";
					}
                } 
				else
				{
                    // Display an error message if username doesn't exist
                    echo "No account found with that passkey.";
                }
            } 
			else
			{
                echo "Oops! Something went wrong. Please try again later.";
            }
		}
            // Close statement
            mysqli_stmt_close($stmt);

?>