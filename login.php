<?php // BINOME : AHMED EL HAMZAOUI / AURELIEN BARBIER ?>

<?php
session_start();

include "utils.php";

//REDIRECTION PAGE D'ACCUEIL
if (isset($_SESSION["login"])) {
	header("Location: /mvg/accueil.php");
	exit();
}

if (isset($_POST["login"]) && isset($_POST["pass"])) {
	$login = strtoLower($_POST["login"]);
	$pass = $_POST["pass"];
	if (!empty($login) && !empty($pass)) {
		$login = $db->quote($login);
		$query = "SELECT * FROM user WHERE login = $login OR email = $login";
		$statement = $db->prepare($query);
		$statement->execute();
		if ($statement->rowCount() > 0) {
			$result = $statement->fetch();
			if (password_verify($pass, $result["pass"])) {
				$_SESSION["login"] = $result["login"];
				$_SESSION["id"] = $result["id"];
				header("Location: /mvg/accueil.php");
				exit();
			}
		}
		$message = '<h4>Identifiant ou mot de passe incorrect</h4>';
	} else {
		$message = '<h4>Identifiant ou mot de passe manquant</h4>';
	}
}
?>

<?php require "header.php"; ?> 
	
<form class="login-form" action="/mvg/login.php" method="POST">
	<?php echo $message;?>
	<h2>Connexion</h2>
	<input type="text" name="login" placeholder="Identifiant/E-mail">
	<input type="password" name="pass" placeholder="Mot de passe">
	<input type="submit" value="Se connecter">
	<p>Pas de compte ? <a href="/mvg/register.php" style="text-decoration:none">Inscrivez-vous !</a></p>
</form>