<?php

if (!isset($_POST['cmdAction'])) {
    $action = 'afficherJeux';
}
else {
    // par défaut
    $action = $_POST['cmdAction'];
}

    $idGenreModif = -1;		// positionné si demande de modification
    $refJeuModif = -1;		// positionné si demande de modification
    $notification = 'rien';	// pour notifier la mise à jour dans la vue

// selon l'action demandée on réalise l'action
switch($action) {

    case 'ajouterNouveauJeu': {
        if (!empty($_POST['txtLibJeu']) && !empty($_POST['txtIdGenre']) && !empty($_POST['txtPegi']) && !empty($_POST['txtMarque']) && !empty($_POST['txtPlateforme'])) {
            $refJeuNotif = $db->ajouterJeu($_POST['txtLibJeu'], $_POST['txtPlateforme'], $_POST['txtPegi'], $_POST['txtIdGenre'], $_POST['txtMarque']);
            // $refJeuNotif est le refJeu du jeu ajouté
            $notification = 'Ajouté';	// sert à afficher l'ajout réalisé dans la vue
        }
        break;
    }

    case 'demanderModifierJeu': {
        $refJeuModif = $_POST['txtIdJeu']; // sert à créer un formulaire de modification pour ce jeu
        break;
    }

    case 'validerModifierJeu': {
        $db->modifierJeu($_POST['txtIdJeu'], $_POST['txtLibJeu'], $_POST['txtPlateforme'], $_POST['txtPegi'], $_POST['txtIdGenre'], $_POST['txtMarque']);
        $refJeuNotif = $_POST['txtIdJeu']; // $refJeuNotif est le refJeu du jeu modifié
        $notification = 'Modifié';  // sert à afficher la modification réalisée dans la vue
        break;
    }

    case 'supprimerJeu': {
        $idJeu = $_POST['txtIdJeu'];
        $db-> supprimerJeu($idJeu);
        $notification = 'Supprimé';  // sert à afficher la suppression réalisée dans la vue
        break;
    }
}

// l' affichage des jeux se fait dans tous les cas
$tbJeux  = $db->getLesJeux();
require 'vue/v_lesJeux.php';
?>

