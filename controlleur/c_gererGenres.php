<?php
$menuActif = 'Jeux';

// si le paramètre action n'est pas positionné alors
// si aucun bouton "action" n'a été envoyé alors par défaut on affiche les genres
// sinon l'action est celle indiquée par le bouton
if (!isset($_POST['cmdAction'])) {
     $action = 'afficherGenres';
}
else {
    // par défaut
    $action = $_POST['cmdAction'];
}

$idGenreModif = -1;		// positionné si demande de modification
$notification = 'rien';	// pour notifier la mise à jour dans la vue

// selon l'action demandée on réalise l'action
switch($action) {
    case 'ajouterNouveauGenre': {
        if (!empty($_POST['txtLibGenre'])) {
            $idGenreNotif = $db->ajouterGenre($_POST['txtLibGenre']);
            // $idGenreNotif est l'idGenre du genre ajouté
            $notification = 'Ajouté';	// sert à afficher l'ajout réalisé dans la vue
        }
      break;
    }
    case 'demanderModifierGenre': {
        $idGenreModif = $_POST['txtIdGenre']; // sert à créer un formulaire de modification pour ce genre
        break;
    }
    case 'validerModifierGenre': {
        $db->modifierGenre($_POST['txtIdGenre'], $_POST['txtLibGenre']);
        $idGenreNotif = $_POST['txtIdGenre']; // $idGenreNotif est l'idGenre du genre modifié
        $notification = 'Modifié';  // sert à afficher la modification réalisée dans la vue
        break;
    }
    case 'supprimerGenre': {
        $idGenre = $_POST['txtIdGenre'];
        $db->supprimerGenre($idGenre);
        $notification = 'Supprimé';  // sert à afficher la suppression réalisée dans la vue
        break;
    }
}

$tbGenres  = $db->getLesGenres();

// Chargement et rendu de la vue avec Twig
require_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('vue');
$twig = new \Twig\Environment($loader);

$variables = [
    'menuActif' => $menuActif,
    'tbGenres' => $tbGenres,
    'idGenreModif' => $idGenreModif,
    'notification' => $notification,
];
if (isset($idGenreNotif)) {
    $variables['idGenreNotif'] = $idGenreNotif;
}

echo $twig->render('v_lesGenres.html.twig', $variables);


?>
