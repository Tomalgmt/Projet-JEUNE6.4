<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">


<?php
    session_destroy();

?>
<html>
    <head>
        <title>référent</title>
        <meta charset="UTF-8">
        <!-- On importe le fichier css et javascript -->
        <link rel="stylesheet" type="text/css" href="référent.css">
        <script type="text/javascript" src="référent.css"></script>
    </head>
    
    
    <body>
    <!-- On divise la bannière en plusieurs div pour faciliter le css-->
    <div class="banniere">
        <img src="LOGOS_JEUNES_1.png"><!-- le logo -->
        <div class="bannieretexteréférent">
            <h1 style="text-align: right;">REFERENT</h1>  <!-- le nom du module -->
        </div>
        <div class="référenttexte">
            <h2 style="text-align: right;">Je confirme la valeur de ton engagement</h2><!-- la phrase d'accroche -->
        </div>
    </div>
    <!-- l'affichage des boutons des modules -->
    <div class="liens">
        <a class="Jeunebutton" href="Jeune.php">JEUNE</a>
        <div class="Référentbuttonpage">
            <p class="Référentbutton">REFERENT</p><!-- on rajoute un paragraphe car sur la page le bouton à un aspect différent des autres -->
        </div>
        <a class="Consultantbutton" href="Consultant.html">CONSULTANT</a>
        <a class="Partenairebutton" href="partenaires.html">PARTENAIRE</a>
    </div>

    <p>
""
    </p>


    <br>
    <!-- le texte expliquant le role du référent -->
    <p style="text-align: center;" class="référentvérif">Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune.</p>
    <br><br>


        <!-- un form en méthode post pour récupérer les informations que le référent va entrer -->
        <form method=""post"" action=""acceuil.php"" id=""form"">
            <div class=""formulaires"">
                <div class=""comm""> <!-- on divise chaque partie du form pour lui appliquer le css adéquat -->
                    <p class=""Commentaire"">Commentaires:
                        <label for=""textarea""></label>
                        <input type=""text"" class=""textarea"" name=""textarea"" value="" />
                    </p>
                </div>
    
                <div class="info"><!-- c'est la que le référent rentre ses données -->
                    <p class="inputtext">NOM:<input type="text" name="Name" required class="text"></p>
                    <p class="inputtext">PRENOM:<input type="text" name="PRENOM" required class="text"></p>
                    <p class="inputtext">DATE DE NAISSANCE:<input type="text" name="date" required class="text"></p>
                    <p class="inputtext">Mail:<input type="text" name="mail" required class="text"></p>
                    <p class="inputtext">Réseau social:<input type="text" name="rs" class="text"></p>
                    <br>
                    <!-- on met un div au paragraphe pour modifierl'aspect puis un div au texte pour modifier le style et l'écriture -->
                    <p class="inputtext">PRESENTATION:<input type="text" name="present" class="text"></p>
                    <p class="inputtext">DUREE:<input type="text" name="duree" class="text"></p>
                </div>

                <div class="savoir">
                    <div class="etres">
                        <p>Ses Savoirs Etre</p>
                    </div>
                    <br>
                    <div class="confirm">
                        <p>Je confirme sa(son)*</p>
                    </div>
                    <div class="cases"><!-- le référent coche les savoirs etre qu'il a observé chez le jeune -->
                        <!-- la fonction onclick limite le nombre de cases cochables -->
                        <p class="inputbox"> <input class="box" type="checkbox" name="conf" onclick="limiterCasesCochees()">Confiance</p>
                        <p class="inputbox"> <input class="box" type="checkbox" name="bienve" onclick="limiterCasesCochees()">Bienveillance</p>
                        <p class="inputbox"> <input class="box" type="checkbox" name="resp" onclick="limiterCasesCochees()">Respect</p>
                        <p class="inputbox"> <input class="box" type="checkbox" name="honne" onclick="limiterCasesCochees()">Honnetete</p>
                        <p class="inputbox"> <input class="box" type="checkbox" name="tolé" onclick="limiterCasesCochees()">Tolérance</p>
                        <p class="inputbox"> <input class="box" type="checkbox" name="juste" onclick="limiterCasesCochees()">Juste</p>
                        <p class="inputbox"> <input class="box" type="checkbox" name="impar" onclick="limiterCasesCochees()">Impartial</p>
                        <p class="inputbox"> <input class="box" type="checkbox" name="travail" onclick="limiterCasesCochees()">Travail</p>
                        <!-- deux div pour gérer la distance et le style du texte -->
                    </div>
                    <br>
                    <div class="valider">
                        <p>*Faire 4 choix maximum</p><!-- indique le nombre limite de cases -->
                    </div>
                    <br>
                    <p><input class="bouton" type="submit" value="Valider"></p><!-- bouton qui récupère les données et les enregistrent grace au php -->
                </div>
            </div>
        </form>
    

    </body>
</html>
    ");
?>