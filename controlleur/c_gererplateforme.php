	<?php

	if (!isset($_POST['cmdAction'])) {
		 $action = 'afficherPlateformes';
	}
	else {
		// par défaut
		$action = $_POST['cmdAction'];
	}

	$idPlateformeModif = -1;		// positionné si demande de modification
	$notification = 'rien';	// pour notifier la mise à jour dans la vue

	// selon l'action demandée on réalise l'action 
	switch($action) {

		case 'ajouterNouveauPlateforme': {		
			if (!empty($_POST['txtLibPlateforme'])) {
				$idPlateformeNotif = $db->ajouterNouveauPlateforme($_POST['txtLibPlateforme']);
				$notification = 'Ajouté';
			}
		  break;
		}

		case 'demanderModifierGenre': {
				$idPlateformeModif = $_POST['txtIdPlateforme'];
			break;
		}
			
		case 'validerModifierPlateforme': {
			$db->modifierPlateforme($_POST['txtIdPlateforme'], $_POST['txtLibPlateforme']); 
			$idGenreNotif = $_POST['txtIdPlateforme']; // $idGenreNotif est l'idGenre du genre modifié
			$notification = 'Modifié';  // sert à afficher la modification réalisée dans la vue
			break;
		}

		case 'supprimerGenre': {
			$idGenre = $_POST['txtIdGenre'];
			$db->supprimerPlateforme($idPlateforme);
			break;
		}
	}
		
	// l' affichage des genres se fait dans tous les cas	
	$tbGenres  = $db->getLesGenres();		
	require 'vue/v_Plateformes.php';

	?>
