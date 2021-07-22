<?php // BINOME : AHMED EL HAMZAOUI / AURELIEN BARBIER ?>

<?php
session_start();

include "utils.php";

//REDIRECTION PAGE D'ACCUEIL
if (isset($_SESSION["login"])) {
	header("Location: /mvg/accueil.php");
	exit();
}

if (isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["pass"])) {
	$login = strtolower($_POST["login"]);
	$email = strtolower($_POST["email"]);
	$pass = $_POST["pass"];
	if (!empty($login) && !empty($email) && !empty($pass)) {
		if (preg_match('/^[A-Za-z][A-Za-z0-9]{3,24}$/', $login)) {
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$login = $db->quote($login);
				$email = $db->quote($email);
				$query = "SELECT * FROM user WHERE login = $login OR email = $email";
				$statement = $db->prepare($query);
				$statement->execute();
				if ($statement->rowCount() === 0) {
					if (preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,32}$/', $pass)) {
						$id = $db->quote(uniqid());
						$pass = $db->quote(password_hash($_POST["pass"], PASSWORD_DEFAULT));
						$query = "INSERT INTO user (id, login, email, pass) VALUES ($id, $login, $email, $pass)";
						$statement = $db->prepare($query);
						$statement->execute();
						$query = "SELECT * FROM user WHERE login = $login";
						$statement = $db->prepare($query);
						$statement->execute();
						if ($statement->rowCount() > 0) {
							$result = $statement->fetch();
							$_SESSION["login"] = $result["login"];
							$_SESSION["id"] = $result["id"];
							header("Location: /mvg/accueil.php");
							exit();
						} else {
							$message = '<h4>Une erreur s\'est produite</h4>';
						}
					} else {
						$message = '<h4>Mot de passe invalide</h4>';
					}
				} else {
					$message = '<h4>Identifiant ou e-mail déjà utilisé</h4>';
				}
			} else {
				$message = '<h4>E-mail invalide</h4>';
			}
		} else {
			$message = '<h4>Identifiant invalide</h4>';
		}
	} else {
		$message = '<h4>Identifiant, e-mail ou mot de passe manquant</h4>';
	}
}

?>

<?php require "header.php"; ?>

<form class="register-form" action="/mvg/register.php" method="POST">
	<?php echo $message; ?>
	<h2>Inscription</h2>
	<input type="text" name="login" placeholder="Identifiant">
	<input type="text" name="email" placeholder="E-mail">
	<input type="password" name="pass" placeholder="Mot de passe">
	<input type="submit" value="S'inscrire">
	<p>Déjà membre ? <a href="/mvg/login.php" style="text-decoration:none">Connectez-vous !</a></p>
</form>