<!DOCTYPE html>
 <html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"><!--règle un bug spécifique du navigateur
        Apple Safari mobile sous le système d'exploitation iOS 9 (iPhone/iPad).-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><!--pour importer Bootstrap via une URL pointant sur un CDN (un serveur externe hébergeant des fichiers)-->

    <title>Atelier PHP N°4 - formulaire de modification</title>
  </head>
  <body> 
    <div class="container-fluid"> 
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Mon compte</a><!--on ne sait pas vers quelle page va 'Mon Compte' donc lien # à définir-->
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../contact.html">Contact</a>
            </li>
          </ul>
        </div>
      </nav>

      <?php   
        require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions

        $db = connexionBase(); // Appel de la fonction de connexion
        $pro_id = $_GET["pro_id"];
        $pro_ref = $_GET["pro_ref"];
        $requete = $db->prepare("SELECT categories.cat_nom, pro_id, pro_ref, pro_libelle, pro_description, pro_prix, pro_stock, pro_couleur, pro_photo, pro_bloque, pro_d_ajout, pro_d_modif FROM produits 
        JOIN categories ON cat_id = pro_cat_id
        WHERE pro_id=".$pro_id);//on veut tous champs pour cette ligne y compris dans table categories, champ cat_nom pour 'Catégorie'
        $requete->execute();
        
        // Renvoi de l'enregistrement sous forme d'un objet
        $produit = $requete->fetch(PDO::FETCH_OBJ);
      ?>

      <div class="row m-1 m-sm-1">
        <div class="col-12 col-sm-12 text-justify">
          <form method="post" action="<?php echo 'produitsmodif.php?pro_id='.$produit->pro_id.'"';?>" id="formulaire_modif">
            <div class="form-group">
              <label for="idproduit">ID</label><!--même si on veut modifier produit, ce champ est clé primaire et auto-incrémenté donc on ne doit pas y toucher non?-->
              <input type="text" class="form-control" id="idpdt" name="idpdt" value="<?php echo $produit->pro_id;?>" disabled="disabled">
              <p id="idpdt" class="text-danger"></p><!--sert à js donc à enlever si pas besoin A VERIFIER -->
            </div>
            <div class="form-group"><!--ref sert d'index dans table produits donc ref est uniq et liée à l'ID du produit donc champ passé en GET dans url-->
              <label for="refpdt">Référence</label>
              <input type="text" class="form-control" id="refpdt" name="refpdt" value="<?php echo $produit->pro_ref;?>">
              <p id="refHelp" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="catpdt">Catégorie</label>                
              <?php 
                  
                    $requete2 = $db->prepare("SELECT DISTINCT categories.cat_nom, pro_cat_id FROM produits 
                    JOIN categories ON cat_id = pro_cat_id");//on veut champs catégorie y compris dans table categories, champ cat_nom pour 'Catégorie'
                    $requete2->execute();
                    // Renvoi de l'enregistrement sous forme d'un objet
                    $liste = $requete2->fetchAll(PDO::FETCH_OBJ);
                   //utilisation des données obtenues par la requête dans les options de liste déroulante
                    echo '<select class="form-control" id="catpdt" name="catpdt">';
                    foreach($liste as $row){
                        echo '<option  value="'.$row->pro_cat_id.'">'.$row->pro_cat_id.'-'.$row->cat_nom.'</option>';
                    }
              ?>
            </div>
            <div class="form-group">
              <label for="libpdt">Libellé</label>
              <input type="text" class="form-control" id="libpdt" name="libpdt" value="<?php echo $produit->pro_libelle;?>">
              <p id="libHelp" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="descriptionpdt">Description</label>
              <input type="text" class="form-control" id="descriptionpdt" name="descriptionpdt" value="<?php echo $produit->pro_description;?>">
              <p id="descHelp" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="prixpdt">Prix</label>
              <input type="text" class="form-control" id="prixpdt" name="prixpdt" value="<?php echo $produit->pro_prix;?>">
              <p id="prixHelp" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="stockpdt">Stock</label>
              <input type="text" class="form-control" id="stockpdt" name="stockpdt" value="<?php echo $produit->pro_stock;?>">
              <p id="stockHelp" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="couleurpdt">Couleur</label>
              <input type="text" class="form-control" id="couleurpdt" name="couleurpdt" value="<?php echo $produit->pro_couleur;?>">
              <p id="clrHelp" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="photopdt">Photo :</label>
              <input type="text" class="form-control" id="photopdt" name="photopdt" value="<?php echo $produit->pro_photo;?>">
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">Produit bloqué:
                <input type="radio" class="form-check-input" name="blocpdt" value="1" <?php if ($produit->pro_bloque == 1) { echo "checked"; } ?>>Oui
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="blocpdt" value="" <?php if (is_null($produit->pro_bloque) or $produit->pro_bloque == 0) { echo "checked"; } ?>>Non
              </label>
            </div>          
            <div>
              <p>Date d'ajout : <?php echo $produit->pro_d_ajout;?></p>
            </div>
            <div class="form-group">
              <label for="modifpdt">Date de modification : </label>
              <input type="text" class="form-control" id="modifpdt" name="modifpdt" placeholder="Date au format jj-mm-aaaa">
              <p id="dmodifHelp" class="text-danger"></p>
            </div>
              
            <input type="submit" class="btn btn-dark" value="Modifier" id="btnModifier">
            
            <input type="button" class="btn btn-dark" value="Retour à la liste" id="btnRetour" onclick="window.location.href='liste.php'">
          </form>
        </div> 
      </div><!--ferme div row-->
    </div><!--ferme div container fluid-->

    <!--pour intégrer fichiers Javascript nécessaires à Bootstrap; placez ce code avant la fermeture de la balise body, l'ordre des fichiers est à respecter (Jquery, Popper puis Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!--pour intégrer fichier.js pour Javascript non intrusif-->
    <script src="../js/controlmodif.js"></script>
   </body>
 </html>