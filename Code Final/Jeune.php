<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta charset="utf-8" http-equiv="content-type" content="text/html;charset=iso-8859-1"/>
</head>
  <script src="jeune.js"></script>
<link rel="stylesheet" href="jeune.css">

<body>

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

<form action="Jeune.php" method="POST">
  <div id="formulaire_jeune">
    <a class="texte1"> Veuillez remplir vos informations </a> <br>
    <div class="info">
              <div class ="rectangle_jeune">
                <div class="info_jeune">
                  
                  <p class="inputtext">NOM :<input type="text" name="nomjeune" value="<?php echo isset($_SESSION['nom']) ? $_SESSION['nom'] : ''; ?>" required></p>
                  <p class="inputtext">PRENOM :<input type="text" name="prenomjeune" value="<?php echo isset($_SESSION['prenom']) ? $_SESSION['prenom'] : ''; ?>" required></p>
                  <p class="inputtext">DATE DE NAISSANCE :<input type="date" name="datejeune" value="<?php echo isset($_SESSION['naissance']) ? date('Y-m-d', strtotime($_SESSION['naissance'])) : ''; ?>" required></p>
                  <p class="inputtext">Mail :<input type="email" name="mailjeune" value="<?php echo isset($_SESSION['mail']) ? $_SESSION['mail'] : ''; ?>"required></p>
                  <p class="inputtext">Réseau social :<input type="text" name="socialjeune" ></p>
                  <br><br>
                  <p class="inputtext">MON ENGAGEMENT :<input type="text" name="presentjeune" required></p>
                  <p class="inputtext">DUREE :<input type="text" name="dureejeune" required></p>

                </div>
              </div>
               <div class="savoir_jeune">
                <p class= "info_title"> Je suis  </p>
                 <div class="checklist">
                <p><input type="checkbox" name="autonome" onclick="limiterCasesCochees()">Autonome</p>
                <p><input type="checkbox" name="passion" onclick="limiterCasesCochees()">Passionné</p>
                <p><input type="checkbox" name="réfléchi" onclick="limiterCasesCochees()">Réfléchi</p>
                <p><input type="checkbox" name="écoute" onclick="limiterCasesCochees()">A l'écoute</p>
                <p><input type="checkbox" name="organisé" onclick="limiterCasesCochees()">Organisé</p>
                <p><input type="checkbox" name="fiable" onclick="limiterCasesCochees()">Fiable</p>
                <p><input type="checkbox" name="patient" onclick="limiterCasesCochees()">Patient</p>
                <p><input type="checkbox" name="responsable" onclick="limiterCasesCochees()">Responsable</p>
                <p><input type="checkbox" name="social" onclick="limiterCasesCochees()">Sociable</p>
                <p><input type="checkbox" name="optimiste" onclick="limiterCasesCochees()">Optimiste</p>
                 </div>
                 
                </div>
              </div>
  <button type="button" class="valider" name="valider" onclick= "afficherReferent()">Valider</button>
  </div>



  <div id="référent" style="display: none;">
    <a class="texte2"> Veuillez remplir les informations de votre référent </a> <br>
  <div class="rectangle_référent">
                <div class = "info_référent">
                
                <p class="inputtext">NOM :<input type="text" name="nomreferent" required></p>
                <p class="inputtext">PRENOM :<input type="text" name="prenomreferent" required></p>
                <p class="inputtext">DATE DE NAISSANCE :<input type="date" name="datereferent" required></p>
                <p class="inputtext">Mail :<input type="email" name="mailreferent" required></p>
                <p class="inputtext">Réseau social :<input type="text" name="socialreferent" ></p>
                <br><br>
                <p class="inputtext">PRESENTATION :<input type="text" name="presentreferent" required></p>
                <p class="inputtext">DUREE :<input type="text" name="dureereferent" required></p>
              </div>
  </div>
    <button type="submit" class="envoyer" name="envoyer" >Envoyer</button>
  </div>
</form>

<?php
$fichierJson = "fichier_identifiant.json";
  $nomjeune = "";
  $prenomjeune = "";
  $datejeune = "";
  $mailjeune = "";
  $socialjeune = "";
  $presentjeune = "";
  $dureejeune = "";

$nomjeune = $_SESSION["nom"];
$prenomjeune = $_SESSION["prenom"];
$datejeune = $_SESSION["date"];
$mailjeune = $_SESSION["mail"];
    if (isset($_POST["envoyer"])) {
        
      $socialjeune = $_POST['socialjeune'];
      $presentjeune = $_POST['presentjeune'];
      $dureejeune = $_POST['dureejeune'];
  
      
      $nomreferent = $_POST["nomreferent"];
      $prenomreferent = $_POST["prenomreferent"];
      $datereferent = $_POST["datereferent"];
      $mailreferent = $_POST["mailreferent"];
      $socialreferent = $_POST["socialreferent"];
      $presentreferent = $_POST["presentreferent"];
      $dureereferent = $_POST["dureereferent"];
      // Valider l'email
      if (filter_var($mailreferent, FILTER_VALIDATE_EMAIL)) {
        $jsonData = file_get_contents($fichierJson);
        $users = json_decode($jsonData, true);
        
        foreach ($users as &$user) {
            $emailEnregistre = $user['user']['mail'];
            if ($emailEnregistre == $mailjeune) {
                $nouveauReferencement = array(
                    "referent" => array(
                        "nom" => $nomreferent,
                        "prenom" => $prenomreferent,
                        "date" => $datereferent,
                        "mail" => $mailreferent,
                        "social" => $socialreferent,
                        "present" => $presentreferent,
                        "duree" => $dureereferent,
                    ),
                    "jeune" => array(
                        "nom" => $nomjeune,
                        "prenom" => $prenomjeune,
                        "date" => $datejeune,
                        "mail" => $mailjeune,
                        "social" => $socialjeune,
                        "present" => $presentjeune,
                        "duree" => $dureejeune,
                    ),
                    "valid" => null
                );

                $user["user"]['referencements'][] = $nouveauReferencement;
                break; // Sortir de la boucle une fois que le référencement est ajouté
            }
        }

        $jsonData = json_encode($users, JSON_PRETTY_PRINT);
        file_put_contents($fichierJson, $jsonData);
    }
}



?>
