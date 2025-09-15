<?php

	if (!isset($_POST['cmdAction'])) {
		 $action = 'afficherPlateformes';
	}
	else {
		// par défaut
		$action = $_POST['cmdAction'];
	}

	$idPlateformeModif = -1;		// positionné si demande de modification
	$notification = 'rien';			// pour notifier la mise à jour dans la vue
	$idPlateformeNotif = -1;		// Variable para las notificaciones

	// selon l'action demandée on réalise l'action 
	switch($action) {

		case 'ajouterNouveauPlateforme': {		
			if (!empty($_POST['txtLibPlateforme'])) {
				$idPlateformeNotif = $db->ajouterNouveauPlateforme($_POST['txtLibPlateforme']);
				$notification = 'Ajouté';
			}
		  break;
		}

		case 'demanderModifierPlateforme': {
				$idPlateformeModif = $_POST['txtIdPlateforme'];
			break;
		}
			
		case 'validerModifierPlateforme': {
			$db->modifierPlateformes($_POST['txtIdPlateforme'], $_POST['txtLibPlateforme']); 
			$idPlateformeNotif = $_POST['txtIdPlateforme'];
			$notification = 'Modifié';
			break;
		}

		case 'supprimerPlateforme': {
			$idPlateforme = $_POST['txtIdPlateforme'];
			$db->supprimerPlateformes($idPlateforme);
			break;
		}
	}
		
	// l'affichage des plateformes se fait dans tous les cas	
	$tbPlateforme = $db->getPlateformes();
	require 'vue/v_Plateformes.php';

?>
