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
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "assets/includes/head.php" ?>
    <body>
    <?php include "assets/includes/navbar.php"?>

        <main>
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