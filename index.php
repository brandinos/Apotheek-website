<?php
include "config.php";
// Initialize the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php include "assets/includes/head.php" ?>
    <body>
        <?php 
		
				include "assets/includes/navbar.php";
		?>
        <main>
            <section>
                <?php include "assets/includes/header.php"; ?>
           </section>
            <section>
                
                <h1>Onze Service</h1>
                <p>
                    Zoek dan niet verder! Laat uw zelf
                    verbazen door de ervaring en professionaliteit van de heer
                    Schut! <br />Wij staan u te woord doormiddel van een team
                    hoogopgeleide specialisten die precies weten hoe zij u
                    moeten helpen door hun jaren lange ervaring. Wij zijn dan ook
                    <b>Gecertificeerd</b> als beste in de consumentenbond!
                    <br />Bij onze apotheek vindt u het beste:
                </p>
                <div class="services">
                    <a href="mijn-appo.php">
                    <div class="services__container services__container--service">Herhaal service</div>
                    </a>
                    <a href="medicijn.php">
                    <div class="services__container services__container--overzicht">Medicijn overzicht</div>
                    </a>
                    <a href="registrationpage.php">
                    <div class="services__container services__container--inschrijven">Inschrijven</div>
                    </a>
                </div>
            </section>
            <section class="news" id="news">
                <h2>Het laaste nieuws</h2>
                <p>
                    Volg ons laatste nieuws, rechtstreeks uit onze database.
                </p>
                <table>
                <tr>
                   <th>Nieuws</th>
                    <th>Link</th>
                </tr>
             <?php
           $sql = "SELECT NewsName,NewsDes FROM news";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>'. $row['NewsName'] .'</td>';
                    echo '<td>'. $row['NewsDes'] .'</td>';
                    echo '</tr>';
                }
            }
        ?>
        </table>
            </section>
            <section>
                <h3>Informatie</h3>
                <p>Zie hier wanneer wij geopend zijn.</p>
                <div class="openinfo">
                    <div class="openinfo__left">
                        <h5>Openingstijden</h5>
                        <ul>
                            <li>Maandag 9:00 - 17:00</li>
                            <li>Dinsdag 9:00 - 17:00</li>
                            <li>Woensdag 9:00 - 17:00</li>
                            <li>Vrijdag 9:00 - 15:00</li>
                        </ul>
                    </div>
                    <div class="openinfo__right">
                        <h5>Adres</h5>
                        <ul>
                            <li>Koekjes straat, 4</li>
                            <li>1243 Te Schagen</li>
                        </ul>
                    </div>
                </div>
            </section>
        </main>
        <?php include 'assets/includes/footer.php'?>
    </body>
</html>
