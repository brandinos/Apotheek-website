<?php
// Initialize the session
session_start();
 
// Check if the user is logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
{
    echo "You're logged in! Welcome " .$_SESSION["username"];
}
else
{
	echo "You're not logged in!";
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
			include "assets/includes/header.php";
		?>

        <main class="wrap">
         <section>
             <h3>Medicijn overzicht</h3>
             <table style="width: 100%">
                    <tr>
                        <th>Medicijn naam</th>
                        <th>Verkrijgbaar?</th>
                    </tr>
                    <tr>
                        <td>
                           Asperine
                        </td>
                        <td>
                           ja
                        </td>
                    </tr>
                    <tr>
                    <td>
                           Paraceta mol
                        </td>
                        <td>
                           ja
                        </td>
                    </tr>
                    <tr>
                    <td>
                           Morfine
                        </td>
                        <td>
                           Nee
                        </td>
                    </tr>
                </table>
         <section>
        </main>
        <?php include 'assets/includes/footer.php'?>
    </body>
</html>
