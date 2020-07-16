<?php

//ex 1 - création d'une bibliothèque de connexion:
function connexionBase()
{
   // Paramètre de connexion serveur
   $host = "localhost";
   $login= "root";  // Votre login d'accès au serveur de BDD 
   $password="";    // Le Password pour vous identifier auprès du serveur
   $base = "jarditou";  // La bdd avec laquelle vous voulez travailler 

   try 
   {
        $db = new PDO('mysql:host=' .$host. ';charset=utf8;dbname=' .$base, $login, $password);
        return $db;//envoie ensuite l'identifiant de connexion à la base personnelle directement à la page qui a demandé la connexion
    } 
    catch (Exception $e) //intercepte erreur si yena une
    {
        echo 'Erreur : ' . $e->getMessage() . '<br>';
        echo 'N° : ' . $e->getCode() . '<br>';
        die('Connexion au serveur impossible.');//arret de l'exec du script si erreur
    } 
}
?>