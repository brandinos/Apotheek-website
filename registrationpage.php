<?php
//Connection file
require_once "config.php";

//Import PhpMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
 
//Define variables
$username = "";
$firstname = "";
$firstname_err = "";
$lastname = "";
$lastname_err = "";
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
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    // Validate firstname
    if(empty(trim($_POST["firstname"])))
    {
        $firstname_err = "Please enter your first name.";
    } 
    elseif((preg_match("/^([a-zA-Z' ]+)$/",$firstname)))
    {
        $firstname_err = "A name must consist of only letters and whitespace";
    }
    else
    {
        $firstname = trim($_POST["firstname"]);  
    }

    // Validate lastname
    if(empty(trim($_POST["lastname"])))
    {
        $lastname_err = "Please enter your last name.";
    } 
    elseif((preg_match("/^([a-zA-Z' ]+)$/",$lastname)))
    {
        $lastname_err = "A name must consist of only letters and whitespace";
    }
    else
    {
        $lastname = trim($_POST["lastname"]);  
    }


    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM login WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken.";
                } 
                else
                {
                    $username = trim($_POST["username"]);
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
    //Validate email
	if(empty(trim($_POST["email"])))
	{
		$email_err = "Please enter an E-Mail address";
	}
	else
	{
		$email_v = trim($_POST["email"]);
		if(!filter_var($email_v, FILTER_VALIDATE_EMAIL))
		{
			$email_err = "This E-Mail address is invalid!";
		}
		else
		{
			// Prepare a select statement
        $sql = "SELECT id FROM login WHERE email = ?";
        
        if($stmt = mysqli_prepare($conn, $sql))
		{
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
			{
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1)
				{
                    $email_err = "This E-Mail address is already taken.";
                } 
				else
				{
                    $email = trim($_POST["email"]);
               
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
	//Validate confirm email
	if(empty(trim($_POST["confirm_email"])))
	{
		$confirm_email_err = "Please confirm the E-Mail address";
	}
	else
	{
		if(!filter_var($email_v, FILTER_VALIDATE_EMAIL))
		{
			$confirm_email_err = "This E-Mail address is invalid!";
		}
		else
		{
			$confirm_email = trim($_POST["confirm_email"]);
			if(empty($email_err) && ($email != $confirm_email))
			{
				$confirm_email_err = "E-Mail did not match";
			}
		}
	}
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	
    
    // Check input errors before inserting in database
    if(empty($username_err)&& empty($firstname_err) && empty($lastname_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($confirm_email_err)){
        
		//Create validation hash
		$random_hash = md5(uniqid(rand(), true));
        // Prepare an insert statement
        $sql = "INSERT INTO login (username, voornaam, achternaam, password, email, activation_code) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql))
        {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_firstname, $param_lastname, $param_password, $param_email, $param_random_hash);
            
            // Set parameters
            $param_username = $username;
            $param_firstname = $firstname;
            $param_lastname = $lastname;
			$param_email = $email;
			$param_random_hash = $random_hash;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))
			{
                // Send verification E-Mail
				try 
				{
					//Server settings
					$mail->SMTPDebug = 0;                                   // Enable verbose debug output
					$mail->isSMTP();                                            // Send using SMTP
					$mail->Host       = 'SMTP.office365.com';                    // Set the SMTP server to send through
					$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
					$mail->Username   = 'dylan-dylan99@hotmail.com';                     // SMTP username
					$mail->Password   = '#Slacht99';                               // SMTP password
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
					$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

					//Recipients
					$mail->setFrom('dylan-dylan99@hotmail.com', 'Dylan');
					$mail->addAddress($_POST["email"]);     // Add a recipient        // Name is optional

					// Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'Account verification';
					$mail->Body    = "http://localhost/example/Apotheek-website/verification.php?passkey=$random_hash";
					// Send mail
					$mail->send();
					echo 'Message has been sent';
				} 
				catch (Exception $e) 
				{
					echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
				// Redirect to login page
                header("location: mijn-appo.php");
            } 
			else
			{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
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
    <div class="wrap">
        <h2>Sign Up</h2>
        <p>Please fill in this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                <label>Voornaam</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php echo $firstname_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Achternaam</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastname_err; ?></span>
            </div>      
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
			<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>E-Mail</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>   
			<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Bevestig E-Mail</label>
                <input type="text" name="confirm_email" class="form-control" value="<?php echo $confirm_email; ?>">
                <span class="help-block"><?php echo $confirm_email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Bevestig Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="mijn-appo.php">Login here</a>.</p>
        </form>
    </div> 
<?php include 'assets/includes/footer.php'?>	
</body>
</html>