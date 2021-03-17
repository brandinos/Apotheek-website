<?php
include "config.php";
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
         <section>
             <h3>Medicijn overzicht</h3>
             <p>Zie hier onze medicijnen die wij aan u verkopen.<br><em>Let op: Ze staan in alfabetische volgorde.</em></p>
             <table>
                <tr>
                    <th>Medicijn naam</th>
                    <th>Type medicijn</th>
                </tr>
                <?php
            $sql = "SELECT * FROM medicines ORDER BY MedicineName ASC ";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>'. $row['MedicineName'] .'</td>';
                    echo '<td>'. $row['MedicineDes'] .'</td>';
                    echo '</tr>';
                }
            }
        ?>
            </table>
         <section>
        </main>
        <?php include 'assets/includes/footer.php'?>
    </body>
</html>