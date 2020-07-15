<?php
//lorsque le formulaire est soumis, on récupère les informations sur le fichier via la variable superglobale $_FILES. Comme les 7 autres superglobales, cette variable se comporte comme un tableau PHP.
var_dump($_FILES);//? reste empty but why?

//!!!! You will need to create a new directory called "uploads" in the directory where "upload.php" file resides. The uploaded files will be saved there.
//source w3 PHP file upload
$target_dir = "uploads/";//specifies the directory where the file is going to be placed
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);//specifies the path of the file to be uploaded
$uploadOk = 1;// (will be used later)
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));//holds the file extension of the file (in lower case)
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }






/*
if (sizeof($_FILES["fileToUpload"]["error"]) > 0) {
    var_dump($_FILES["fileToUpload"]["error"]);
} 
*/ 

/*PHP fournit un extension nommée FILE_INFO qui fait référence en termes de sécurité. Voici comment l'utiliser:
// On met les types autorisés dans un tableau (ici pour une image)
$aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");

// On extrait le type du fichier via l'extension FILE_INFO 
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimetype = finfo_file($finfo, $_FILES["fichier"]["tmp_name"]);
finfo_close($finfo);

if (in_array($mimetype, $aMimeTypes))
{
    /* Le type est parmi ceux autorisés, donc OK, on va pouvoir 
       déplacer et renommer le fichier */

//} 
//else 
//{
   // Le type n'est pas autorisé, donc ERREUR

   //echo "Type de fichier non autorisé";    
   //exit;
//}    

/*Par défaut, le fichier téléchargé est stocké dans le répertoire tmp de votre serveur (sous Wamp dans C:/wamp/tmp). Mais ce fichier devra sans doute se trouver dans un répertoire de votre projet, il faut donc le déplacer.

Il est nécessaire aussi de renommer le fichier, pour répondre à une éventuelle charte de nommage et surtout pour que l'utilisateur ne puisse tenter d'exécuter le fichier via l'url (le nom sur le serveur sera différent de celui qu'il connaissait).

Pour cela, PHP propose une fonction "2 en 1" : move_uploaded_file(). exemple : déplacer et renommer un fichier (de type image) de tmp vers un répertoire nommé images d'un projet :
*/
//move_uploaded_file($_FILES["fichier"]["tmp_name"], "images/photo.jpg");   

/*
Dans votre projet, vous devez bien sûr remplacer photo.jpg par le nom de fichier souhaité, c'est-à-dire le pro_id et l'extesnion du fichier téléchargé. Le code suivant vous permettra d'obtenir l'extension :
*/
//$extension = substr(strrchr($_FILES["fichier"]["name"], "."), 1);


/* voir https://www.php.net/manual/fr/features.file-upload.post-method.php :

$uploaddir = '/var/www/uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Le fichier est valide, et a été téléchargé
           avec succès. Voici plus d'informations :\n";
} else {
    echo "Attaque potentielle par téléchargement de fichiers.
          Voici plus d'informations :\n";
}

echo 'Voici quelques informations de débogage :';
print_r($_FILES);

echo '</pre>';
*/
?>