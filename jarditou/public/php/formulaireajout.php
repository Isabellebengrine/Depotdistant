<!DOCTYPE html>
 <html lang="fr">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no"><!--règle un bug spécifique du navigateur
        Apple Safari mobile sous le système d'exploitation iOS 9 (iPhone/iPad).-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><!--pour importer Bootstrap via une URL pointant sur un CDN (un serveur externe hébergeant des fichiers)-->
    <link rel="stylesheet" type="text/css" href="public/css/jarditoustyle.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="public/css/Jstyleresponsive.css">
    <title>Formulaire d'ajout de nouveau produit</title>
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
				  <a class="nav-link" href="/jarditou/index.html">Accueil <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="#">Mon compte</a><!--on ne sait pas vers quelle page va 'Mon Compte' donc lien # à définir-->
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="/jarditou/contact.html">Contact</a>
				</li>
			  </ul>
			</div>
		</nav>


        <div class="row m-1 m-sm-1">
          <div class="col-12 col-sm-12 text-justify">
            <form method="post" action="produits_ajout_script.php" id="formulaire_produit">
              <div class="form-group">
                <label for="idpdt">ID</label>
                <input type="text" class="form-control" id="idpdt" name="idpdt" value="n° automatique" disabled>
              </div>
              <div class="form-group">
                <label for="refpdt">Référence</label>
                <input type="text" class="form-control" id="refpdt" name="refpdt">
                <p id="refHelp" class="text-danger"></p>
              </div>
              <div class="form-group">
                <label for="catpdt">Catégorie</label>                
                  <?php 
                  require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
                    $db = connexionBase(); // Appel de la fonction de connexion
                   // $pro_id = $_GET["pro_id"];
                    $requete = $db->prepare("SELECT DISTINCT categories.cat_nom, pro_cat_id FROM produits 
                    JOIN categories ON cat_id = pro_cat_id");//on veut champs catégorie y compris dans table categories, champ cat_nom pour 'Catégorie'
                    $requete->execute();
                    if (!$requete) //donc si la variable $requete vaut NULL
                    {
                        $tableauErreurs = $db->errorInfo();
                        echo $tableauErreur[2]; 
                        die("Erreur dans la requête");
                    }
                    if ($requete->rowCount() == 0) 
                    {       // Pas d'enregistrement
                    die("La table est vide");
                    }
                    // Renvoi de l'enregistrement sous forme d'un objet
                    $produit = $requete->fetchAll(PDO::FETCH_OBJ);
                   //utilisation des données obtenues par la requête dans les options de liste déroulante
                    echo '<select class="form-control" id="catpdt" name="catpdt">';
                    foreach($produit as $row){
                        echo '<option  value="'.$row->pro_cat_id.'">'.$row->pro_cat_id.'-'.$row->cat_nom.'</option>';
                    }
                    
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="libpdt">Libellé</label>
                <input type="text" class="form-control" id="libpdt" name="libpdt">
                <p id="libHelp" class="text-danger"></p>
              </div>
              <div class="form-group">
                <label for="descriptionpdt">Description</label>
                <input type="text" class="form-control" id="descriptionpdt" name="descriptionpdt">
                <p id="descHelp" class="text-danger"></p>
              </div>
              <div class="form-group">
                <label for="prixpdt">Prix</label>
                <input type="text" class="form-control" id="prixpdt" name="prixpdt">
                <p id="prixHelp" class="text-danger"></p>
              </div>
              <div class="form-group">
                <label for="stockpdt">Stock</label>
                <input type="text" class="form-control" id="stockpdt" name="stockpdt">
                <p id="stockHelp" class="text-danger"></p>
              </div>
              <div class="form-group">
                <label for="couleurpdt">Couleur</label>
                <input type="text" class="form-control" id="couleurpdt" name="couleurpdt">
                <p id="clrHelp" class="text-danger"></p>
              </div>
              <div class="form-group">
                <label for="photopdt">Photo :</label>
                <input type="text" class="form-control" id="photopdt" name="photopdt">
                <p id="phtHelp" class="text-danger"></p>
                </div>
                <div class="form-group">
                    <label for="ajoutpdt">Date d'ajout :</label>
                    <input type="text" class="form-control" id="ajoutpdt" name="ajoutpdt">
                    <p id="dajtHelp" class="text-danger"></p>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">Produit bloqué:
                    <input type="radio" class="form-check-input" name="blocpdt" value="1">Oui
                    </label>
                </div>
                <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="blocpdt" value="" checked>Non
                </label>
                </div>
                <div class="row">
                    <input type="submit" class="btn btn-dark" value="Envoyer" id="btnEnvoi">
                </div>
            </form>
          </div> 
        </div><!--ferme div row-->
      </div><!--ferme div container fluid-->

        <!--pour intégrer fichiers Javascript nécessaires à Bootstrap; placez ce code avant la fermeture de la balise body, l'ordre des fichiers est à respecter (Jquery, Popper puis Bootstrap) -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!--pour intégrer fichier.js pour Javascript non intrusif-->
        <script src="/jarditou/public/js/controlajout.js"></script>
   </body>
 </html>