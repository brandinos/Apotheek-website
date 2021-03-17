<?php
include "config.php";
// Initialize the session
session_start();
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
        <link rel="preload" href="assets/css/style.css" as="style" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>Apotheek Schut</title>
    </head>
    <body>
        <?php 
		
				include "assets/includes/navbar.php";
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
                    <div class="services__container">Herhaal service</div>
                    <div class="services__container">Medicijn overzicht</div>
                    <div class="services__container">Inschrijven</div>
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
        <script>
            var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    setTimeout(showSlides, 2000); // Change image every 2 seconds
}
            </script>
        <?php include 'assets/includes/footer.php'?>
    </body>
</html>
