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
   <?php include "assets/includes/head.php" ?>
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
           <h3>Diensten</h3>
           <p>De teams van Apotheek Schut staan graag klaar voor u. In onze dienstverlening staat u dan ook 
               centraal. We willen graag zekerheid en veel gemak beiden. Bij Apotheek Schut hebben wij daarom diverse 
               (online) services waarvan u gebruik kunt maken. Een paar voorbeelden zijn:
                <ul>
                    <li>Diabetes service.</li>
                    <li>Herhaal service</li>
                    <li>Uw medicijnen staan altijd klaar</li>
                    <li>Verschilende instructies over mediijn gebruik</li>
                    <li>Webshop</li>
                </ul>
                <br>
            De online diensten van uw apotheek. Ga naar Diensten bij uw apotheek en kijk hoe wij u 
            online kunnen helpen. Volg de instructies en schrijf u in.
           </p>
        </main>
        <?php include 'assets/includes/footer.php'?>
    </body>
</html>
