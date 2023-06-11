<?php
session_start(); //securité
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <script src="page_authentification.js"></script>
        <link rel="stylesheet" href="accueil_jeune.css">
        <meta charset="UTF-8">
    </head>
    <body class="fond">

      <div id="head_title">
    <a href= "main.php">
    <img id=img src="images/LOGOS_JEUNES_1.png" alt="" />
    </a>
    <div class="head_text">
        <p class="page_title">JEUNE </p> <br> 
        <a> Je donne de la valeur à mon engagement</a>
</div>
</div>

<div id="sub_title">
    <a class="Jeune" href="page_authentification.php">JEUNE</a>
    <a class="Référent" href="Référent.php">REFERENT</a>
    <a class="Consultant" href="Consultant.php">CONSULTANT</a>
    <a class="Partenaire" href="Partenaires.php">PARTENAIRES</a>
</div><br><br>

<div class="actions_jeunes1">
    <div class="demande">
    <img src="images/crayon.png" alt="" >
    <a class="boutons" href= "Jeune.php">Créer une demande de référencement</button></a>
    </div>

    <div class="consultation">
    <img src="images/liste.png" alt="" >
    <a class="boutons" href= "Consultation.php">Consulter la liste de références</button></a>
    </div>

    <div class="envoi">
    <img src="images/ok.png" alt="" >
    <a class="boutons" href= "Envoi.php">Faire valider ses références</button></a>
    </div>
</div>   
<div class="actions_jeunes2">
    <div class="inclure">
    <img src="images/bag.png" alt="" >
    <a class="boutons" href= "inclure.php">Inclure les références dans le CV</button></a>
    </div>
    <div class="profil">
    <img src="images/profile.png" alt="" >
    <a class="boutons" href= "changement_profil.php">Modifier profil</button></a>
    </div>
</div>
