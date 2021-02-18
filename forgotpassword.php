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
 
// Validate email address
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
                <h3>Wachtwoord vergeten?</h3>
                <p>Hier kunt u uw e-mail adres invullen om een nieuw wachtwoord in te dienen</p>
            </section>
            <section>
                <h5>Wachtwoord reset</h5>
                <p>Vul hier uw e-mail adres in. Wachtwoord toch denken te weten? <a href="mijn-appo.php">Log in!</a></p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
						<label>E-Mail</label>
						<input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
						<span class="help-block"><?php echo $email_err; ?></span>
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