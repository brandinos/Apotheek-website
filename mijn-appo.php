<?php
// Start session
session_start();
// Check if already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
{
    header("location: index.php");
    exit;
}
// Connection file for the database
require_once "config.php";
// Define variables
$username = "";
$username_s = "";
$password = "";
$username_err = "";
$password_err = "";
$email = "";
$email_err = "";
$activation_code = "";
$activation_code_err = "";
$activation_status = "";
$activation_status_err = ""; 
// Processing form data when pressing the login button
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Check if username field is empty
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter username.";
    } 
    else
    {
        $username = trim($_POST["username"]);
    }
    // Check if password field is empty
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter your password.";
    } 
    else
    {
        $password = trim($_POST["password"]);
    }
    $username_s = $username;
    //Check for errors
    if(empty($username_err) && empty($password_err))
	{
        // Prepare a select statement
        $sql1 = "SELECT id, username, password, email, activation_code, activation_status FROM login WHERE username = ?";
        if($stmt = mysqli_prepare($conn, $sql1))
		{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            // Set parameter
            $param_username = $username;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
			{
					// Store result
					mysqli_stmt_store_result($stmt);
					// Check if username exists, if yes then verify password
					if(mysqli_stmt_num_rows($stmt) == 1)
					{                    
						// Bind result variables
						mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $email, $activation_code, $activation_status);
						if(mysqli_stmt_fetch($stmt))
						{
							//Check if the corresponding account is activated
							if($activation_status == 1)
							{
								if(password_verify($password, $hashed_password))
								{
									// Password is correct, so start a new session
									session_start();
									// Store data in session variables
									$_SESSION["loggedin"] = true;
									$_SESSION["id"] = $id;
									$_SESSION["username"] = $username;                            
									// Redirect user to welcome page
									header("location: index.php");
								} 
								else
								{
									// Display an error message if password is not valid
									$password_err = "The password you entered was not valid.";
							    }
							}
							else 
							{
                                // Display an errir message if the account hasn't been activated
								$username_err = "This account hasn't been activated yet!";
						    } 
						}
						else
						{
                        // Display an error message if username doesn't exist
                        $username_err = "No account found with that username.";
                        }
				    }
                } 
                else
                {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            // Close statement
            mysqli_stmt_close($stmt);
        }
	}
}
    // Close connection
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            rel="preload"
            href="https://necolas.github.io/normalize.css/8.0.1/normalize.css"
            as="style"
        />
        <link
            rel="stylesheet"
            href="https://necolas.github.io/normalize.css/8.0.1/normalize.css"
        />
        <link rel="preload" href="./assets/css/style.css" as="style" />
        <link rel="stylesheet" href="./assets/css/style.css" />
        <title>Apotheek Schut</title>
    </head>
    <body>
        <?php 
			if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false)
			{
				include "assets/includes/navbar.php";
			}
			else
			{
				include "assets/includes/navbar1.php";
			}
		?>

        <main class="wrap">
            <section>
                <h3>Mijn appo</h3>
                <p>Wij hebben een persoonlijke omgeving voor klanten waar zij op kunnen inloggen. Zo kunt u zelf uw zaken regelen!</p>
            </section>
            <section>
                <h5>Inloggen</h5>
                <p>Log in up uw personlijke omgeving. Geen account? <a href="registrationpage.php">Registreer uw zelf</a></p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
						<label for="gebruiker">Gebruikers naam:</label><br>
						<input type="text" name="username" class="form-control" id="gebruiker" value="<?php echo $username; ?>" placeholder="Uw gebruikers naam"><br>
						<span class="help-block"><?php echo $username_err; ?></span>
					</div>
					<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
						<label for="password">Wachtwoord:</label><br>
						<input type="password" name="password" class="form-control" id="password" value="" placeholder="Uw wachtwoord" ><br>
						<span class="help-block"><?php echo $password_err; ?></span>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Login">
					</div>
					
                </form> 
                <hr>
                <a href="forgotpassword.php">Wachtwoord vergeten?</a>
            </section>
        </main>
        <?php include 'assets/includes/footer.php'?>
    </body>
</html>
