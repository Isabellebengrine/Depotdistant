//Exercice 1 - Calcul du nombre de jeunes, de moyens et de vieux
let i = 1, age = 0, jeune = 0, moyen = 0, vieux = 0;
function exo1(){
	for (i=1; age<100; i++){
		age = prompt("Entrez l'âge numéro " + i +" ou \nCesser la saisie en entrant un âge supérieur ou égal à 100");
		if (parseInt(age)<20){
			jeune = jeune + 1;
		} else if (parseInt(age)>40) {
			vieux = vieux + 1;
  		} else {
  			moyen = moyen + 1;
  		}
  	}
  	alert("Résultats:\nIl y a " + jeune + " jeunes,\n " + moyen + " personnes entre 20 et 40 ans,\n et " + vieux + " vieux, y compris un centenaire!");
  	return (jeune, moyen, vieux);
}
//appel de la fonction en cliquant sur le bouton
let calcul1 = document.getElementById("exercice1");
calcul1.addEventListener("click", exo1);

//Exercice 2 : Table de multiplication
let n;
function TableMultiplication(n){
	do{
    	n = prompt("Entrez le nombre dont vous voulez la table de multiplication:");
 	}while(isNaN(n) || n%1!==0);//verif que n est un nombre et un nombre entier, sinon redemande n
	document.getElementById("tabletitre").innerHTML ="La table de multiplication du nombre: "+n;
	for (i=1;i<=10;i++){
		var c = 'table'+i;
		document.getElementById(c).innerHTML = "<p>" + i + " x " + parseInt(n) + " = " + (i*parseInt(n)) + "</p>";
	}
}//fin de declaration de la fonction
//appel de la fonction en cliquant sur le bouton
let calcul2 = document.getElementById("exercice2");
calcul2.addEventListener("click", TableMultiplication);

//Exercice 3 : recherche d'un prénom
function exo3(){
	let tab = ["Audrey", "Aurélien", "Flavien", "Jérémy", "Laurent", "Melik", "Nouara", "Salem", "Samuel", "Stéphane"];
	let prenom = prompt("Saisissez un prénom");
	let idx = tab.indexOf(prenom);
	if (idx > -1){
		tab.splice(idx,1);
	    tab.push("  ");
	} else{//donc prenom pas dans tableau
		alert("Erreur: ce prénom n'est pas dans le tableau!");
	}
	//pour voir result dans la page au lieu de devoir afficher dans console
	document.getElementById("verifExo3").innerHTML = "Le tableau contient maintenant:" + tab + " .";
	document.getElementById("verif2Exo3").innerHTML = "Le tableau contient toujours " + tab.length + " valeurs.";
}
//appel de la fonction en cliquant sur le bouton
let calcul3 = document.getElementById("exercice3");
calcul3.addEventListener("click", exo3);

//Exercice 4 : total d'une commande
let REM = 0, PORT = 6;
function TotalCommande(){
	let PU = prompt("Saisissez le Prix Unitaire en Euros:");
	let QTECOM = prompt("Saisissez la quantité commandée:");
	let TOT = parseInt(PU)*parseInt(QTECOM);
	if (TOT<100){
		REM = 0;
	}
	if (TOT>=100 && TOT<=200){
		REM = 0.05*TOT;
	}
	if (TOT>200){
		REM = 0.1*TOT;
	}
	if (TOT>=500){
		PORT = 0;
	} else {
		PORT = 0.02*TOT;
		if (PORT<6){
			PORT = 6;
		}
	}
	let PAP = TOT - REM + PORT;
	document.getElementById("verifexo4").innerHTML = "<p>Le prix à payer est donc:</p>" + "<p>Total de " + TOT + "</p><p>- Remise de " + REM + "</p><p>+ Frais de Port de " + PORT + "</p><p>Prix à payer = " + PAP + "</p><p>Et je ne vous parle pas de la TVA!";
	return (TOT, REM, PORT, PAP);//important si ces valeurs servent encore ensuite ailleurs
}
//appel de la fonction en cliquant sur le bouton
let calcul4 = document.getElementById("exercice4");
calcul4.addEventListener("click", TotalCommande);

