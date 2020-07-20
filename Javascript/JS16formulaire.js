//déclarer fonction
function validateForm() {
    var x = document.forms["formulaire1"]["societe"].value;
    if (x == "") {
      alert("Entrez le nom de la Société svp!");
      return false;
    }
    var y = document.forms["formulaire1"]["nomcontact"].value;
    if (y == "") {
      alert("Entrez le nom de la personne à contacter svp!");
      return false;
    }
    var z = document.forms["formulaire1"]["ville"].value;
    if (z == "") {
      alert("Entrez le nom de la ville svp!");
      return false;
    }
    var cp;
    cp = document.getElementById("cpostal").value;
    // If cp is Not a Number or not 5 digits
    if (isNaN(cp) || cp.length!=5) {
      alert("Le Code Postal doit comporter 5 caractères numériques!");
      return false;
    }
    var tel;
    tel = document.getElementById("numtel").value;
    // If tel is Not a Number or not 10 digits
    if (isNaN(tel) || tel.length!=10) {
      alert("Le numéro de téléphone doit comporter 10 caractères numériques!");
      return false;
    }
  }
//declare fonction inserer
var environmt = document.getElementById("environmt");
var zonedesaisie = document.getElementById("envt");
function inserer(){
  if(environmt.options[0].selected != true){//pour ne pas ecrire Choisissez dans zone de texte
    zonedesaisie.innerHTML = environmt.value;//mais seulement valeur choisie  - vérifié ok
  }
	zonedesaisie.focus();// met curseur dans zone de texte
}
//declenche insertion si user choisit une option dans environmt
environmt.addEventListener("change", inserer);

//appeler fonction
var c = document.getElementById("btnenvoyer");
c.addEventListener("click", validateForm);