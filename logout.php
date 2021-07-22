<?php // BINOME : AHMED EL HAMZAOUI / AURELIEN BARBIER ?>

<?php
session_start();

unset($_SESSION["login"]);
unset($_SESSION["id"]);

header("Location: /mvg/accueil.php");
exit();
?>