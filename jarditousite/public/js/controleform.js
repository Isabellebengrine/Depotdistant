//appel fonctions au fur et à mesure de la saisie au lieu d'attendre la fin
document.getElementById("lname").addEventListener("input", checknom);
document.getElementById("fname").addEventListener("input", checkprenom);
document.getElementById("datenaissance").addEventListener("input", checkdatenaissance);
document.getElementById("cpostal").addEventListener("input", checkcp);
document.getElementById("email").addEventListener("input", checkemail);
document.getElementById("votrequestion").addEventListener("input", checkquestion);

//appeler fonction en cliqt sur envoyer dans form contact Jarditou - 
//NB lors de l'utilisation de addEventListener ... le renvoi de false n'a aucun effet. L'interface dans la spécification dit que le type de retour est null. Utilisez event.preventDefault () à la place:
//attention ici notre form est le [1] car ya champs de form dans barre de nav

document.forms[1].addEventListener("submit", function(evenement){
  if (document.getElementById("lname").value == "") {
        evenement.preventDefault();
        document.getElementById("lnameHelp").innerHTML = "Tapez un nom.";
        document.getElementById("lname").focus();
    } else if (document.getElementById("fname").value == "") {
        evenement.preventDefault();
        document.getElementById("fnameHelp").innerHTML = "Pensez à taper un prenom !";
        document.getElementById("fname").focus();
    } else if (document.getElementById("datenaissance").value == "") {
      evenement.preventDefault();
      document.getElementById("bdateHelp").innerHTML = "Pensez à taper une date de naissance !";
      document.getElementById("datenaissance").focus();
    } else if (document.getElementById("cpostal").value == "") {
      evenement.preventDefault();
      document.getElementById("cpHelp").innerHTML = "Pensez à taper un code postal !";
      document.getElementById("cpostal").focus();
    } else if (document.getElementById("email").value == "") {
      evenement.preventDefault();
      document.getElementById("emlHelp").innerHTML = "Pensez à taper une adresse e-mail !";
      document.getElementById("email").focus();
    } else if (document.getElementById("votrequestion").value == "") {
      evenement.preventDefault();
      document.getElementById("vqHelp").innerHTML = "Pensez à taper votre question !";
      document.getElementById("votrequestion").focus();
    }
});


//pour controler chaque champ
function checknom(){
  var x = document.forms["formulaire_contact"]["lname"].value;
  if (x == "") {
    document.getElementById("lnameHelp").innerHTML = "Attention, vous avez oublié de saisir votre nom!";
    return false;
  }else {
    var filtrenom = new RegExp("^[A-Za-zéêè' -]+$");
    var resultatnom = filtrenom.test(x);
    if (resultatnom == false){
      document.getElementById("lnameHelp").innerHTML = "Vérifiez votre nom!";
      return false;
    }else {
      document.getElementById("lnameHelp").innerHTML = "Nom OK!";
      return true;
    }
  }
}

function checkprenom(){
  var y = document.forms["formulaire_contact"]["fname"].value;
  if (y == "") {
  document.getElementById("fnameHelp").innerHTML = "Attention, vous avez oublié d'entrer votre prénom!";
    return false;
  }else {
    var filtreprenom = new RegExp("^[A-Za-zéêè' -]+$");
    var resultatprenom = filtreprenom.test(y);
    if (resultatprenom == false){
      document.getElementById("fnameHelp").innerHTML = "Vérifiez votre prénom!";
      return false;
    }else {
      document.getElementById("fnameHelp").innerHTML = "Prénom OK!";
      return true;
    }
  }
}

function checkdatenaissance(){
  var z = document.forms["formulaire_contact"]["datenaissance"].value;
  if (z == "") {
    document.getElementById("bdateHelp").innerHTML = "Attention, vous avez oublié d'entrer votre date de naissance!";
    return false;
  }else {
    var filtredn = new RegExp("^[0-3][0-9][/][0-1][0-9][/][0-9]{4}$");//format date ex 25/04/1973
    var resultatdn = filtredn.test(z);
    if (resultatdn == false){
      document.getElementById("bdateHelp").innerHTML = "Vérifiez votre date de naissance(format 'jj/mm/aaaa')!";
      return false;
    }else {
      document.getElementById("bdateHelp").innerHTML = "Date de naissance OK!";
      return true;
    }
  }
}

function checkcp(){
    var d = document.forms["formulaire_contact"]["cpostal"].value;
  if (d == "") {
    document.getElementById("cpHelp").innerHTML = "Attention, vous avez oublié d'entrer votre code postal!";
    return false;
  }else {
    var cpostal = document.getElementById("cpostal");
    var cpfiltre = new RegExp("^[0-9]{5}$");
    var resultat = cpfiltre.test(cpostal.value);
    if (resultat == false) {
      document.getElementById("cpHelp").innerHTML = "Le Code Postal doit comporter 5 caractères numériques!";
      return false;
    }else {
        document.getElementById("cpHelp").innerHTML = "Code postal OK!";
        return true;
    }
  }
}

function checkemail(){
  var mail = document.forms["formulaire_contact"]["email"].value;
  if (mail == "") {
    document.getElementById("emlHelp").innerHTML = "Attention, vous avez oublié de préciser votre adresse e-mail!";
    return false;
  }else {
    var email = document.getElementById("email");
    var emailfiltre = new RegExp("^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-z]{2,3}$");// regex pour email
    var resultat = emailfiltre.test(email.value);
    if (resultat == false) {
      document.getElementById("emlHelp").innerHTML = "Attention! Vérifiez votre adresse e-mail, elle est invalide!";
      return false;
    }else {
      document.getElementById("emlHelp").innerHTML = "Adresse e-mail valide!";
      return true;
    }
  }
}

function checkquestion(){
  var vquestion = document.forms["formulaire_contact"]["votrequestion"].value;
  if (vquestion == "") {
    document.getElementById("vqHelp").innerHTML = "Attention, vous avez oublié de préciser votre question!";
    return false;
  }else {
    return true;
  }
}


