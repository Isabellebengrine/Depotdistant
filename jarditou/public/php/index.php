<?php
include("entete.php");
?>
<body>
<header>

    <div class="container-fluid"> 
        <div class="row">
            <div class="col-8"><img src="public/images/jarditou_logo.jpg" alt="Logo de Jarditou" title="Logo Jarditou" width="150"></div>
            <div class="col-4"><h1 class="text-center">Tout le jardin</h1>
            </div>
        </div>
    </div>

    <!--nvo menu avec bootstrap-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="www.jarditou.com">Jarditou.com</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Accueil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tableau.html">Tableau</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
            
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Votre promotion" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
          </form>
        </div>
    </nav>
    
    <article>
        <img src="public/images/promotion.jpg" alt="Promotion sur lames de terrasse">
       </article>

</header><!--ferme le header-->
<section>
    <div class="container-fluid"> 
        <div class="row shadow mb-2 ml-1 bg-white rounded">
            <div class="col-12 col-lg-8 text-justify">
                <h2>L'entreprise</h2>
                <p>Notre entreprise familiale met tout son savoir-faire à votre disposition dans le domaine du jardin et du paysagisme.</p>
                <p>Créée il y a 70 ans, notre entreprise vend fleurs, arbustes, matériel à main et motorisés.</p>
                <p>Implantés à Amiens, nous intervenons dans tout le département de la Somme : Albert, Doullens, Péronne, Abbeville, Corbie.</p>
                <h2>Qualité</h2>
                <p>Nous mettons à votre disposition un service personnalisé, avec 1 seul interlocuteur durant tout votre projet. Vous serez séduit par notre expertise, nos compétences et notre sérieux.</p>
                <h2>Devis gratuit</h2>
                <p>Vous pouvez bien sûr contacter pour de plus amples informations ou pour une demande d’intervention. Vous souhaitez un devis ? Nous vous le réalisons gratuitement. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facilis vero quibusdam recusandae expedita fuga, corrupti autem maxime rem architecto doloremque consectetur et soluta ex quisquam deleniti harum officia rerum officiis.</p>
            </div> 
            <div class="col-12 col-lg-4 bg-warning text-dark text-center">
                <h2>[Colonne de droite]</h2>
            </div> 
        </div>
    </div>   

</section><!--ferme partie centrale de page d'accueil-->

<footer>
    
    <nav class="navbar navbar-expand-lg navbar-dark">
        <!-- Toggler/collapsible Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>   <!--balise bouton : il s'agit du code du bouton hamburger. L'attribut data-target est obligatoire; sa valeur doit être la même que celle de l'attribut id du <div> suivant (ici collapsibleNavbar) mais préfixé du signe #-->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">mentions légales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">horaires</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">plan du site</a>
                </li>
            </ul>
        </div> 
        
    </nav>


</footer>
<?php
include("pieddepage.php");
?>
</body>
