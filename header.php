<?php // BINOME : AHMED EL HAMZAOUI / AURELIEN BARBIER ?>

<?php
session_start();
$login = ucfirst($_SESSION["login"]);
$id = $_SESSION["id"];
echo '<link href="/mvg/style.css" rel="stylesheet" type="text/css">';
?>

<header role="header">
  	<nav class="menu" role="navigation">
  		<div class="menu-left">
  			<a href="/mvg/accueil.php" class="logo">monvidegrenier</h1>
  		</div>
  		<div class="menu-right">
  			<?php
  			if ($login) {
  				echo "<a class=\"menu-pseudo\">$login</a>";
	  			echo "<a href=\"/mvg/profil.php?id=$id\" class=\"menu-link\">Mon profil</a>";
	  			echo '<a href="/mvg/deposit.php" class="menu-link">Déposer une annonce</a>';
	  			echo '<a href="/mvg/logout.php" class="menu-link">Se déconnecter</a>';
  			} else {
  				echo '<a href="/mvg/login.php" class="menu-link">Se connecter</a>';
  			}
  			?>
  		</div>
  	</nav>
</header>