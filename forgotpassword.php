<?php
// Connection file
require_once "config.php";
// Import PhpMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
// Define mail variable
$mail = new PHPMailer(true);
// Define variables
$username = "";
$email = "";
$email_v = "";
$confirm_email = "";
$password = "";
$confirm_password = "";
$username_err = "";
$email_err = "";
$confirm_email_err = "";
$password_err = "";
$confirm_password_err = "";
$activation_status = "";
$activation_status_err = "";
$current_datetime = "";
// Processing form data when form is submitted 
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Validate email address
    if(empty(trim($_POST["email"])))
    {
		$email_err = "Please enter an E-Mail address";
    }
    else
    {
		$email = trim($_POST["email"]);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$email_err = "This E-Mail address is invalid!";
		}
		else
		{
			// Prepare a select statement
            $sql1 = "SELECT id, email, activation_status FROM login WHERE email = ?";
            if($stmt = mysqli_prepare($conn, $sql1))
		    {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                // Set parameter
                $param_email = $email;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt))
			    {
					// Store result
					mysqli_stmt_store_result($stmt);
					// Check if email address exists, if yes then send email
					if(mysqli_stmt_num_rows($stmt) == 1)
					{                    
						// Bind result variables
						mysqli_stmt_bind_result($stmt, $id, $email_v, $activation_status);
						if(mysqli_stmt_fetch($stmt))
						{
							//Check if the corresponding account is activated
                            if($activation_status == 1)
                            {
                                // Create reset string
                                $random_hash = md5(uniqid(rand(), true));
                                // Set current time
                                $current_datetime = date('Y-m-d H:i:s');
                                $expiration_datetime = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($current_datetime)));
                                // Prepare an insert statement
                                $sql2 = "UPDATE login SET forgot_password_code = ?, forgot_password_time = ? WHERE email = ?";
                                if($stmt = mysqli_prepare($conn, $sql2))
                                {
                                    // Bind variables to the prepared statement as parameters
                                    mysqli_stmt_bind_param($stmt, "sss", $param_random_hash, $param_expiration_datetime, $param_email);
                                    // Set parameters
                                    $param_email = $email_v;
                                    $param_random_hash = password_hash($random_hash, PASSWORD_DEFAULT); // Creates a hash for the reset string
                                    $param_expiration_datetime = $expiration_datetime; 
                                }
                                // Attempt to execute the prepared statement
                                if(mysqli_stmt_execute($stmt))
                                {
                                    // Send verification E-Mail
                                    try 
                                    {
                                        // Server settings
                                        $mail->SMTPDebug = 0;                      // Enable verbose debug output
                                        $mail->isSMTP();                                            // Send using SMTP
                                        $mail->Host       = 'SMTP.office365.com';                    // Set the SMTP server to send through
                                        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                        $mail->Username   = 'dylan-dylan99@hotmail.com';                     // SMTP username
                                        $mail->Password   = '';                               // SMTP password
                                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                                        
                                        // Recipients
                                        $mail->setFrom('dylan-dylan99@hotmail.com', 'Dylan');
                                        $mail->addAddress($email_v);     // Add a recipient        // Name is optional
                                        
                                        // Content
                                        $mail->isHTML(true);                                  // Set email format to HTML
                                        $mail->Subject = 'Reset password';
                                        $mail->Body    = "http://localhost/example/Apotheek-website/resetpassword.php?id=$id&passkey=$random_hash";
                                        // Send mail
                                        $mail->send();
                                        $email_v = "An email has been sent to this email address if an activated account exists for it";
                                    } 
                                    // Catch error
                                    catch (Exception $e) 
                                    {
                                        $email_err = "Mail could not be sent: {$mail->ErrorInfo}";
                                    }
                                }
                                else
                                {
                                    $email = "An email has been sent to this email address if an activated account exists for it";
                                }
                                // Redirect to login page
                                /*
                                header("location: mijn-appo.php");
                                */
                            }
                        }
                        else
                        {
                            $email_err = "An email has been sent to this email address if an activated account exists for it";
                        }
                    }
                    else
                    {
                        $email_err = "An email has been sent to this email address if an activated account exists for it";
                    }     
                }
            // Close statement
            mysqli_stmt_close($stmt);  
            }
        }   
        // Close connection
        mysqli_close($conn);
    }    
}         
?>      
<!DOCTYPE html>
<html lang="nl">
<?php include "assets/includes/head.php" ?>
	<body>
    <?php 
		
        include "assets/includes/navbar.php";
    ?>
	<main class="wrap">
            <section>
                <h3>Wachtwoord vergeten?</h3>
                <p>Hier kunt u uw e-mail adres invullen om een nieuw wachtwoord in te dienen</p>
            </section>
            <section>
                <h5>Wachtwoord reset</h5>
                <p>Vul hier uw e-mail adres in. Wachtwoord toch denken te weten? <a href="mijn-appo.php">Log in!</a></p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
						<label>E-Mail</label>
                        <br>
						<input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
						<span class="help-block"><?php echo $email_err; ?></span>
                        <span class="help-block"><?php echo $email_v; ?></span>
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