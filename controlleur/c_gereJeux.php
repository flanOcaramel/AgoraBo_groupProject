<?php
// si le paramètre action n'est pas positionné alors
// si aucun bouton "action" n'a été envoyé alors par défaut on affiche les jeux
// sinon l'action est celle indiquée par le bouton

if (!isset($_POST['cmdAction'])) {
    $action = 'afficherJeux';
} else {
    $action = $_POST['cmdAction'];
}

$refJeuModif = '';       // positionné si demande de modification
$notification = 'rien'; // pour notifier la mise à jour dans la vue

// selon l'action demandée on réalise l'action
switch($action) {

    case 'ajouterNouveauJeu': {
        // vérification des données saisies
        if (!empty($_POST['refJeu']) && !empty($_POST['nom']) && !empty($_POST['prix']) && !empty($_POST['dateParution'])) {
            $refJeuNotif = $db->ajouterJeu(
                $_POST['refJeu'],
                $_POST['nom'],
                $_POST['prix'],
                $_POST['dateParution'],
                $_POST['idGenre'],
                $_POST['idMarque'],
                $_POST['idPlateforme'],
                $_POST['idPegi']
            );
            // $refJeuNotif est la refJeu du jeu ajouté
            $notification = 'Ajouté'; // sert à afficher l'ajout réalisé dans la vue
        }
        break;
    }

    case 'demanderModifierJeu': {
        $refJeuModif = $_POST['refJeu']; // sert à créer un formulaire de modification pour ce jeu
        break;
    }

    case 'validerModifierJeu': {
        $db->modifierJeu(
            $_POST['refJeu'],
            $_POST['nom'],
            $_POST['prix'],
            $_POST['dateParution'],
            $_POST['idGenre'],
            $_POST['idMarque'],
            $_POST['idPlateforme'],
            $_POST['idPegi']
        );
        $refJeuNotif = $_POST['refJeu']; // $refJeuNotif est la refJeu du jeu modifié
        $notification = 'Modifié';  // sert à afficher la modification réalisée dans la vue
        break;
    }

    case 'supprimerJeu': {
        $refJeu = $_POST['refJeu'];
        $db->supprimerJeu($refJeu);
        $refJeuNotif = $refJeu;
        $notification = 'Supprimé';  // sert à afficher la suppression réalisée dans la vue
        break;
    }
}

// l'affichage des jeux se fait dans tous les cas
// on charge les listes pour les formulaires
$tbJeux = $db->getLesJeux();
$tbGenres = $db->getLesGenres();
$tbMarques = $db->getLesMarques();
$tbPlateformes = $db->getLesPlateformes();
$tbPegis = $db->getLesPegis();

require 'vue/v_lesJeux.php';
?>