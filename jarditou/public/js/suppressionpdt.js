document.getElementById("supprimer").addEventListener("click", confirmer);
function confirmer(){
    var rediriger = document.getElementById("adhref").value;
    let reply = prompt("Vous êtes sûr de vouloir supprimer ce produit? \nAttention, la suppression est définitive!\n(Répondez par oui ou non)");
    if (reply == "oui"){
        window.location.href= rediriger;
    }else {
        window.location.href='liste.php';
    }
}