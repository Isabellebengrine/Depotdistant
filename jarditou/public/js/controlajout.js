//appel fonctions au fur et à mesure de la saisie au lieu d'attendre la fin
document.getElementById("refpdt").addEventListener("input", checkref);
document.getElementById("catpdt").addEventListener("input", checkcat);
document.getElementById("libpdt").addEventListener("input", checklib);
document.getElementById("descriptionpdt").addEventListener("input", checkdesc);
document.getElementById("prixpdt").addEventListener("input", checkprix);
document.getElementById("stockpdt").addEventListener("input", checkstock);
document.getElementById("couleurpdt").addEventListener("input", checkclr);
document.getElementById("photopdt").addEventListener("input", checkphoto);
document.getElementById("ajoutpdt").addEventListener("input", checkdate);

//NB lors de l'utilisation de addEventListener ... le renvoi de false n'a aucun effet. L'interface dans la spécification dit que le type de retour est null. 
//Utilisez event.preventDefault () à la place:

document.forms[0].addEventListener("submit", function(evenement){
  if (document.getElementById("refpdt").value == "") {
        evenement.preventDefault();
        document.getElementById("refHelp").innerHTML = "Tapez une référence";
        document.getElementById("refpdt").focus();
    } else if (document.getElementById("catpdt").value == "") {
        evenement.preventDefault();
        document.getElementById("catHelp").innerHTML = "Tapez une catégorie";
        document.getElementById("catpdt").focus();
    } else if (document.getElementById("libpdt").value == "") {
      evenement.preventDefault();
      document.getElementById("libHelp").innerHTML = "Tapez un libellé";
      document.getElementById("libpdt").focus();
    } else if (checkdesc == false) {
      evenement.preventDefault();
      document.getElementById("descHelp").innerHTML = "Vérifiez la description";
      document.getElementById("descriptionpdt").focus();
    } else if (document.getElementById("prixpdt").value == "") {
      evenement.preventDefault();
      document.getElementById("prixHelp").innerHTML = "Tapez un prix";
      document.getElementById("prixpdt").focus();
    } else if (document.getElementById("stockpdt").value == "") {
        evenement.preventDefault();
        document.getElementById("stockHelp").innerHTML = "Tapez un stock";
        document.getElementById("stockpdt").focus();
    } else if (checkclr == false) {
        evenement.preventDefault();
        document.getElementById("clrHelp").innerHTML = "Vérifiez la couleur";
        document.getElementById("couleurpdt").focus();
    } else if (checkphoto == false) {
        evenement.preventDefault();
        document.getElementById("phtHelp").innerHTML = "Vérifiez l'extension de votre fichier photo";
        document.getElementById("photopdt").focus();
    } else if (document.getElementById("ajoutpdt").value == "") {
      evenement.preventDefault();
      document.getElementById("dajtHelp").innerHTML = "Entrez la date d'ajout";
      document.getElementById("ajoutpdt").focus();
    }
});


//pour controler chaque champ
function checkref(){
  var x = document.forms["formulaire_produit"]["refpdt"].value;
  if (x == "") {
    document.getElementById("refHelp").innerHTML = "Attention, il manque la référence!";
    return false;
  }else {
    var filtre = new RegExp("^[A-Za-z0-9-_]{1,10}$");
    var resultat = filtre.test(x);
    if (resultat == false){
      document.getElementById("refHelp").innerHTML = "Référence: caractères autorisés: caractères alphanumériques, - et _, maximum 10 caractères";
      return false;
    }else {
      document.getElementById("refHelp").innerHTML = "Référence OK!";
      return true;
    }
  }
}

function checkcat(){
  var y = document.forms["formulaire_produit"]["catpdt"].value;
  if (y == "") {
  document.getElementById("catHelp").innerHTML = "Attention, il manque la catégorie!";
    return false;
  }else {
    if (y >30){
      document.getElementById("catHelp").innerHTML = "Vérifiez la saisie de la catégorie (ce doit être un nombre entier entre 1 et 30).";
      return false;
    }else {
      document.getElementById("catHelp").innerHTML = "Catégorie OK!";
      return true;
    }
  }
}

