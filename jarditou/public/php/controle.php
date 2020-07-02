<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle du formulaire Jarditou</title>
</head>
<body>
    <?php

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
        $fnameErr = $emailErr = $lnameErr = $dnErr = $cpErr = $vqErr = "";//error variables will hold error messages for the required fields
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {//donc ici une fois que le form a été envoyé
            if (empty($_POST["fname"])) {//teste si champ est vide
                $fnameErr = "Le prénom doit être renseigné";//msg d'erreur 
            } else {
                $fname = test_input($_POST["fname"]);//sinon je passe la donnée dans la fonction définie ci-dessus pour + de sécurité
                if (!preg_match("/^[A-Z][a-zA-Z '&-]*[A-Za-z]$/",$fname)) {//regex pour tout ce qui commence par une lettre majuscule, suivi de zéro ou plus de toute lettre, espace, trait d'union, esperluette ou apostrophe et se terminant par une lettre
                    $fnameErr = "Vérifiez votre saisie (seules lettres, espace, trait d'union, esperluette(&) et apostrophe sont autorisés)";
                  }
            }
            //et je fais çà pour chaque champ requis - ici pour nom
            if (empty($_POST["lname"])) {
                $lnameErr = "Le nom doit être renseigné";
            } else {
                $lname = test_input($_POST["lname"]);
                if (!preg_match("/^[A-Z][a-zA-Z '&-]*[A-Za-z]$/",$lname)) {//regex pour tout ce qui commence par une lettre majuscule, suivi de zéro ou plus de toute lettre, espace, trait d'union, esperluette ou apostrophe et se terminant par une lettre
                    $lnameErr = "Vérifiez votre saisie (seules lettres, espace, trait d'union, esperluette(&) et apostrophe sont autorisés)";
                }
            }
            // même chose pour e-mail
            if (empty($_POST["email"])) {
                $emailErr = "L'e-mail doit être renseigné";
            } else {
                $email = test_input($_POST["email"]);
                //vérifie si email adresse est valide:
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Vérifiez votre saisie: cette adresse est invalide";
                }
            }
            //pour date de naissance
            if (empty($_POST["datenaissance"])) {
                $dnErr = "La date de naissance doit être renseignée";
            } else {
                $dn = test_input($_POST["datenaissance"]);
            }
            //pour code postal
            if (empty($_POST["cpostal"])) {
                $cpErr = "Le code postal doit être renseigné";
            } else {
                $cp = test_input($_POST["cpostal"]);
            }
            //pour question
            if (empty($_POST["votrequestion"])) {
                $vqErr = "Votre question doit être renseignée";
            } else {
                $vq = test_input($_POST["votrequestion"]);
            }
        }

        //utilise la fonction sur chaque champ du form qui n'est pas required pour éviter risques de hacking
        if ($_SERVER["REQUEST_METHOD"] == "POST") {//donc une fois que le form a été envoyé
        $adresse = test_input($_POST["adresse"]);
        $ville = test_input($_POST["ville"]);
        $sexe = test_input($_POST["sexe"]);//NB. était required au départ mais on est obligé de choisir une option donc tjs renseigné en fait
        $ok = test_input($_POST["jaccepte"]);
        }
        
        /*pour champ select si c'était un champ obligatoire mais ici ce n'est pas le cas
        if (empty($_POST["sujet"]) 
        {
            echo "Le sujet doit être renseigné";
        }         
        */

        //récupérer valeurs avec méthode POST:
        echo "<h2>Vos données:</h2>";
        //$fname = $_POST["fname"];  //met le prénom dans une variable
        echo "Prénom: ".$_POST["fname"]."<br>";//affiche le prénom
        $lname = $_POST["lname"]; 
        echo "Nom: ".$lname."<br>";
        $sexe = $_POST["sexe"]; 
        echo "Sexe: ".$sexe."<br>";
        $dn = $_POST["datenaissance"]; 
        echo "Date de Naissance: ".$dn."<br>";
        $cp = $_POST["cpostal"]; 
        echo "Code postal: ".$cp."<br>";
        $adresse = $_POST["adresse"]; 
        echo "Adresse: ".$adresse."<br>";
        $ville = $_POST["ville"]; 
        echo "Ville: ".$ville."<br>";
        $email = $_POST["email"]; 
        echo "Adresse e-mail: ".$email."<br>";
        // Lecture du tableau pour select puisque choix multiples possibles
        foreach (($_REQUEST["sujet"]) as $sujet)      
        { 
            echo "Le sujet de votre demande est: ".$sujet."<br>"; 
        } 
        $vq = $_POST["votrequestion"]; 
        echo "Votre question: ".$vq."<br>";
        $ok = $_POST["jaccepte"]; 
        if ($ok == null){
            echo "N'accepte pas le traitement informatique <br>";
        } else {
            echo "Accepte le traitement <br>";
        }

    ?>
</body>
</html>