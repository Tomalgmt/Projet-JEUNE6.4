<?php
session_start(); //securité
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
         
        <link rel="stylesheet" href="page_authentification.css">
        <meta charset="UTF-8">
    </head>
    <body class="fond">

        <div class="Formulaire_Inscription" id="formulaire_inscription" style="display: block;"> 

            
    <!----------------------------------- formulaire pour modifier son profil ---------------------------------->
            <p class="texte_inscription"> Changer le champ que vous souhaitez </p>
            <form method="POST" action="changement_profil.php">

                <!-- A chaque champ du formulaire, on rajoute au dessus de ce champ un titre -->

                <div class="inscription">
                    <p class="titre_inscription"> Modifier votre nom </p>                        
                    <input class="champ_inscription" type="text" name="nouveau_nom" >   <!-- Champ pour demander le nom -->
                </div>

                <br>

                <div class="inscription">
                    <p class="titre_inscription"> Modifier votre prénom</p>
                    <input class="champ_inscription" type="text" name="nouveau_prenom" > <!-- Champ pour demander le prénom -->
                </div>

                <br>

                <div class="inscription">
                    <p class="titre_inscription"> Modifier votre date de naissance</p>
                    <input class="champ_inscription" type="date" name="nouvelle_date" >  <!-- Champ pour demander la date de naissance -->
                </div>

                <br>

                <div class="inscription">
                    <p class="titre_inscription"> Modifier votre mail</p>
                    <input class="champ_inscription" type="email" name="nouveau_mail" > <!-- Champ pour demander le mail -->
                </div>

                <br>

                <div class="inscription">
                    <p class="titre_inscription"> Modifier votre mot de passe</p>
                    <input class="champ_inscription" type="password" name="nouveau_motdepasse" > <!-- Champ pour demander le mot de passe  -->
                </div>

                <button class="bouton_confirmer_inscription" id="confirmer_inscription" type="submit" name="confirmer">Modifier</button> <!-- bouton pour envoyer le formulaire de connexion -->

            </form>
        </div>

    </body>
</html>

<?php
    if(isset($_POST["confirmer"])) {
        /******************************************************************************************************************************************************** */
            
            // Dans cette partie, on récupère ce qu'a saisi l'utilisateur dans le formulaire et on s'assure qu'aucun champ n'est vide avec trim()
            // si un champ est vide alors on considère que l'utilisateur souhaite garder le même champ

        $prenom = trim($_POST["nouveau_prenom"]);
        $nom = trim($_POST["nouveau_nom"]);
        $mail = trim($_POST["nouveau_mail"]);
        $naissance = trim($_POST["nouvelle_date"]);  
        $motdepasse = trim($_POST["nouveau_motdepasse"]);  
        $numeroLigne = 1;
        $fic = "fichier_identifiant.txt"; // création du fichier qui contiendra les données de tous les utilisateurs
        touch($fic);


        /******************************************************************************************************************************************************** */
        
        // Cette partie de code permet de s'assurer de l'unicité du mail
        
        $monfichierLecture = fopen($fic, "r+");
        $emailUnique = true;
        while (($ligne = fgets($monfichierLecture)) !== false) {
            
                // Si la ligne contient le caractère "#", on effectue la division
                $infos = explode("#", $ligne);
                $emailEnregistre = trim($infos[0]); // Le mail est le premier élément du tableau
    
                if ($emailEnregistre === $mail) {
                    $emailUnique = false; // Si le mail est déjà enregistré, on met la variable $emailUnique à false et on sort de la boucle
                    break;
                }
        }
        
        fclose($monfichierLecture);
    
    
        if (!$emailUnique) {
            // on envoie un message d'erreur si le mail a deja été pris
            echo '<p class="message_erreur_inscription">Cette e-mail est déjà utilisée. Veuillez en choisir une autre.</p>';
        }

        /**********************************************************************************************************************************************************/
            
        





        
        else {
            /**********************************************************************************************************************************************************/

            // Dans cette partie de code, on modifie les anciens champs avec les nouveaux
            $fichierEcriture = fopen($fic, "r+");
            while(($ligne = fgets($fichierEcriture)) !== false){        // on parcourt tout le fichier jusqu'à arriver au mail de l'utilisateur en question
                $infos = explode("#", $ligne);                          
                if($_SESSION["mail"] == $infos[0]){

                    // On remplace les anciens par les nouveaux
                    if(!empty($mail)){
                        $_SESSION["mail"] = $mail;
                    }
                    if(!empty($motdepasse)){
                        $motdepassehash = password_hash($motdepasse,  PASSWORD_BCRYPT);  
                        $_SESSION["motdepasse"] = $motdepasse;
                                                            
                    }
                    if(!empty($naissance)){
                        $_SESSION["naissance"] = $naissance;
                    }
                    if(!empty($nom)){
                        $_SESSION["nom"] = $nom;
                    }
                    if(!empty($prenom)){
                        $_SESSION["prenom"] = $prenom;
                    }
        
                    $contenu = file($fic);
                    if ($contenu !== false) {
                        $contenu[$numeroLigne - 1] = $_SESSION["mail"]  . "#" . $motdepassehash  . "#" . $_SESSION["nom"] . "#" . $_SESSION["prenom"] . "#" . $_SESSION["naissance"]. PHP_EOL; //on remplace l'ancienne ligne par la nouvelle
                        file_put_contents($fic, implode("", $contenu));
                    } 
        
                    break;
                }
                $numeroLigne++;
            }
        
            // Fermer le fichier
            fclose($fichierEcriture);
        
            header('location: page_accueil.php');
        }


        
        
    }

                
                
                    
?>
