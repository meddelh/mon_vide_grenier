<?php // BINOME : AHMED EL HAMZAOUI / AURELIEN BARBIER ?>

<?php
include "utils.php";
?>

<?php require "header.php"; ?>

<form class="research-form" action="/mvg/research.php" method="GET">
	<select name="category">
		<option selected="yes">Mobilier</option>
		<option>Multimédia</option>
		<option>Mode</option>
		<option>Loisirs</option>
		<option>Autres</option>
	</select>
	<input type="text" name="name" placeholder="Que recherchez vous ?"></input>
	<input type="number" name="price_min" placeholder="Prix minimum €">
	<input type="number" name="price_max" placeholder="Prix maximum €">
	<input type="submit" value="Rechercher une annonce">
</form>

<?php
if (isset($_GET["category"])) {
	$category = $db->quote(trim($_GET["category"]));
	$name = $db->quote('%'.trim($_GET["name"]).'%');
	$priceMin = !empty(trim($_GET["price_min"])) && filter_var(trim($_GET["price_min"]), FILTER_VALIDATE_INT) ? trim($_GET["price_min"]) : 0;
	$priceMax = !empty(trim($_GET["price_max"])) && filter_var(trim($_GET["price_max"]), FILTER_VALIDATE_INT) ? trim($_GET["price_max"]) : 100000;
	$query = "SELECT * FROM annonce WHERE category = $category AND name LIKE $name AND (price BETWEEN $priceMin AND $priceMax) ORDER BY upload_date DESC";
	$statement = $db->prepare($query);
	$statement->execute();
	$rowCount = $statement->rowCount();
	echo "<div class='research-info'><h4>Il y'a $rowCount annonce(s) correspondant à votre recherche</h4></div>";
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
}
?>