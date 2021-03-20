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
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "assets/includes/head.php" ?>
    <body>
    <?php include "assets/includes/navbar.php"?>

        <main>
            <section>
                <h3>Gezondsheidsinformatie</h3>
                <p>In samenwerking met thuisarts.nl beiden wij u gezondsheid informatie. Wilt u 
                    meer weten over een aandoening, zoekt u dan op naam in de onderstaande zoeklijst.
                </p>
                <table style="width: 100%">
                    <tr>
                        <th>Aandoening naam</th>
                        <th>Dodelijk?</th>
                    </tr>
                    <tr>
                        <td>
                           Diabetes
                        </td>
                        <td>
                           ja
                        </td>
                    </tr>
                    <tr>
                    <td>
                           Hoofdpijn
                        </td>
                        <td>
                           ja
                        </td>
                    </tr>
                    <tr>
                    <td>
                           Depressie
                        </td>
                        <td>
                           Nee
                        </td>
                    </tr>
                </table>
            </section>
        </main>
        <?php include 'assets/includes/footer.php'?>
    </body>
</html>
