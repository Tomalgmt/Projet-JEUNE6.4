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
                    $identifiant_valide = false; // on créer un booléen identifiant_valide qui permettra de savoir si l'utilisateur a saisi les bons identifiants, il initialement mis a faux


                    /******************************************************************************************************************************************* */
                    


                     
                    /******************************************************************************************************************************************* */
                    
                        // Dans cette partie on va comparer le mail et le mot de passe du saisi dans formulaire de connexion avec le mail et le mot de passe saisi lors de l'inscription
                     
                    if (file_exists("fichier_identifiant.txt")) { // On vérifie si le fichier qui contient les données des utilisateurs existe
                        $fichier1 = fopen("fichier_identifiant.txt", "r");

                        while (($ligne = fgets($fichier1)) !== false) {
                            $infos = explode("#", $ligne);
                            $boolverif1 = ($mail1 == trim($infos[0]));
                            $boolverif2 = password_verify($motdepasse1, trim($infos[1])); // Compare le mot de passe hash(dans le fichier des données) avec le mot de passe donné
                            if ($boolverif1 && $boolverif2) { // On compare les identifiants envoyés par l'utilisateur avec les identifiants enregistrés lors de l'inscription
                                
                                //on récupère les données de l'utilisateur que l'on met dans des variables de session
                                $_SESSION["mail"] = $infos[0];
                                $_SESSION["motdepasse"] = $infos[1];
                                $_SESSION["nom"] = $infos[2];                
                                $_SESSION["prenom"] = $infos[3];
                                $_SESSION["naissance"] = $infos[4];
                                $identifiant_valide = true;                //si les bons identifiants on été saisi, alors on met $identifiant_valide a true
                                break;                                     
                                
                            }
                        }
                        
                    /******************************************************************************************************************************************* */



                    /******************************************************************************************************************************************* */
                            
                        /*Dans cette partie on regarde la valeur de $identifiant_valide, s'il vaut true c'est que l'utilisateur a mis les bon identifiants il est dirigé vers la page d'accueil
                          s'il vaut false, l'utilisateur a mis les mauvais identifants on envoie uun message d'erreur
                        */
                            if ($identifiant_valide== true) {

                                // si l'utilisateur a mis ses bons identifiants, il est redirigé vers la page d'accueil
                                header('location: accueil_jeune.php');
                            }
                            else{
                                /* Si identifiant_valide a pour valeur faux à la fin de la boucle, c'est que l'utilisateur n'a pas saisi les bons identifiants ou ne s'est pas inscrit
                                    Dans tous les cas on renvoie un message d'erreur
                                */
                                echo '<p class="message_erreur">Identifiants incorrects. Il se peut que vous ne vous soyez pas inscrit.</p>';
                            }
                    }
                     /******************************************************************************************************************************************* */


                    else{

                        //si le fichier fichier_identifiant.txt n'existe pas, c'est que aucun utilisateur ne s'est inscrit et on envoie un message d'erreur 
                        echo '<p class="message_erreur">Identifiants incorrects. Il se peut que vous ne vous soyez pas inscrit.</p>';

                    }
                        
                
                }
                             

           

            ?>

            <!----------------------------------- formulaire pour se connecter ---------------------------------->
            <p class="texte_connexion"> CONNEXION </p>
            <form method="POST" action="page_authentification.php">

                <input class="champ_connexion" type="email" name="mail1" placeholder="Votre mail" required>
                <br>
                <input class="champ_connexion" type="password" name="mot_de_passe1" placeholder="Votre mot de passe" required>

                <button class="confirmer_connexion" type="submit" name="confirmer_connexion"> Se connecter</button>
            </form>

            <button class="bouton_inscription" onclick="afficherFormulaireInscription()" id="bouton_inscription">Inscription</button>
        </div>


<!------------------------------------------------------------- Partie Inscription ---------------------------------------------------------------------------------------------------------------------------->



        <div class="Formulaire_Inscription" id="formulaire_inscription" <?php if (!isset($_POST["confirmer_inscription"])) echo 'style="display: none;"'; ?>> <!-- cette ligne permet de rester sur le formulaire de d'inscription tant que l'utilisateur n'a pas mis un email valide-->

            <?php
                if (isset($_POST["confirmer_inscription"])) {
                    
                    /******************************************************************************************************************************************** */
                        
                    // Cette partie de code permet de récupèrer les infos du jeune

                    $motdepasse = $_POST["mot_de_passe"];
                    $nom = $_POST["nom"];
                    $prenom = $_POST["prenom"];
                    $mail = $_POST["mail"];
                    $date_naissance_utilisateur = $_POST["date_naissance"];
                    $fic = "fichier_identifiant.txt"; // création du fichier qui contiendra les données de tous les utilisateurs
                    touch($fic);


                    /******************************************************************************************************************************************************** */
                    
                    // Cette partie de code permet de s'assurer de l'unicité du mail
                    
                    $monfichierLecture = fopen($fic, "r+");
                    $emailUnique = true;
                    while (($ligne = fgets($monfichierLecture)) !== false) {
                        
                            // Si la ligne contient le caractère "/", on effectue la division
                            $infos = explode("#", $ligne);
                            $emailEnregistre = trim($infos[0]); // Le mail est le premier élément du tableau
                
                            if ($emailEnregistre === $mail) {
                                $emailUnique = false; // Si le mail est déjà enregistré, on met la variable $emailUnique à false et on sort de la boucle
                                break;
                            }
                    }
                    
                    fclose($monfichierLecture);
                
                
                    if (!$emailUnique) {
                        echo '<p class="message_erreur_inscription">Cette e-mail est déjà utilisée. Veuillez en choisir une autre.</p>';
                    }

                    /******************************************************************************************************************************************************** */
                        
                    
                  
                    else {

                    /******************************************************************************************************************************************************** */

                        // cette partie de code permet de mettre dans un fichier les données du jeune après s'être assurer que le mail est unique

                        $motdepassehash = password_hash($motdepasse,  PASSWORD_BCRYPT); // mise en place du hashage du mot de passe sur le fichier texte
                        $monfichierEcriture = fopen($fic, "a"); // Si le mail est unique, on ajoute le nouvel utilisateur à la fin du fichier 
                        fputs($monfichierEcriture, $mail . "#" . $motdepassehash . "#" . $nom . "#" . $prenom . "#" . $date_naissance_utilisateur ); // on range les données en les séparants par un #
                        fputs($monfichierEcriture, "\n");
                        fclose($monfichierEcriture);
                        $_SESSION["mail"] = $_POST["mail"];
                        $_SESSION["motdepasse"] = $_POST["mot_de_passe"];
                        $_SESSION["nom"] = $_POST["nom"];               
                        $_SESSION["prenom"] = $_POST["prenom"];
                        $_SESSION["naissance"] = $_POST["date_naissance"];
                        header('location: accueil_jeune.php');

                    /******************************************************************************************************************************************************** */
                    
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

                <button class="bouton_confirmer_inscription" id="confirmer_inscription" type="submit" name="confirmer_inscription">S'inscrire</button> <!-- bouton pour envoyer le formulaire de connexion -->

            </form>
        </div>



    </body>
</html>