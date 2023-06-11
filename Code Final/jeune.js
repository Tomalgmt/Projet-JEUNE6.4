function afficherReferent() {
    let formulaire_referent = document.getElementById("référent");
    let formulaire_jeune = document.getElementById("formulaire_jeune");

        event.preventDefault();
        formulaire_jeune.style.display = "none";
        formulaire_referent.style.display = "block";
    }

//fonction associer au onclick
function limiterCasesCochees() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]'); //on récupère le nombre de checkbox
    var nombreCasesCochées = 0;//compteur

    // Compter le nombre de cases cochées avec une boucle

    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        nombreCasesCochées++;//on incrémente le compteur
      }
    }

    // Désactiver les cases non cochées si le nombre maximum est atteint

    for (var i = 0; i < checkboxes.length; i++) {
      if (!checkboxes[i].checked && nombreCasesCochées >= 4) {//si il y a 4 cases cochées on descative les autres avec .disabled
        checkboxes[i].disabled = true;
      } else {
        checkboxes[i].disabled = false;
      }
    }
  }