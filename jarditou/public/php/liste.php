<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"><!--règle un bug spécifique du navigateur
        Apple Safari mobile sous le système d'exploitation iOS 9 (iPhone/iPad).-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><!--pour importer Bootstrap via une URL pointant sur un CDN (un serveur externe hébergeant des fichiers)-->
	<title>PHP N°4 - Liste des produits Jarditou</title>
	<link rel="stylesheet" type="text/css" href="public/css/jarditoustyle.css">
	<link rel="stylesheet" media="screen and (max-width: 768px)" href="public/css/Jstyleresponsive.css">
</head>
<body> 
    <div class="container-fluid m-0 p-0" > 
        <h1 class="text-center">Liste des produits</h1>
		<div class="col-12 m-0 p-0">

<?php
require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
$db = connexionBase(); // Appel de la fonction de connexion

// définir variables et les initialiser avec valeurs vides
$refpdt = $libpdt = $descriptionpdt = $prixpdt = $stockpdt = $couleurpdt = $photopdt = $ajoutpdt = $modifpdt = $blocpdt = $idpdt = "";

//req préparée pour plus de sécurité

// $requete = $db->prepare("SELECT pro_photo, pro_id, pro_ref, pro_libelle, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif FROM produits WHERE ISNULL(pro_bloque) 
// AND pro_photo = ? AND pro_id = ? AND pro_ref = ? AND pro_libelle = ? AND pro_prix = ? AND pro_stock = ? AND pro_couleur = ? AND pro_d_ajout = ? AND pro_d_modif = ?
// ORDER BY pro_d_ajout DESC");
// //lier les valeurs aux variables
// $requete->bindValue(1, $photopdt);
// $requete->bindValue(2, $idpdt, PDO::PARAM_INT);
// $requete->bindValue(3, $refpdt);//La constante de type par défaut est STR donc je ne précise que pour les autres (les dates sont considérées comme str)
// $requete->bindValue(4, $libpdt);
// $requete->bindValue(5, $prixpdt, PDO::PARAM_INT);
// $requete->bindValue(6, $stockpdt, PDO::PARAM_INT);
// $requete->bindValue(7, $couleurpdt);
// $requete->bindValue(8, $ajoutpdt);
// $requete->bindValue(9, $modifpdt);
// $requete->execute();



$requete = $db->prepare("SELECT pro_photo, pro_id, pro_ref, pro_libelle, pro_prix, pro_stock, pro_couleur, pro_d_ajout, pro_d_modif FROM produits WHERE ISNULL(pro_bloque) 
ORDER BY pro_d_ajout DESC");
//lier les valeurs aux variables

$requete->execute();






//$result = $db->query($requete);//on stocke le résultat de la requête, qui est un tableau d'objets, dans la variable $result

$tableau = $requete->fetchAll(PDO::FETCH_OBJ);

//var_dump ($tableau);


if (!$requete) //donc si la variable $result vaut NULL
{
    $tableauErreurs = $db->errorInfo();
    echo $tableauErreur[2]; 
    die("Erreur dans la requête");
}

if ($requete->rowCount() == 0) 
{
   // Pas d'enregistrement
   die("La table est vide");
}

echo '<table  class="table table-striped table-bordered">';//on ouvre un tableau HTML car les résultats - les informations sur les produits de notre liste - vont être affichés sous cette forme
/* tant qu'un enregistrement est présent dans la variable $result, on va afficher des informations. La présence d'un enregistrement est vérifiée grâce à la fonction fetch(PDO::FETCH_OBJ) qui lit le premier enregistrement trouvé par la requête SQL, puis le supprime puis lit le suivant et ainsi de suite... Quand il n'y a plus d'enregistrement disponible, elle renvoie la valeur 0, ce qui provoque l'arrêt de la boucle. Il est possible de remplacer l'instruction while par foreach */
echo "<thead><tr><th>Photo</th><th>ID</th><th>Référence</th><th>Libellé</th><th>Prix</th><th>Stock</th><th>Couleur</th><th>Ajout</th><th>Modif</th><th>Bloqué</th></tr></thead><tbody>";//affiche les cellules th soit entêtes de colonnes donc noms des champs




foreach ($tableau as $row)
{
    echo"<tr>";// le reste de la boucle ne concerne que l'affichage formaté en HTML (ici des lignes et cellules de tableau donc) des informations des produits : pour chaque enregistrement, nous construisons une ligne de tableau contenant une colonne par cellule.
    $image = $row->pro_id.".".$row->pro_photo;  //echo $image; //test ok
    echo '<td><img src="/jarditou/public/images/'.$image.'" width="80" alt="Image du produit"></td>';//chemin absolu 
    echo"<td>".$row->pro_id."</td>";
    echo"<td>".$row->pro_ref."</td>";
    //echo "<td><a href=\"detail.php?id=".$row->pro_id."\" title=\"".$row->pro_libelle."\"></a></td>"; //lien d'origine ne marche pas
    echo '<td><a href="detail.php?pro_id='.$row->pro_id.'" style="color:black" title="Cliquez pour afficher les détails de ce produit">'.$row->pro_libelle.'</a></td>';
    echo"<td>".$row->pro_prix."</td>";
    echo"<td>".$row->pro_stock."</td>";
    echo"<td>".$row->pro_couleur."</td>";
    echo"<td>".$row->pro_d_ajout."</td>";
    echo"<td>".$row->pro_d_modif."</td>";
    //echo"<td>".$row->pro_bloque."</td>";
    echo"</tr>";
}
//
echo "</table>"; 

?>
    <input type="button" class="btn btn-dark" value="Ajouter un nouveau produit" id="btnAjout" onclick="window.location.href='/jarditou/formulaireajout.html'">
        </div> 	
    </div>   
    <!--pour intégrer fichiers Javascript nécessaires à Bootstrap; placez ce code avant la fermeture de la balise body, l'ordre des fichiers est à respecter (Jquery, Popper puis Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html> 