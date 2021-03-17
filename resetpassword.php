<?php
// Connection file
require_once "config.php";
// Define variables 
$password = "";
$password_err = "";
$confirm_password = "";
$confirm_password_err = "";
$activation_status = "";
$hashed_passkey = "";
$current_datetime = "";
$expiration_datetime = "";
// Processing form data when its submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Define variables
    $passkey = $_GET['passkey'];
    $idkey = $_GET['id'];
    // Prepare statements
    $sql1 = "SELECT activation_status, forgot_password_code, forgot_password_time FROM login WHERE id = ?";
    $sql2 = "UPDATE login SET forgot_password_code = NULL, forgot_password_time = NULL, password = ? WHERE id = ?";
    // Validate password
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter a password.";     
    } 
    elseif(strlen(trim($_POST["password"])) < 6)
    {
        $password_err = "Password must have atleast 6 characters.";
    }                           
    else
    {
        $password = trim($_POST["password"]);
    }
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm password.";     
    }   
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = "Password did not match.";
        }
    }
    // Check for errors
    if(empty($password_err) && empty($confirm_password_err))
    {
        if($stmt = mysqli_prepare($conn, $sql1))
	    {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_idkey);
            // Set parameters
            $param_passkey = $passkey;
            $param_idkey = $idkey;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
		    {
                // Store result
                mysqli_stmt_store_result($stmt); 
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    // Bind result variables
				    mysqli_stmt_bind_result($stmt, $activation_status, $hashed_passkey, $expiration_datetime);
				    if(mysqli_stmt_fetch($stmt))
                    {
                        if($activation_status == 1)
                        {
                            if(password_verify($passkey, $hashed_passkey))
                            {
                                if(date('Y-m-d H:i:s') < $expiration_datetime)
                                {
                                    if($stmt = mysqli_prepare($conn, $sql2))
                                    {
                                        mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_idkey);
                                        $param_password = password_hash($password, PASSWORD_DEFAULT);
                                        // Attempt to execute the prepared statement
                                        if(mysqli_stmt_execute($stmt))
			                            {
                                            $confirm_password_err = "Uw wachtwoord is gewijzigd!";
                                        }
                                    }   
                                }
                                else
                                {
                                    $confirm_password_err = "Deze link is verlopen!";
                                }
                            }
                            else
                            {
                                $confirm_password_err = "Deze link is ongeldig!";
                            }
                        }
                        else
                        {
                            $confirm_password_err = "Dit account is nog niet geactiveerd!";
                        }    
                    }
                    else
                    {
                        $confirm_password_err = "foutje fetch";
                    }
                } 
                else
                {
                    $confirm_password_err = "Deze link is ongeldig!";
                }
            }
            else
            {
                $confirm_password_err = "foutje execute";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
        }
    }         
?>
<!DOCTYPE html>
<html lang="nl">
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
	<main class="wrap">
            <section>
                <h3>Verander uw wachtwoord</h3>
                <p>Vul hier uw nieuwe wachtwoord in</p>
            </section>
            <section>
                <h5>Wachtwoord reset</h5>
                <p>Vul hier uw nieuwe wachtwoord in. Wilt u terug naar de inlog pagina? <a href="mijn-appo.php">Log in!</a></p>
                <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="post">
					<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
						<label>Nieuw wachtwoord</label>
						<input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
						<span class="help-block"><?php echo $password_err; ?></span>
					</div> 
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
						<label>Bevestig nieuw wachtwoord</label>
						<input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
						<span class="help-block"><?php echo $confirm_password_err; ?></span>
					</div>     
					<div class="form-group">
						<input type="submit" class="btn btn-primary" value="Verstuur">
					</div>	
                </form> 
                <hr>
            </section>
        </main>
        <?php include 'assets/includes/footer.php'?>
    </body>
</html>