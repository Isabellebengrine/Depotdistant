<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle du formulaire de modif de produit</title>
</head>
<body>
    <?php         

        require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
        $db = connexionBase(); // Appel de la fonction de connexion à db jarditou

        //D'ABORD Récupération et vérification des informations transmises par le formulaire

        // Tableau contenant les messages d'erreur liés à la validation de chaque champ du formulaire.
        // On utilisera le nom du champ comme cle du tableau
        $erreurs = array();

        //vu sur w3schools pour form validation : pour + de sécurité contre risques d'injection de code javascript dans des champs par personnes malveillantes       
        //create a function that will do all the checking for us
        function test_input($data) {//can only be used when data is of type string
            $data = trim($data);//to Strip unnecessary characters (extra space, tab, newline) from the user input data 
            $data = stripslashes($data);//Remove backslashes (\) from the user input data
            $data = htmlspecialchars($data);//converts special characters to HTML entities, to prevent hacking attempts
            return $data;
        }

        // définir variables et les initialiser avec valeurs vides
        
        $catpdt = ""; $libpdt = ""; $descriptionpdt = ""; $prixpdt = ""; $stockpdt = ""; $couleurpdt = ""; $photopdt = ""; $modifpdt = ""; $blocpdt = "";
        $pro_id = $_GET["pro_id"];
        $pro_ref = $_GET["pro_ref"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {// donc quand form est envoyé
        
            //je fais même vérif pour chaque champ (NB.id est auto-incrémenté donc on n'en a pas besoin)
            if (empty($_POST["refpdt"])) {
                $erreurs["refpdt"] = "La référence doit être renseignée.";
                echo $erreurs["refpdt"]."<br>";
            } else {
                $refpdt = test_input($_POST["refpdt"]);
                if (!preg_match("/^[A-Za-z0-9-_]{1,10}$/",$refpdt)) {//regex pour code ref pdt 
                    $erreurs["refpdt"] = "Vérifiez la saisie de votre référence (caractères autorisés: caractères alphanumériques, - et _, maximum 10 caractères).";
                    echo $erreurs["refpdt"]."<br>";
                }
            }

            if (empty($_POST["catpdt"])) {//teste si champ est vide
                $erreurs["catpdt"] = "La catégorie doit être renseignée.";
                echo $erreurs["catpdt"]."<br>";
            } else {
                $catpdt = test_input($_POST["catpdt"]);//sinon je passe la donnée dans la fonction définie ci-dessus pour + de sécurité
                if ($catpdt>30) {//CONDITION pour que numero de categorie existe car sert de FK dans table produits
                    $erreurs["catpdt"] = "Vérifiez la saisie de la catégorie (ce doit être un nombre entier entre 1 et 30).";
                    echo $erreurs["catpdt"]."<br>";
                }
            }
            
            if (empty($_POST["libpdt"])) {
                $erreurs["libpdt"] = "Le libellé doit être renseigné.";
                echo $erreurs["libpdt"]."<br>";
            } else {
                $libpdt = test_input($_POST["libpdt"]);
                if (!preg_match("/^[A-Za-z0-9-_ 'éèê]{1,200}$/",$libpdt)) {//regex pour libellé pdt ex Bêche GA 410
                    $erreurs["libpdt"] = "Vérifiez la saisie de votre libellé (caractères autorisés: caractères alphanumériques, é, è, ê, espace, apostrophe, - et _, maximum 200 caractères).";
                    echo $erreurs["libpdt"]."<br>";
                }
            }

            //pour description, null est autorisé donc pas de vérif avec empty
            $descriptionpdt = test_input($_POST["descriptionpdt"]);
            if (!preg_match("/^[A-Za-z0-9-_ 'éèêàù,.]{1,200}$/",$descriptionpdt)) {//regex pour description (merci pour exemple 'Là où passe Attila, l'herbe ne repousse pas.' )
                $erreurs["descriptionpdt"] = "Vérifiez la saisie de votre description (maximum 200 caractères).";
                echo $erreurs["descriptionpdt"]."<br>";
            }
            
            //pour prix
            if (empty($_POST["prixpdt"])) {
                $erreurs["prixpdt"] = "Le prix doit être renseigné.";
                echo $erreurs["prixpdt"]."<br>";
            } else {
                $prixpdt = test_input($_POST["prixpdt"]);
                if (!preg_match("/^[0-9]{1,3}\.[0-9]{2}$/",$prixpdt)) {//regex pour nb décimal à 3 chiffres avnt le . et 2 chiffres après
                    $erreurs["prixpdt"] = "Vérifiez la saisie de votre prix (nombre décimal à 3 chiffres maximum avant le . et 2 chiffres max après le .)";
                    echo $erreurs["prixpdt"]."<br>";
                }
            }

            //pour stock
            if (empty($_POST["stockpdt"])) {
                $erreurs["stockpdt"] = "Le stock doit être renseigné.";
                echo $erreurs["stockpdt"]."<br>";
            } else {
                $stockpdt = test_input($_POST["stockpdt"]);
                if (!preg_match("/^[0-9]{1,11}$/",$stockpdt)) {//regex pour tout nombre entre 1 et 11 chiffres pour corresp au type de data de base
                    $erreurs["stockpdt"] = "Vérifiez la saisie du stock.";
                    echo $erreurs["stockpdt"]."<br>";
                }
            }
            
            //pour couleur, null est autorisé donc pas de vérif avec empty
            $couleurpdt = test_input($_POST["couleurpdt"]);
            if (!preg_match("/^[A-Za-z0-9 'éèêà]{1,30}$/",$couleurpdt)) {//regex pour nom couleur
                $erreurs["couleurpdt"] = "Vérifiez la saisie de la couleur (maximum 30 caractères).";
                echo $erreurs["couleurpdt"]."<br>";
            }

            //pour photo, null est autorisé donc pas de vérif avec empty - ici photo est seulement nom extension ex png ou jpg type varchar (4)
            $photopdt = test_input($_POST["photopdt"]);
            if (!preg_match("/^[a-z]{3,4}$/",$photopdt)) {//regex pour extension type png ou jpg
                $erreurs["photopdt"] = "Vérifiez la saisie de l'extension de votre fichier photo (3 ou 4 caractères alphabétiques minuscules).";
                echo $erreurs["photopdt"]."<br>";
            }

            //pour date de modif
            if (empty($_POST["modifpdt"])) {
                $erreurs["modifpdt"] = "La date de modification doit être renseignée.";
                echo $erreurs["modifpdt"]."<br>";
            } else {
                $modifpdt = $_POST["modifpdt"];
                if (!preg_match("/^[0-3][0-9]-[0-9]{2}-[1-2][0-9]{3}$/",$modifpdt)) {//regex pour date format dd-mm-yyyy
                    $erreurs["modifpdt"] = "Vérifiez la saisie de la date de modification (format type dd-mm-yyyy).";
                    echo $erreurs["modifpdt"]."<br>";
                }
            }
            //pour changer format d'une date et que çà passe dans les requêtes sans problème:
            //On récupère ce timestamp à l’aide de la fonction strtotime(), et on le repasse sous un autre format à l’aide de la fonction date() :
            $modifpdt = date('Y-m-d', strtotime($modifpdt));// même format que dans db
            
            // pour produit bloqué (bouton radio oui ou non)
            $blocpdt = $_POST['blocpdt']; 

            if (count($erreurs) == 0) {// donc ya aucune erreur donc on passe à la suite
                //ENSUITE Enregistrement des MODIFICATIONS des données dans la base (pas mis pro_id puisque auto-incrémenté)
                // Requête UPDATE dans la table produits
                    
            // si $pro_ref a changé on peut l'inclure dans update
            if ($pro_ref != $_POST["refpdt"]){
                
                $requete = $db->prepare("UPDATE produits SET pro_ref = :refpdt, pro_cat_id = :catpdt, pro_libelle = :libpdt, pro_description = :descriptionpdt, pro_prix = :prixpdt, pro_stock = :stockpdt, pro_couleur = :couleurpdt, pro_photo = :photopdt, pro_bloque = :blocpdt, pro_d_modif = :modifpdt
                WHERE pro_id =".$pro_id.";");
                $requete->bindValue(":refpdt", $refpdt); //La constante de type par défaut est STR donc je ne précise que pour les autres (dates aussi considérées comme str)
                $requete->bindValue(":catpdt", $catpdt, PDO::PARAM_INT);
                $requete->bindValue(":libpdt", $libpdt);
                $requete->bindValue(":descriptionpdt", $descriptionpdt);
                $requete->bindValue(":prixpdt", $prixpdt, PDO::PARAM_INT);
                $requete->bindValue(":stockpdt", $stockpdt, PDO::PARAM_INT);
                $requete->bindValue(":couleurpdt", $couleurpdt);
                $requete->bindValue(":photopdt", $photopdt);
                $requete->bindValue(":modifpdt", $modifpdt);
                $requete->bindValue(":blocpdt", $blocpdt, PDO::PARAM_INT);
                $requete->execute();
                

            } else {//donc si pro_ref n'a pas changé, je l'enlève du update pour pas bloquer requete
            
                    $requete = $db->prepare("UPDATE produits SET pro_cat_id = :catpdt, pro_libelle = :libpdt, pro_description = :descriptionpdt, pro_prix = :prixpdt, pro_stock = :stockpdt, pro_couleur = :couleurpdt, pro_photo = :photopdt, pro_bloque = :blocpdt, pro_d_modif = :modifpdt
                    WHERE pro_id =".$pro_id.";");
                    $requete->bindValue(":catpdt", $catpdt, PDO::PARAM_INT);
                    $requete->bindValue(":libpdt", $libpdt);
                    $requete->bindValue(":descriptionpdt", $descriptionpdt);
                    $requete->bindValue(":prixpdt", $prixpdt, PDO::PARAM_INT);
                    $requete->bindValue(":stockpdt", $stockpdt, PDO::PARAM_INT);
                    $requete->bindValue(":couleurpdt", $couleurpdt);
                    $requete->bindValue(":photopdt", $photopdt);
                    $requete->bindValue(":modifpdt", $modifpdt);
                    $requete->bindValue(":blocpdt", $blocpdt, PDO::PARAM_INT);
                    $requete->execute();
            }
 
            //ENFIN Redirection vers la liste des produits 
            header("Location:liste.php");
          
            } //fin du if pas d'erreurs

        }//fin du tout premier if

    ?>
</body>
</html>



                