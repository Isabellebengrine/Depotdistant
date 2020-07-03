<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle du formulaire Jarditou</title>
</head>
<body>
    <?php
        // Tableau contenant les messages d'erreur liés à la validation de chaque champ du formulaire.
        // On utilisera le nom du champ comme cle du tableau
        $erreurs = array();

       if ($_SERVER["REQUEST_METHOD"] == "POST") {//quand form est envoyé

        //vu sur w3schools pour form validation : pour + de sécurité contre risques d'injection de code javascript dans des champs par personnes malveillantes       
        //create a function that will do all the checking for us
            function test_input($data) {//can only be used when data is de type string
                $data = trim($data);//to Strip unnecessary characters (extra space, tab, newline) from the user input data 
                $data = stripslashes($data);//Remove backslashes (\) from the user input data
                $data = htmlspecialchars($data);//converts special characters to HTML entities, to prevent hacking attempts
                return $data;
            }

            // définir variables et les initialiser avec valeurs vides
            $fname = $lname = $sexe = $dn = $cp = $adresse = $ville = $vq = $ok = $sujet = "";
            // A ENLEVER ?? $fnameErr = $emailErr = $lnameErr = $dnErr = $cpErr = $vqErr = "";//error variables will hold error messages for the required fields
                
            //je fais même vérif pour chaque champ requis - ici pour nom
            if (empty($_POST["lname"])) {//teste si champ est vide
                $erreurs["lname"] = "Le nom doit être renseigné";
                echo $erreurs["lname"]."<br>";
            } else {
                $lname = test_input($_POST["lname"]);//sinon je passe la donnée dans la fonction définie ci-dessus pour + de sécurité
                if (!preg_match("/^[A-Z][a-zA-Z '&-]*[A-Za-z]$/",$lname)) {//regex pour tout ce qui commence par une lettre majuscule, suivi de zéro ou plus de toute lettre, espace, trait d'union, esperluette ou apostrophe et se terminant par une lettre
                    $erreurs["lname"] = "Vérifiez votre saisie (seules lettres, espace, trait d'union, esperluette(&) et apostrophe sont autorisés)";
                    echo $erreurs["lname"]."<br>";
                }
            }
            
            if (empty($_POST["fname"])) {
                $erreurs["fname"] = "Le prénom doit être renseigné";
                echo $erreurs["fname"]."<br>";
            } else {
                $fname = test_input($_POST["fname"]);
                if (!preg_match("/^[A-Z][a-zA-Z '&-]*[A-Za-z]$/",$fname)) {//regex pour tout ce qui commence par une lettre majuscule, suivi de zéro ou plus de toute lettre, espace, trait d'union, esperluette ou apostrophe et se terminant par une lettre
                    $erreurs["fname"] = "Vérifiez votre saisie (seules lettres, espace, trait d'union, esperluette(&) et apostrophe sont autorisés)";
                    echo $erreurs["fname"]."<br>";
                }
            }
            
            // même chose pour e-mail
            if (empty($_POST["email"])) {
                $erreurs["email"] = "L'e-mail doit être renseigné";
                echo $erreurs["email"]."<br>";
            } else {
                $email = test_input($_POST["email"]);
                //vérifie si email adresse est valide:
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $erreurs["email"] = "Vérifiez votre saisie: cette adresse est invalide";
                    echo $erreurs["email"]."<br>";
                }
            }

            //pour date de naissance
            if (empty($_POST["datenaissance"])) {
                $erreurs["datenaissance"] = "La date de naissance doit être renseignée";
                echo $erreurs["datenaissance"]."<br>";
            } else {
                $dn = test_input($_POST["datenaissance"]);
                if (!preg_match("/^[0-9][0-9]?\/[0-9][0-9]?\/[0-9][0-9][0-9]?[0-9]?$/",$dn)) {//regex pour date avec jr et mois en 1-2 chiffres, année en 2 ou 4 chiffres, sép par /
                    $erreurs["datenaissance"] = "Vérifiez votre saisie (écrivez la date avec le jour et le mois en un ou 2 chiffres, l'année sur 2 ou 4 chiffres, séparés par /)";
                    echo $erreurs["datenaissance"]."<br>";
                }
            }
            
            //pour code postal
            if (empty($_POST["cpostal"])) {
                $erreurs["cpostal"] = "Le code postal doit être renseigné";
                echo $erreurs["cpostal"]."<br>";
            } else {
                $cp = test_input($_POST["cpostal"]);
                if (!preg_match("/^[0-9]{5}$/",$cp)) {//regex pour 5 chiffres
                    $erreurs["cpostal"] = "Vérifiez votre saisie (un code postal se compose de 5 caractères numériques)";
                    echo $erreurs["cpostal"]."<br>";
                }
            }

            //pour question
            if (empty($_POST["votrequestion"])) {
                $erreurs["votrequestion"] = "Votre question doit être renseignée";
                echo $erreurs["votrequestion"]."<br>";
            } else {
                $vq = test_input($_POST["votrequestion"]);
                if (!preg_match("/^[A-Za-z0-9 .'&_-]+$/",$vq)) {//regex pour mots, nombres, caractères spéciaux classiques
                    $erreurs["votrequestion"] = "Vérifiez votre saisie";
                    echo $erreurs["votrequestion"]."<br>";
                }
            }
            
            //utilise la fonction sur chaque champ du form qui n'a pas encore été fait (pas required) pour éviter risques de hacking
            if ($_SERVER["REQUEST_METHOD"] == "POST") {//donc une fois que le form a été envoyé
                $adresse = test_input($_POST["adresse"]);
                $ville = test_input($_POST["ville"]);
                $sexe = test_input($_POST["sexe"]);//NB. était required au départ mais on est obligé de choisir une option donc tjs renseigné en fait
             }

            if (count($erreurs) == 0) { // donc ya aucune erreur donc afficher les données
                echo "<h2>Vos données:</h2>";
                echo "Nom: ".$lname."<br>";
                echo "Prénom: ".$fname."<br>";
                echo "Sexe: ".$sexe."<br>";
                echo "Date de Naissance: ".$dn."<br>";
                echo "Code postal: ".$cp."<br>";
                echo "Adresse: ".$adresse."<br>";
                echo "Ville: ".$ville."<br>";
                echo "Adresse e-mail: ".$email."<br>";
                // Lecture du tableau pour select puisque choix multiples possibles
                foreach (($_REQUEST["sujet"]) as $sujet)      
                { 
                    echo "Le sujet de votre demande est: ".$sujet."<br>"; 
                } 
                echo "Votre question: ".$vq."<br>";

                //lecture du tableau pour checkbox :        -PB AVEC CHECKBOX A REVOIR
                /*var_dump($ok);//test
                foreach (($_REQUEST["jaccepte"]) as $ok)      
                { 
                    echo "Vous avez choisi: ".$ok."<br>"; 
                } 
            */
                if ($ok == null){
                    echo "N'accepte pas le traitement informatique <br>";
                } else {
                    echo "Accepte le traitement informatique <br>";
                }
                //REVOIR CHECKBOX CI6DESSUS EN FAIT ON PEUT PAS CHOISIR PLUSIEURS CHOIX ICI DONC SINON FAUT 2 CHECKBOX 1 JACCEPTE 2 JE NACCEPTE PAS NON???
                
            }

        }//fin du tout premier if

    ?>
</body>
</html>