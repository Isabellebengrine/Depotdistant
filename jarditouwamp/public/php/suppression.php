<?php
require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
$db = connexionBase(); // Appel de la fonction de connexion
$pro_id = $_GET["pro_id"];
$requete = $db->prepare("DELETE FROM produits WHERE pro_id = :num LIMIT 1");
$requete->bindValue(":num", $pro_id, PDO::PARAM_INT);
$execisOK = $requete->execute();
if (!$requete) //donc si la variable $requete vaut NULL
    {
        $tableauErreurs = $db->errorInfo();
        echo $tableauErreur[2]; 
        die("Erreur dans la requête");
    }
if ($execisOK){
    $msgsuppression = "Produit supprimé";
} else {
    $msgsuppression = "La suppression a échoué";
}
//ENFIN Redirection vers la liste des produits 
header("Location:liste.php");

?>