<?php
// Initialize the session
session_start();
// Check if the user is logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
{
    echo "You're logged in! Welcome " .$_SESSION["username"];
    header("location: contactpageuser.php");
    exit;
}
else
{
	echo "You're not logged in!";
}
// Connection file
require_once "config.php";
// Import PhpMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
// Define mail variable
$mail = new PHPMailer(true);
// Define variables
$firstname = "";
$firstname_err = "";
$email = "";
$email_v = "";
$confirm_email = "";
$email_err = "";
$lastname = "";
$lastname_err = "";
$message = "";
$message_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Validate firstname
    if(empty(trim($_POST["firstname"])))
    {
        $firstname_err = "Please enter your first name.";
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
    else
    {
        $lastname = trim($_POST["lastname"]);
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
            $email = trim($_POST["email"]);   
		}
    }
    // Validate message
    if(empty(trim($_POST["message"])))
    {
        $message_err = "Please enter a message.";
    } 
    elseif(strlen(trim($_POST["message"])) < 25)
    {
        $message_err = "Your message must consist of atleast 25 characters (max 300).";
    }
    elseif(strlen(trim($_POST["message"])) > 300)
    {
        $message_err = "This message has exceeded the maximum character length of 300";
    }
    else
    {
        $message = trim($_POST["message"]);
    }
    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($message_err))
    {
        // Prepare an insert statement
        $sql = "INSERT INTO contact (firstname, lastname, email, message) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql))
        {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_firstname, $param_lastname, $param_email, $param_message);
            // Set parameters
            $param_firstname = $firstname;
			$param_email = $email;
			$param_lastname = $lastname;
            $param_message = $message;
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
					$mail->Password   = '#Slacht99';                               // SMTP password
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
					$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

					// Recipients
					$mail->setFrom('dylan-dylan99@hotmail.com', 'Dylan');
					$mail->addAddress($_POST["email"]);     // Add a recipient        // Name is optional

					// Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'Contact bericht';
					$mail->Body    = "Bedankt voor uw contact bericht. Uw vraag is bij ons binnen gekomen en zal spoedig beantwoord worden. Houd uw email in de gaten! <br><br> Uw bericht: <br>" .$message;
					// Send mail
					$mail->send();
					echo 'Message has been sent';
				} 
                // Catch error
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
        <br>
        <br>
    <div class="wrap">
         <!-- alert -->
         <?php 
			if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false)
			{
				include "assets/includes/alert-not-loggedin.php";
			}
			else
			{
				include "assets/includes/alert-loggedin.php";
			}
		?>
        <h2>Contact formulier</h2>
        <p>Kom in contact met ons. Vul dit formulier in.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                <label>Voornaam</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php echo $firstname_err; ?></span>
            </div>  
            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Achternaam</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastname; ?></span>
            </div>      
			<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                <label>Bericht</label>
                <textarea type="text" name="message" class="form-control" rows="4" value="<?php echo $message; ?>"></textarea>
                <span class="help-block"><?php echo $message_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div> 
<?php include 'assets/includes/footer.php'?>	
</body>
</html>