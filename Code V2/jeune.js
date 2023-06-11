function afficherReferent() {
    let formulaire_referent = document.getElementById("référent");
    let formulaire_jeune = document.getElementById("formulaire_jeune");

        event.preventDefault();
        formulaire_jeune.style.display = "none";
        formulaire_referent.style.display = "block";
    }