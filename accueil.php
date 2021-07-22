<?php // BINOME : AHMED EL HAMZAOUI / AURELIEN BARBIER ?>

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