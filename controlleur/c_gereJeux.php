<?php
$menuActif = 'Jeux';

// si le paramètre action n'est pas positionné alors
// si aucun bouton "action" n'a été envoyé alors par défaut on affiche les jeux
// sinon l'action est celle indiquée par le bouton
if (!isset($_POST['cmdAction'])) {
    $action = 'afficherJeux';
} else {
    // par défaut
    $action = $_POST['cmdAction'];
}

$refJeuModif = '';       // positionné si demande de modification
$notification = 'rien'; // pour notifier la mise à jour dans la vue

// selon l'action demandée on réalise l'action
switch($action) {
    case 'ajouterNouveauJeu': {
        // Récupération des données du formulaire
        $refJeu = $_POST['refJeu'];
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $dateParution = $_POST['dateParution'];
        $idGenre = $_POST['idGenre'];
        $idMarque = $_POST['idMarque'];
        $idPlateforme = $_POST['idPlateforme'];
        $idPegi = $_POST['idPegi'];
        
        // Ajout du jeu dans la base de données
        $refJeuNotif = $db->ajouterJeu($refJeu, $nom, $prix, $dateParution, $idGenre, $idMarque, $idPlateforme, $idPegi);
        $notification = 'Ajouté';
        break;
    }
    case 'demanderModifierJeu': {
        $refJeuModif = $_POST['refJeu'];
        break;
    }
    case 'validerModifierJeu': {
        // Récupération des données du formulaire
        $refJeu = $_POST['refJeu'];
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $dateParution = $_POST['dateParution'];
        $idGenre = $_POST['idGenre'];
        $idMarque = $_POST['idMarque'];
        $idPlateforme = $_POST['idPlateforme'];
        $idPegi = $_POST['idPegi'];

        // Modification du jeu dans la base de données
        $db->modifierJeu($refJeu, $nom, $prix, $dateParution, $idGenre, $idMarque, $idPlateforme, $idPegi);
        $refJeuNotif = $refJeu;
        $notification = 'Modifié';
        break;
    }
    case 'supprimerJeu': {
        $refJeu = $_POST['refJeu'];
        $db->supprimerJeu($refJeu);
        $notification = 'Supprimé';
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

// --- DEBUT INITIALISATION TWIG ---
require_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('vue');
$twig = new \Twig\Environment($loader);

$variables = [
    'menuActif' => $menuActif,
    'tbJeux' => $tbJeux,
    'tbGenres' => $tbGenres,
    'tbMarques' => $tbMarques,
    'tbPlateformes' => $tbPlateformes,
    'tbPegis' => $tbPegis,
    'refJeuModif' => $refJeuModif,
    'notification' => $notification,
];
if (isset($refJeuNotif)) {
    $variables['refJeuNotif'] = $refJeuNotif;
}

echo $twig->render('v_lesJeux.html.twig', $variables);
// --- FIN ---
?>