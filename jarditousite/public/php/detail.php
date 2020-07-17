<?php 
    include("headerdetail.php");
   
    require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions

    $db = connexionBase(); // Appel de la fonction de connexion
    $pro_id = $_GET["pro_id"];
    $requete = $db->prepare("SELECT categories.cat_nom, pro_photo, pro_id, pro_ref, pro_libelle, pro_description, pro_prix, pro_stock, pro_couleur, pro_bloque, pro_d_ajout, pro_d_modif FROM produits 
    JOIN categories ON cat_id = pro_cat_id
    WHERE pro_id=".$pro_id);//on veut tous champs pour cette ligne y compris dans table categories, champ cat_nom pour 'Catégorie'
    $requete->execute();
    if (!$requete) //donc si la variable $requete vaut NULL
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

    // Renvoi de l'enregistrement sous forme d'un objet
    $produit = $requete->fetch(PDO::FETCH_OBJ);
   ?>
        <div class="row m-1 m-sm-1">
          <div class="col-12 col-sm-12 text-justify">
            <div class="text-center">
              <?php 
              $image = $produit->pro_id.".".$produit->pro_photo;
              echo '<img src="../images/'.$image.'" width="200" alt="Image du produit">';?>
            </div>
           <form><!--en fait ici j'utilise form mais je ne veux pas saisir les champs par contre je veux les voir avec les valeurs de la base donc je ne renseigne pas action ou method et je mets tous champs en disabled, j'utiliserai la meme structure de page ensuite dans formulairemodif.php pour plus d'homogénéité-->
              <div class="form-group">
                <label for="idproduit">ID</label>
                <input type="text" class="form-control" id="idpdt" name="idpdt" value="<?php echo $produit->pro_id;?>" disabled="disabled">
                <p id="idpdt" class="text-danger"></p><!--sert à js donc à enlever si pas besoin A VERIFIER -->
              </div>
              <div class="form-group">
                <label for="refpdt">Référence</label>
                <input type="text" class="form-control" id="refpdt" name="refpdt" value="<?php echo $produit->pro_ref;?>" disabled="disabled">
              </div>
              <div class="form-group">
                <label for="catpdt">Catégorie</label>
                <input type="text" class="form-control" id="catpdt" name="catpdt" value="<?php echo $produit->cat_nom;?>" disabled="disabled">
                <!--ici on veut nom de catégorie pas le code donc modifié requete avec join sur table categories -->
              </div>
              <div class="form-group">
                <label for="libpdt">Libellé</label>
                <input type="text" class="form-control" id="libpdt" name="libpdt" value="<?php echo $produit->pro_libelle;?>" disabled="disabled">
              </div>
              <div class="form-group">
                <label for="descriptionpdt">Description</label>
                <input type="text" class="form-control" id="descriptionpdt" name="descriptionpdt" value="<?php echo $produit->pro_description;?>" disabled="disabled">
              </div>
              <div class="form-group">
                <label for="prixpdt">Prix</label>
                <input type="text" class="form-control" id="prixpdt" name="prixpdt" value="<?php echo $produit->pro_prix;?>" disabled="disabled">
              </div>
              <div class="form-group">
                <label for="stockpdt">Stock</label>
                <input type="text" class="form-control" id="stockpdt" name="stockpdt" value="<?php echo $produit->pro_stock;?>" disabled="disabled">
              </div>
              <div class="form-group">
                <label for="couleurpdt">Couleur</label>
                <input type="text" class="form-control" id="couleurpdt" name="couleurpdt" value="<?php echo $produit->pro_couleur;?>" disabled="disabled">
              </div>
              <div class="form-group">
                <label for="photopdt">Photo :</label>
                <input type="text" class="form-control" id="photopdt" name="photopdt" value="<?php echo $produit->pro_photo;?>" disabled="disabled">
                </div>
              <div class="form-check-inline">
                <label class="form-check-label">Produit bloqué ?:
                  <input type="radio" class="form-check-input" name="optradio" <?php if ($produit->pro_bloque == 1) { echo "checked"; } ?> disabled="disabled">Oui
                </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="optradio" <?php if (is_null($produit->pro_bloque) OR $produit->pro_bloque == 0) { echo "checked"; } ?> disabled="disabled">Non
              </label>
            </div>
            <div class="form-group">
                <label for="ajoutpdt">Date d'ajout</label>
                <input type="text" class="form-control" id="ajoutpdt" name="ajoutpdt" value="<?php echo $produit->pro_d_ajout;?>" disabled="disabled">
              </div>
            <div class="form-group">
                <label for="modifpdt">Date de modification</label>
                <input type="text" class="form-control" id="modifpdt" name="modifpdt" value="<?php echo $produit->pro_d_modif;?>" disabled="disabled">
              </div>
            <button class="btn btn-dark my-2 my-sm-0" type="button"  onclick="window.location.href='liste.php'">Retour à la liste</button>
            <button class="btn btn-warning my-2 my-sm-0" type="button"  onclick="window.location.href='<?php echo 'formulairemodif.php?pro_id='.$produit->pro_id.'&pro_ref='.$produit->pro_ref;?>'">Modifier</button>
            <button class="btn btn-danger my-2 my-sm-0" type="button" id="supprimer">Supprimer</button>
            <input type="hidden" id="adhref" value="<?php echo 'suppression.php?pro_id='.$produit->pro_id; ?>"/>
            </form>
          </div> 
        </div><!--ferme div row-->
<?php 
include("footer.php");
?>