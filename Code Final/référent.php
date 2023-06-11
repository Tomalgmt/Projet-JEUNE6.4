<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
        <img src="images/LOGOS_JEUNES_1.png"><!-- le logo -->
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
        <a class="Consultantbutton" href="Consultant.php">CONSULTANT</a>
        <a class="Partenairebutton" href="Partenaires.php">PARTENAIRE</a>
    </div>




    <br>
    <!-- le texte expliquant le role du référent -->
    <p style="text-align: center;" class="référentvérif">Confirmez cette expérience et ce que vous avez pu constater au contact de ce jeune.</p>
    <br><br>


        <!-- un form en méthode post pour récupérer les informations que le référent va entrer -->
        <form method="post" action="accueil.php" id="form">
            <div class="formulaires">
                <div class="comm"> <!-- on divise chaque partie du form pour lui appliquer le css adéquat -->
                    <p class="Commentaire">Commentaires:</p>
                    <textarea name="textarea" class="textarea"></textarea>
                </div>
                <div class="info"><!-- c'est la que le référent rentre ses données -->
                    <p class="inputtext">NOM:<input type="text" name="nomreferent" required class="text"></p>
                    <p class="inputtext">PRENOM:<input type="text" name="prenomreferent" required class="text"></p>
                    <p class="inputtext">DATE DE NAISSANCE:<input type="text" name="datereferent" required class="text"></p>
                    <p class="inputtext">Mail:<input type="text" name="mailreferent" required class="text"></p>
                    <p class="inputtext">Réseau social:<input type="text" name="socialreferent" class="text"></p>
                    <br>
                    <!-- on met un div au paragraphe pour modifierl'aspect puis un div au texte pour modifier le style et l'écriture -->
                    <p class="inputtext">PRESENTATION:<input type="text" name="presentreferent" class="text"></p>
                    <p class="inputtext">DUREE:<input type="text" name="dureereferent" class="text"></p>
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
                    <p><input class="bouton" type="submit" value="Valider" name="Valider"></p><!-- bouton qui récupère les données et les enregistrent grace au php -->
                </div>
            </div>
        </form>
    

    </body>
</html>

<?php

$fichierJson = "fichier_identifiant.json";
$mailreferent = $_GET['mail2'];
$mailjeune = $_GET['mail1'];

if (isset($_POST["Valider"])) {
    // Récupérer les adresses e-mail de l'utilisateur et du référent à modifier
    // Charger le contenu du fichier JSON
    $jsonData = file_get_contents($fichierJson);
    $users = json_decode($jsonData, true);
    // Parcourir les utilisateurs pour trouver celui correspondant à l'adresse e-mail de l'utilisateur
    foreach ($users as &$user) {
        $userEmailEnregistre = $user['user']['mail'];
        if ($userEmailEnregistre == $mailjeune) {
            // Parcourir les référencements de l'utilisateur pour trouver celui correspondant à l'adresse e-mail du référent
            $referencements = $user['user']['referencements'];
            foreach ($referencements as &$referencement) {
                $referentEmailEnregistre = $referencement['referent']['mail'];
                if ($referentEmailEnregistre == $mailreferent) {
                    // Modifier les attributs du référent avec les nouvelles valeurs fournies dans les données POST
                    $referencement['referent']['nom'] = $_POST["nomreferent"];
                    $referencement['referent']['prenom'] = $_POST["prenomreferent"];
                    $referencement['referent']['date'] = $_POST["datereferent"];
                    $referencement['referent']['mail'] = $_POST["mailreferent"];
                    $referencement['referent']['social'] = $_POST["socialreferent"];
                    $referencement['referent']['present'] = $_POST["presentreferent"];
                    $referencement['referent']['duree'] = $_POST["dureereferent"];
                    // Enregistrer les modifications dans le fichier JSON
                }
            }
            $user['user']['referencements'] = $referencements; // Mettre à jour les référencements dans le tableau $users
        }
    }
    // Enregistrer les modifications dans le fichier JSON
    $jsonData = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents($fichierJson, $jsonData);
}
?>
