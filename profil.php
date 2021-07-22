<?php // BINOME : AHMED EL HAMZAOUI / AURELIEN BARBIER ?>

<?php
session_start();

include "utils.php";

if (isset($_GET["id"])) {
	$userId = $_GET["id"];
	if (!empty($userId)) {
		$userId = $db->quote($userId);
		$query = "SELECT * FROM user WHERE id = $userId";
		$statement = $db->prepare($query);
		$statement->execute();
		if ($statement->rowCount() > 0) {
			$result = $statement->fetch();
			$username = ucfirst($result["login"]);
			$userId = $result["id"];
			$email = $result["email"];
		}
	}
} else {
	header("Location: /mvg/accueil.php");
	exit();
}
?>

<?php require "header.php"; ?>

<div class="user-div">
	<div class="user-div-left">
		<img class="user-img" src="images/user.png" height="100">
	</div>
	<div class="user-div-right">
		<?php
		echo "<a href='/mvg/profil.php?id=$userId'><h2>$username</h2></a>";
		echo "<h4>$email</h4>";
		?>
	</div>
</div>

<?php
	$query = "SELECT * FROM annonce WHERE user_id = '$userId' ORDER BY upload_date DESC";
	$statement = $db->prepare($query);
	$statement->execute();
	$rowCount = $statement->rowCount();
	echo "<div class='research-info'><h4>L'utilisateur a $rowCount annonce(s) en ligne</h4></div>";
	if ($rowCount > 0) {
		$rows = $statement->fetchAll();
		foreach ($rows as $row) {
			echo '<div class="user-annonce">';
			$annonce_id = $row["id"];
			$name = $row["name"];
			$price = $row["price"];
			$date = $row["upload_date"];
			$query = "SELECT * FROM photo WHERE annonce_id = '$annonce_id'";
			$statement = $db->prepare($query);
			$statement->execute();
			if ($statement->rowCount() > 0) {
				$image = $statement->fetch();
				$fileDir = 'images/'.$image["name"];
				echo "<a href='/mvg/produit.php?id=$annonce_id'><img src='$fileDir' height=200 width=200></a>";
			} else {
				echo "<a href='/mvg/produit.php?id=$annonce_id'><img src='images/nopic.png' height=200 width=200></a>";
			}
			echo '<div class="user-annonce-middle">';
			echo "<h2><a href='/mvg/produit.php?id=$annonce_id'>$name</a></h2>";
			echo "<h3>$price €</h3>";
			echo "<h4>$date</h4>";
			echo '</div>';
			if ($_SESSION["id"] === $userId) {
				echo '<div class="user-annonce-right">';
				echo "<a href='/mvg/delete.php?id=$annonce_id'><img src='images/delete.png' class='trash' height=50></a>";
				echo '</div>';
			}
			echo '</div>';
		}
	}
?>