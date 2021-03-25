<header>
    <div>
        <img src="./assets/img/logo.svg" alt="logo">
    </div>
    <nav>
        <a href="index.php">Home</a>
        <a href="service.php">Service</a>
        <a href="medicijn.php">Medicijn overzicht</a>
        <a href="voorlichting.php">Voorlichting</a>
        <a href="mijn-appo.php">Mijn Appo</a>
        <a href="contactpageguest.php">Contact</a>
    </nav>
    <div>
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
    </div>
</header>
