<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta charset="utf-8" http-equiv="content-type" content="text/html;charset=iso-8859-1"/>
</head>
<link rel="stylesheet" href="jeune.css">

<body>

<div id="head_title">
    <a href= "main.php">
    <img id=img src="LOGOS_JEUNES_1.png" alt="" />
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

<form action="form.php" method="post">
    <div class="info">
              <div class ="rectangle_jeune">
                <div class="info_jeune">
                  
                  <p class="inputtext">NOM :<input type="text" name="Name" required></p>
                  <p class="inputtext">PRENOM :<input type="text" name="PRENOM" required></p>
                  <p class="inputtext">DATE DE NAISSANCE :<input type="month" name="date" required></p>
                  <p class="inputtext">Mail :<input type="text" name="mail" required></p>
                  <p class="inputtext">Réseau social :<input type="text" name="rs" ></p>
                  <br><br>
                  <p class="inputtext">MON ENGAGEMENT :<input type="text" name="present" required></p>
                  <p class="inputtext">DUREE :<input type="text" name="duree" required></p>
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
  <button type="submit" class="valider">Valider</button>
</form>