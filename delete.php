<?php // BINOME : AHMED EL HAMZAOUI / AURELIEN BARBIER ?>

<?php
session_start();

include "utils.php";

function supprimerAnnonce($annonceId) {
	global $db;
	$query = "SELECT * FROM photo WHERE annonce_id = $annonceId";
	$statement = $db->prepare($query);
	$statement->execute();
	$rows = $statement->fetchAll();
	foreach ($rows as $row) {
		$name = $row["name"];
		unlink("images/$name");
	}
	$query = "DELETE FROM photo WHERE annonce_id = $annonceId";
	$statement = $db->prepare($query);
	$statement->execute();
	$query = "DELETE FROM annonce WHERE id = $annonceId";
	$statement = $db->prepare($query);
	$statement->execute();
}

$userId = $_SESSION["id"];

if (isset($_GET["id"])) {
	$id = $_GET["id"];
	if (!empty($id)) {
		$id = $db->quote($id);
		$query = "SELECT * FROM annonce WHERE id = $id";
		$statement = $db->prepare($query);
		$statement->execute();
		if ($statement->rowCount() > 0) {
			$row = $statement->fetch();
			if ($_SESSION["id"] === $row["user_id"]) {
				supprimerAnnonce($id);
			}
		}
	}
}

header("Location: /mvg/profil.php?id=$userId");
exit();
?>