<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP04 - Tableaux</title>
</head>
<body>
    <?php
/*
        //declarer tableau vide avec
        $tab = array(); //ou aussi
        $tab = [];
        $tab = array(array(1, "janvier", "2016"), 
             array(2, "février", "2017"), 
             array(3, "mars", "2018"), 
             array(4, "avril", "2019")
             );//ex de tableau à plusieurs dimensions, on peut aussi le déclarer avec

        $tab[] = array(1, "janvier", "2016"); 
        $tab[] = array(2, "février", "2017"); 
        $tab[] = array(3, "mars", "2018"); 
        $tab[] = array(4, "avril", "2019");

        //pour accéder aux infos:
        // Affiche : 3 mars 2018
        echo $tab[2][0]." ".$tab[2][1]." ".$tab[2][2]."<br>"; 

        //ex représenter des factures de téléphone mensuelles sur une année. Avec un tableau classique, vous allez associer chaque ligne du tableau aux mois et la colonne aux valeurs :
        $facture[0] = 500; // représente Janvier / 500 euros
        $facture[1] = 620; // représente Février 
        // $... 
        $facture[11]= 300; // représente Décembre
        //Grâce aux tableaux associatifs vous allez représenter le même tableau comme suit
        $facture["Janvier"] = 500; 
        $facture["Février"] = 620; 
        // $........ 
        $facture["Décembre"] = 300; 
        //ce qui s'écrit aussi
        $facture = array("Janvier" => 500, "Février" => 620, "Décembre" => 300); //à compléter avec toutes val évidemmt

        // fonction count() retourne le nombre d'éléments (valeurs) que contient un tableau : (meme chose que sizeof() d'ailleurs)
        $mois = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
        echo "<p>fonction count() donne ".count($mois)."</p>"; // Affiche 12 

        // fonction foreach
        $factures = array("Janvier" => 500, "Février" => 620, "Mars" => 300, "Avril" => 130, "Mai" => 560, "Juin" => 350); 

        $total_annuel = 0;

        foreach ($factures as $value) //premier argument: nom du tableau; instruction as affecte à la variable située à sa droite (ici $value) la valeur du tableau en cours de lecture; la valeur de la variable $value change donc à chaque tour de boucle
        { 
        echo $value." &euro;<br>"; 
        $total_annuel += $value;     
        } 
        echo "Total annuel de vos factures téléphoniques : ".$total_annuel." &euro;"; 

        //pour afficher le couple cle-valeur
        foreach ($factures as $key => $value) 
        { 
        echo "<p>Facture du mois de ".$key." : ".$value." €</p>";
        $total_annuel += $value;
        }
        // fonction array_push() - ajouter un élément à la fin d'un tableau
        $tab = array("Lundi", "Mardi", "Mercredi", "Jeudi"); 
        array_push($tab, "Vendredi"); 

        //fonction array_pop() extrait le dernier élément d'un tableau et le supprime du tableau
        $tab = array("Lundi", "Mardi", "Mercredi"); 
        $jour = array_pop($tab); //$tab ne contient plus que Lundi et Mardi

        //fonction array_unshift()
        $tab = array("Jeudi", "Vendredi"); 
        array_unshift($tab, "Lundi", "Mardi", "Mercredi"); //$tab contient Lundi, Mardi, Mercredi, Jeudi, Vendredi, dans cet ordre.

        //fonction unset() retire un élément du tableau
        $tab = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"); 
        unset($tab[2]);// Suppression de l'élément 2 (Mercredi)
        var_dump($tab);//NB. $tab passe de $tab[1] à $tab[3] donc çà peut poser pb si on exec une boucle donc faut reindexer valeurs avec array_values() ainsi:
        $tab = array_values($tab);
        var_dump($tab);//now  index correct dans $tab
*/
        //EXERCICES

        $a = array("19001" => array("Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "", "", "Centre", "Centre", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Validation", "Validation"), 
        "19002" => array("Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Validation", ""), 
        "19003" => array("", "", "Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "Centre", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "Stage", "", "", "Validation") 
        );
        var_dump($a);
/*      //exercice 0 - tester exemples du cours avec var_dump
        echo count($a);//donne 3 - ok
        //Pour acceder à chaque sous-tab séparémt:
        var_dump($a["19001"]);
        var_dump($a["19002"]);
        var_dump($a["19003"]);//ok
*/
        //exercice 1
        foreach($a["19002"] as $x => $x_value) {
            if($x_value=="Validation"){
                echo "<p>La validation du groupe 19002 a lieu la semaine numéro ".($x+1).".</p>";//prendre x+1 car semaine 0 n'existe pas donc semaine est comme position = index +1
            }
          }

        //exercice 2 - position de la dernière occurrence de Stage pour le groupe 19001
        foreach($a["19001"] as $x => $x_value) {
            if($x_value=="Stage"){
                $semaine = $x;//prend la dernière occurence
            }
          }
        echo "<p>La dernière semaine de stage du groupe 19001 est la semaine numéro ".($semaine+1).".</p>";//prendre +1 car semaine 0 n'existe pas donc semaine est comme position = index +1
        
        //exo 3 - Extraire, dans un nouveau tableau, les codes des groupes
        $codes = array_keys($a);
        var_dump($codes);//test - ok
        echo "<p>Les numéros de codes sont maintenant dans le tableau ci-dessus.</p>";

        //exo 4 - Combien de semaines dure le stage du groupe 19003 ?
        //$stage = array_slice($a["19003"],startneedstobenumericvaluedoncavoir, lengthalsonumericvalue, trueifpreservekeys or falseifnot) et apres count($stage) mais comment trouver start et length???

        $debut = array_search("Stage", $a["19003"]);//1e occurence de "Stage" dans 19003, donne 11 - ok
        var_dump($debut);//donne 11 = 1e fois qu'il trouve "stage" - ok
        foreach($a["19003"] as $x => $x_value) {
            if($x_value=="Centre"){
                $fincentre = $x;//prend la dernière occurence de "Centre" car le stage commence juste après la période au centre
            }
          }
        var_dump($fincentre);//donne 10 - ok
        foreach($a["19003"] as $x => $x_value) {
            if($x_value=="Stage"){
                $fin = $x;//prend la dernière occurence de "Stage"
            }
          }
        var_dump($fin);//donne 22 - ok
        echo "<p>Le stage du groupe 19003 dure ".($fin-$fincentre)." semaines.</p>";
        echo "<p>Sinon on peut trouver la même chose avec une autre façon:".($fin-$debut+1)."semaines.</p>";
        


    ?>
</body>
</html>