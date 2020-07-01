<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP05 Fonctions</title>
</head>
<body>
    <?php
    //declarer fonction
    function bonjour($prenom, $nom) //arguments ou paramètres entre les parenthèses
    {
        echo "Bonjour ".$prenom." ".$nom;
    }
    //appel fonction
    
    $prenom = "Dave";
    $nom = "Loper";
    bonjour($prenom, $nom);

    function addition($entier1, $entier2) 
    {
    $resultat = $entier1 + $entier2;
    return $resultat;//même chose si direct: return $entier1 + $entier2; 
    }
    //Pour capter le retour de la fonction, il faut l'affecter à une variable lors de l'appel à la fonction :
    $resultat = addition(1, 2);
    echo $resultat; // affichera 3

    //L'instruction return ne peut renvoyer qu'une variable/valeur à la fois. Lorsqu'on souhaite retourner plusieurs valeurs, on peut "tricher" en renvoyant un tableau contenant les différentes valeurs à renvoyer, par exemple:
    /*function calculPrix($prix_ht, $remise) 
    {              
        $base_ht = $prix_ht - $remise;
        $prix_ttc = $base_ht * 1.20; 
        $retour = array($base_ht, $prix_ttc);

        return $retour; 
    }   

    $retour = calculPrix(110, 10);

    echo"- Base HT : ".$retour["base_ht"]." €<br>"; // affiche 100 €
    echo"- Prix TTC : ".$retour["prix_ttc"]." €<br>"; // affiche 120 € 
    */
    /*LIBRAIRIES DE FONCTIONS : ensemble de fonctions regroupées dans un seul fichier pour y accéder ensuite dans tous nos programmes donc il faut
    1. créer fichier contenant toutes les fonctions, appelé par ex lib.inc.php puis
    2. ajouter ce fichier dans instruction require dans chaq programme où ces fonctions sont utilisées , avec : require('lib.inc.php'); */
    
    //exo - fonction calculator() traitant les opérations d'addition, de soustraction, de multiplication et de division
    function calculator($a, $b, $op){
        static $resultat = 0;//pour utiliser static il faut initialiser la variable avec une constante pas avec un calcul comme $a+$b donc voila
        switch ($op) {   
            case "+" :
                $resultat = $a + $b;
                echo "<p>Résultat:".$resultat."</p>";
                break; 
  
            case "-" :
                $resultat = $a - $b;
                echo "<p>Résultat:".$resultat."</p>";
                break; 
            
            case "*" :
                $resultat = $a * $b;
                echo "<p>Résultat:".$resultat."</p>";
                break; 
        
            case "/" :
                if ($b == 0){
                    echo "<p>Erreur : division par 0</p>";
                }
                else 
                {
                    $resultat = $a / $b;
                    echo "<p>Résultat:".$resultat."</p>";
                }
                break; 
                
            default: 
                echo "Erreur : Opérateur erroné";
        }
        return $resultat; 
    }
    //appel fonction pour tests
    $resultat = calculator(5, 0, "/"); //ca marche- ok


    ?>
</body>
</html>