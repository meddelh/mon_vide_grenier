<?php // BINOME : AHMED EL HAMZAOUI / AURELIEN BARBIER ?>

<?php
session_start();

include "utils.php";

if (!isset($_SESSION["login"])) {
	header("Location: /mvg/login.php");
	exit();
}

if (isset($_POST["category"]) && isset($_POST["name"]) && isset($_POST["price"]) && isset($_POST["description"])) {
	$category = trim($_POST["category"]);
	$name = trim($_POST["name"]);
	$price = trim($_POST["price"]);
	$description = trim($_POST["description"]);
	if (!empty($category) && !empty($name) && !empty($price) && !empty($description)) {
		$categories = array("Mobilier","Multimédia","Mode","Loisirs","Autres");
		if (in_array($category, $categories)) {
			if (strlen($name) > 0 && strlen($name) <= 160) {
				if (filter_var($price, FILTER_VALIDATE_INT)) {
					if (strlen($description) <= 2048) {
						$files = reArrayFiles($_FILES["images"]);
						$files_count = count($files);
						if ($files_count <= 3) {
							$userId = $db->quote($_SESSION["id"]);
							$query = "SELECT * FROM user WHERE id = $userId";
							$statement = $db->prepare($query);
							$statement->execute();
							if ($statement->rowCount() > 0) {
								$result = $statement->fetch();
								$id = uniqid();
								$userId = $db->quote($result["id"]);
								$category = $db->quote($category);
								$name = $db->quote($name);
								$description = $db->quote($description);
								$date = $db->quote(date("Y-m-d H:i:s"));
								$query = "INSERT INTO annonce (id, user_id, category, name, price, description, upload_date) VALUES ('$id', $userId, $category, $name, $price, $description, $date)";
								$statement = $db->prepare($query);
								$statement->execute();
								if ($statement->rowCount() > 0) {
									for ($i=0; $i<$files_count; $i++) {
										$fileName = $files[$i]["name"];
										$fileTmpName = $files[$i]["tmp_name"];
										$fileSize= $files[$i]["size"];
										$fileError = $files[$i]["error"];
										$fileSplit = explode(".", $fileName);
										$fileExt = strtolower(end($fileSplit));
										$allowedExt = array("jpg", "jpeg", "png");
										if ($fileError === 0) {
											if (in_array($fileExt, $allowedExt)) {
												if($fileSize < 5120000) {
													$fileNewName = uniqid("", true).".".$fileExt;
													$fileDestination = "images/".$fileNewName;
													move_uploaded_file($fileTmpName, $fileDestination);
													$query = "INSERT INTO photo (name, annonce_id) VALUES ('$fileNewName', '$id')";
													$statement = $db->prepare($query);
													$statement->execute();
												}
											}
										}
									}
									header("Location: /mvg/produit.php?id=$id");
									exit();
								}
							}
						} else {
							$message = '<h4>Vous ne pouvez ajouter qu\'au maximum trois images</h4>';
						}
					} else {
						$message = '<h4>La description de l\'objet est invalide</h4>';
					}
				} else {
					$message = '<h4>Le prix de l\'objet est invalide</h4>';
				}
			} else {
				$message = '<h4>Le nom de l\'objet est invalide</h4>';
			}
		} else {
			$message = '<h4>La catégorie est invalide</h4>';
		}
	} else {
		$message = '<h4>Nom, prix ou description manquant.</h4>';
	}
}

function reArrayFiles($file_post) {
	$file_arr = array();
	$file_count = count($file_post["name"]);
	$file_keys = array_keys($file_post);
	for ($i=0; $i<$file_count; $i++) {
		foreach ($file_keys as $key) {
			$file_arr[$i][$key] = $file_post[$key][$i];
		}
	}
	return $file_arr;
}

function pre_r($array) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}
?>

<?php require "header.php"; ?> 

<form class="deposit-form" action="/mvg/deposit.php" method="POST" enctype="multipart/form-data">
	<?php echo $message;?>
	<h2>Créez votre annonce</h2>
	<select name="category">
		<option selected="yes">Mobilier</option>
		<option>Multimédia</option>
		<option>Mode</option>
		<option>Loisirs</option>
		<option>Autres</option>
	</select>
	<input type="text" name="name" placeholder="Nom de l'objet"></input>
	<input type="number" name="price" placeholder="Prix souhaité €">
	<textarea cols="40" rows="5" wrap="hard" name="description" placeholder="Description de l'objet"></textarea>
	<input type="file" name="images[]" accept=".jpg, .jpeg, .png" multiple="multiple">
	<input type="submit" value="Déposer mon annonce">
</form>
