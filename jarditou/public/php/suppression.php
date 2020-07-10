<?php
require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
$db = connexionBase(); // Appel de la fonction de connexion
$pro_id = $_GET["pro_id"];
$requete = $db->prepare("DELETE station (sta_nom, sta_altitude) VALUES (:nom, :altitude)");
$requete->bindValue(":altitude", $altitude);
$requete->execute();
?>