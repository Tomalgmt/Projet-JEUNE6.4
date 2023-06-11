<?php
ob_start();
session_start(); //securité
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <script src="page_authentification.js"></script>
        <link rel="stylesheet" href="page_authentification.css">
        <meta charset="UTF-8">
    </head>
    <body class="fond">

<!--------------------------------------------------------------------------- Partie Connexion ------------------------------------------------------------------------------------------------>



        <div class="Formulaire_Connexion" style="display: block;" id="Formulaire_Connexion">  <!-- formulaire de connexion, il est initialement affiché -->

        <?php
if (isset($_POST["confirmer_connexion"])) { 
    /******************************************************************************************************************************************* */
    // Dans cette partie, on récupère les données du formulaire de connexion
    $mail1 = $_POST["mail1"];
    $motdepasse1 = $_POST["mot_de_passe1"];
    $identifiant_valide = false; // on crée un booléen identifiant_valide qui permettra de savoir si l'utilisateur a saisi les bons identifiants, il initialement mis à faux
    /******************************************************************************************************************************************* */                    
    // Dans cette partie, on va comparer le mail et le mot de passe saisis dans le formulaire de connexion avec ceux du fichier JSON
    if (file_exists("fichier_identifiant.json")) { // On vérifie si le fichier qui contient les données des utilisateurs existe
        $jsonData = file_get_contents("fichier_identifiant.json");
        $users = json_decode($jsonData, true);

        foreach ($users as $user) {
            if ($user['user']['mail'] === $mail1 && password_verify($motdepasse1, $user['user']['motdepasse'])) {
                // Les identifiants sont valides
                $_SESSION["mail"] = $user['user']['mail'];
                $_SESSION["motdepasse"] = $user['user']['motdepasse'];
                $_SESSION["nom"] = $user['user']['nom'];
                $_SESSION["prenom"] = $user['user']['prenom'];
                $_SESSION["naissance"] = $user['user']['date_naissance'];
                $identifiant_valide = true;
                break;
            }
        }
        if ($identifiant_valide) {
            // si l'utilisateur a saisi les bons identifiants, il est redirigé vers la page d'accueil
            header('location: accueil_jeune.php');
        } else {
            // Si les identifiants sont incorrects, on affiche un message d'erreur
            echo '<p class="message_erreur">Identifiants incorrects. Il se peut que vous ne vous soyez pas inscrit.</p>';
        }
    } else {
        // Si le fichier JSON n'existe pas, on affiche un message d'erreur
        echo '<p class="message_erreur">Identifiants incorrects. Il se peut que vous ne vous soyez pas inscrit.</p>';
    }
}
?>

            <!----------------------------------- formulaire pour se connecter ---------------------------------->
            <p class="texte_connexion"> se connecter </p>
            <form method="POST" action="page_authentification.php">

                <input class="champ_connexion" type="email" name="mail1" placeholder="Votre mail" required>
                <br>
                <input class="champ_connexion" type="password" name="mot_de_passe1" placeholder="Votre mot de passe" required>

                <button class="confirmer_connexion" type="submit" name="confirmer_connexion"> Se connecter</button>     <!--bouton pour envoyer le formulaire de connexion -->
            </form>

            <button class="bouton_inscription" onclick="afficherFormulaireInscription()" id="bouton_inscription">Inscription</button>
        </div>


<!------------------------------------------------------------- Partie Inscription ---------------------------------------------------------------------------------------------------------------------------->



        <div class="Formulaire_Inscription" id="formulaire_inscription" <?php if (!isset($_POST["confirmer_inscription"])) echo 'style="display: none;"'; ?>> <!-- cette ligne permet de rester sur le formulaire de d'inscription tant que l'utilisateur n'a pas mis un email valide-->
                
        <?php
if (isset($_POST["confirmer_inscription"])) {
    // Cette partie de code permet de récupèrer les infos du jeune
    $motdepasse = $_POST["mot_de_passe"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $mail = $_POST["mail"];
    $date_naissance_utilisateur = $_POST["date_naissance"];
    $fichierJson = "fichier_identifiant.json"; // création du fichier qui contiendra les données de tous les utilisateurs

    // Cette partie de code permet de s'assurer de l'unicité du mail
    $emailUnique = true;
    if (file_exists($fichierJson)) {
        $jsonData = file_get_contents($fichierJson);
        $users = json_decode($jsonData, true);
        foreach ($users as $user) {
            $emailEnregistre = $user['user']['mail']; // Le mail est le premier élément du tableau

            if ($emailEnregistre == $_POST["mail"]) {
                $emailUnique = false; // Si le mail est déjà enregistré, on met la variable $emailUnique à false et on sort de la boucle
                break;
            }
        }
    }
    if (!$emailUnique) {
        echo '<p class="message_erreur_inscription">Cette e-mail est déjà utilisée. Veuillez en choisir une autre.</p>';
    
    }

    else {

        // cette partie de code permet de mettre dans un fichier JSON les données du jeune après s'être assuré que le mail est unique
        $motdepassehash = password_hash($motdepasse, PASSWORD_BCRYPT); // mise en place du hashage du mot de passe sur le fichier texte
        $newUser = array(
            "user" => array(
                "mail" => $mail,
                "motdepasse" => $motdepassehash,
                "nom" => $nom,
                "prenom" => $prenom,
                "date_naissance" => $date_naissance_utilisateur,
                "social"  => NULL,
                "referencements" => array()
            )
        );
        $users[] = $newUser;
        $jsonData = json_encode($users, JSON_PRETTY_PRINT);
        file_put_contents($fichierJson, $jsonData);
        $_SESSION["mail"] = $_POST["mail"];
        $_SESSION["nom"] = $_POST["nom"];
        $_SESSION["prenom"] = $_POST["prenom"];
        $_SESSION["naissance"] = $_POST["date_naissance"];
        header('location: accueil_jeune.php');
        
    }
}
?>


            <!----------------------------------- formulaire pour s'inscrire ---------------------------------->


            <p class="texte_inscription"> Veuillez remplir les différents champs pour créer un compte </p>
            <form method="POST" action="page_authentification.php">

                <!-- A chaque champ du formulaire, on rajoute au dessus de ce champ un titre -->

                <div class="inscription">
                    <p class="titre_inscription"> Votre nom </p>                        
                    <input class="champ_inscription" type="text" name="nom" required>   <!-- Champ pour demander le nom -->
                </div>

                <br>

                <div class="inscription">
                    <p class="titre_inscription"> Votre prénom </p>
                    <input class="champ_inscription" type="text" name="prenom" required> <!-- Champ pour demander le prénom -->
                </div>

                <br>

                <div class="inscription">
                    <p class="titre_inscription"> Votre date de naissance</p>
                    <input class="champ_inscription" type="date" name="date_naissance" required>  <!-- Champ pour demander la date de naissance -->
                </div>

                <br>

                <div class="inscription">
                    <p class="titre_inscription"> Votre mail</p>
                    <input class="champ_inscription" type="email" name="mail" required> <!-- Champ pour demander le mail -->
                </div>

                <br>

                <div class="inscription">
                    <p class="titre_inscription"> Votre mot de passe</p>
                    <input class="champ_inscription" type="password" name="mot_de_passe" required> <!-- Champ pour demander le mot de passe  -->
                </div>

                <button class="bouton_confirmer_inscription" id="confirmer_inscription" type="submit" name="confirmer_inscription">S'inscrire</button> <!-- bouton pour envoyer le formulaire de d'inscription -->

            </form>
        </div>



    </body>
</html>