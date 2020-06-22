//recommencer avec blur pour controler après saisie de chaq champ
function checknom(){
  var x = document.forms["formulaire_contact"]["lname"].value;
  if (x == "") {
    document.getElementById("lnameHelp").innerHTML = "Attention, vous avez oublié de saisir votre nom!";
    return false;
  }
}

function checkprenom(){
  var y = document.forms["formulaire_contact"]["fname"].value;
  if (y == "") {
  document.getElementById("fnameHelp").innerHTML = "Attention, vous avez oublié d'entrer votre prénom!";
    return false;
  }
}

function checkdatenaissance(){
  var z = document.forms["formulaire_contact"]["datenaissance"].value;
  if (z == "") {
    document.getElementById("bdateHelp").innerHTML = "Attention, vous avez oublié d'entrer votre date de naissance!";
    return false;
  }
}

function checkcp(){
  var cpostal = document.getElementById("cpostal");
  var cpfiltre = new RegExp("^[0-9]{5}$");
  var resultat = cpfiltre.test(cpostal.value);
  if (resultat == false) {
    document.getElementById("cpHelp").innerHTML = "Le Code Postal doit comporter 5 caractères numériques!";
    return false;
  }
}

function checkemail(){
  var email = document.getElementById("email");
  var emailfiltre = new RegExp("^.+@.+\..+$");
  var resultat = emailfiltre.test(email.value);
  if (resultat == false) {
    document.getElementById("emlHelp").innerHTML = "Attention! Vérifiez votre adresse e-mail, elle est invalide!";
    return false;
  }
}

function checkquestion(){
  var vquestion = document.forms["formulaire_contact"]["votrequestion"].value;
  if (vquestion == "") {
    document.getElementById("vqHelp").innerHTML = "Attention, vous avez oublié de préciser votre question!";
    return false;
  }
}
//fonction finale n'envoie form que si ts champs ok
function controledeSaisie() {
  if (checknom == false || checkprenom == false || checkdatenaissance == false || checkcp == false || checkemail == false || checkquestion == false){
    alert ("Attention! Votre formulaire ne peut pas être envoyé! Vérifiez votre saisie!")
    return false;
  }
}
//appel fonctions au fur et à mesure de la saisie au lieu d'attendre la fin
document.getElementById("lname").addEventListener("blur", checknom);
document.getElementById("fname").addEventListener("blur", checkprenom);
document.getElementById("datenaissance").addEventListener("blur", checkdatenaissance);
document.getElementById("cpostal").addEventListener("blur", checkcp);
document.getElementById("email").addEventListener("blur", checkemail);
document.getElementById("votrequestion").addEventListener("blur", checkquestion);
//appeler fonction en cliqt sur envoyer dans form contact Jarditou
var c = document.getElementById("boutonEnvoi");
c.addEventListener("submit", controledeSaisie);

