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
    <p>patatjes</p>
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
                <h1>Onze Service</h1>
                <figure>
                    <img
                        src="./assets/img/pharmasict-serving-customer-drug-store.jpg"
                    />
                    <figcaption>
                        One mensen staan voor u klaar, zefs tijdens corona tijden!
                    </figcaption>
                </figure>
                <p>
                    Zoek dan niet veder! Wees verbaasd over onze
                    proffessionaliteit, en onze klanten service! Laat uw zelf
                    verbazen door de ervaring en professionaliteit van de heer
                    schut! <br />Wij staan u te woord doormidel van een team
                    hoogopgeleide specialisten die precies weten hoe zij u
                    moeten helpen door hun jare lang ervaring. Wij zijn dan ook
                    <b>gecertificeerd</b> als beste in de consumentenbond!
                    <br />Bij onze appotheek geniet u van de beste:
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
                    Volg onze laatste niews, recht uit de databae. (ik heb hier
                    nog code van vorig jaar die we kunnen gebruiken)
                </p>
                <table style="width: 100%">
                    <tr>
                        <th>Het laatste nieuws:</th>
                    </tr>
                    <tr>
                        <td>
                            <a href="#"
                                >Volgens de consumenten bond wijn zij de beste
                                in vernieuing &RightArrow;</a
                            >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#"
                                >Onze apotheek website is vernieuwd!
                                &RightArrow;</a
                            >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#"
                                >Apotheek Schut opent de deuren. &RightArrow;</a
                            >
                        </td>
                    </tr>
                </table>
            </section>
            <section>
                <h3>Informatie</h3>
                <p>Vindt uit waneer wij geopend zijn.</p>
                <div class="openinfo">
                    <div class="openinfo__left">
                        <h5>Openings tijden</h5>
                        <ul>
                            <li>Maandag 9:00 - 17:00</li>
                            <li>Dinsdag 9:00 - 17:00</li>
                            <li>Woensdag 9:00 - 17:00</li>
                            <li>Vrijdag 9:00 - 15:00</li>
                        </ul>
                    </div>
                    <div class="openinfo__right">
                        <h5>Adress</h5>
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
