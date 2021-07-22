<?php // BINOME : AHMED EL HAMZAOUI / AURELIEN BARBIER ?>

<?php
session_start();

include "utils.php";

if (isset($_GET["id"])) {
	$annonceId = $_GET["id"];
	if (!empty($annonceId)) {
		$annonceId = $db->quote($annonceId);
		$query = "SELECT * FROM annonce WHERE id = $annonceId";
		$statement = $db->prepare($query);
		$statement->execute();
		if ($statement->rowCount() > 0) {
			$row = $statement->fetch();
			$userId = $row["user_id"];
			$query = "SELECT * FROM user where id = '$userId'";
			$statement = $db->prepare($query);
			$statement->execute();
			if ($statement->rowCount() > 0) {
				$row = $statement->fetch();
				$username = ucfirst($row["login"]);
				$email = $row["email"];
			}
		}
	}
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
	$query = "SELECT * FROM annonce WHERE id = $annonceId";
	$statement = $db->prepare($query);
	$statement->execute();
	if ($statement->rowCount() > 0) {
		$result = $statement->fetch();
		echo '<div class="images-annonce">';
		$query = "SELECT * FROM photo WHERE annonce_id = $annonceId";
		$statement = $db->prepare($query);
		$statement->execute();
		if ($statement->rowCount() > 0 ) {
			$rows = $statement->fetchAll();
			foreach ($rows as $row) {
				$fileDir = 'images/'.$row["name"];
				echo "<img src='$fileDir' class='image-produit' height=200 width=200>";
			}
		} else {
			echo "<img src='images/nopic.png' class='image-produit' height=200 width=200>";
		}
		echo '</div>';
		$name = $result["name"];
		$price = $result["price"];
		$description = $result["description"];
		echo '<div class="info-annonce">';
		echo "<h2>$name</h2>";
		echo "<h3>$price €</h3>";
		echo "<h4>Description : $description</h4>";
		echo '</div>';
	}
?>