function checklib(){
  var z = document.forms["formulaire_produit"]["libpdt"].value;
  if (z == "") {
    document.getElementById("libHelp").innerHTML = "Attention, il manque le libellé!";
    return false;
  }else {
    var filtre = new RegExp("^[A-Za-z0-9-_ 'éèê]{1,200}$");
    var resultat = filtre.test(z);
    if (resultat == false){
      document.getElementById("libHelp").innerHTML = "Vérifiez votre libellé (caractères autorisés: caractères alphanumériques, é, è, ê, espace, apostrophe, - et _, maximum 200 caractères)!";
      return false;
    }else {
      document.getElementById("libHelp").innerHTML = "Libellé OK!";
      return true;
    }
  }
}

function checkdesc(){//null autorisé
    var d = document.forms["formulaire_produit"]["descriptionpdt"].value;
    var filtre = new RegExp("^[A-Za-z0-9-_ 'éèêàù,.]{1,200}$");
    var resultat = filtre.test(d);
    if (resultat == false) {
      document.getElementById("descHelp").innerHTML = "Vérifiez la saisie de votre description (maximum 200 caractères).";
      return false;
    }else {
        document.getElementById("descHelp").innerHTML = "Description OK!";
        return true;
    }
}

function checkprix(){
  var prix = document.forms["formulaire_produit"]["prixpdt"].value;
  if (prix == "") {
    document.getElementById("prixHelp").innerHTML = "Attention, il manque le prix!";
    return false;
  }else {
    var filtre = new RegExp("^[0-9]{1,3}\.[0-9]{2}$");// regex pour prix (nb décimal à 3 chiffres avnt le . et 2 chiffres après)
    var resultat = filtre.test(prix);
    if (resultat == false) {
      document.getElementById("prixHelp").innerHTML = "Attention! Vérifiez la saisie de votre prix (nombre décimal à 3 chiffres maximum avant le . et 2 chiffres max après le .)";
      return false;
    }else {
      document.getElementById("prixHelp").innerHTML = "Prix OK!";
      return true;
    }
  }
}

function checkstock(){
  var stock = document.forms["formulaire_produit"]["stockpdt"].value;
  if (stock == "") {
    document.getElementById("stockHelp").innerHTML = "Attention, il manque le stock!";
    return false;
  }else {
    var filtre = new RegExp("^[0-9]{1,11}$");// regex pour stock = tout nombre entre 1 et 11 chiffres
    var resultat = filtre.test(stock);
    if (resultat == false) {
      document.getElementById("stockHelp").innerHTML = "Attention! Vérifiez la saisie de votre stock (nombre entier entre 1 et 11 chiffres).";
      return false;
    }else {
      document.getElementById("stockHelp").innerHTML = "Stock OK!";
      return true;
    }
  }
}

function checkclr(){//champ couleur : null autorisé
    var k = document.forms["formulaire_produit"]["couleurpdt"].value;
    var filtre = new RegExp("^[A-Za-z0-9 'éèêà]{1,30}$");
    var resultat = filtre.test(k);
    if (resultat == false) {
      document.getElementById("clrHelp").innerHTML = "Vérifiez la saisie de la couleur (maximum 30 caractères).";
      return false;
    }else {
        document.getElementById("clrHelp").innerHTML = "Couleur OK!";
        return true;
    }
}

function checkphoto(){//champ photo : null autorisé
    var p = document.forms["formulaire_produit"]["photopdt"].value;
    var filtre = new RegExp("^[a-z]{3,4}$");
    var resultat = filtre.test(p);
    if (resultat == false) {
      document.getElementById("phtHelp").innerHTML = "Vérifiez la saisie de l'extension de votre fichier photo (3 ou 4 caractères alphabétiques minuscules).";
      return false;
    }else {
        document.getElementById("phtHelp").innerHTML = "Photo OK!";
        return true;
    }
}

function checkdate(){
    var x = document.forms["formulaire_produit"]["ajoutpdt"].value;
    if (x == "") {
      document.getElementById("dajtHelp").innerHTML = "Attention, il manque la date d'ajout!";
      return false;
    }else {
      var filtre = new RegExp("^[0-3][0-9]-[0-9]{2}-[1-2][0-9]{3}$");
      var resultat = filtre.test(x);
      if (resultat == false){
        document.getElementById("dajtHelp").innerHTML = "Vérifiez la saisie de la date d'ajout (format type dd-mm-yyyy).";
        return false;
      }else {
        document.getElementById("dajtHelp").innerHTML = "Date d'ajout OK!";
        return true;
      }
    }
  }
