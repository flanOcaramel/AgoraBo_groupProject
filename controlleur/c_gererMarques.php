<?php
// ...existing code...

if (!isset($_POST['cmdAction'])) {
    $action = 'afficherMarques';
} else {
    $action = $_POST['cmdAction'];
}

$idMarqueModif = -1;
$notification = 'rien';

switch ($action) {

    case 'ajouterNouvelleMarque': {
            if (!empty($_POST['txtLibMarque'])) {
                // Use the correct column name: nomMarque
                $idMarqueNotif = $db->ajouterMarque($_POST['txtLibMarque']); // DAO should insert into nomMarque
                if ($idMarqueNotif) {
                    $notification = 'Ajouté';
                } else {
                    $notification = 'Erreur lors de l\'ajout';
                }
            } else {
                $notification = 'Le nom de la marque ne peut pas être vide';
            }
            break;
        }

    case 'demanderModifierMarque': {
            $idMarqueModif = $_POST['txtIdMarque'];
            break;
        }

    case 'validerModifierMarque': {
            if (!empty($_POST['txtLibMarque'])) {
                $result = $db->modifierMarque($_POST['txtIdMarque'], $_POST['txtLibMarque']); // DAO should update nomMarque
                if ($result) {
                    $idMarqueNotif = $_POST['txtIdMarque'];
                    $notification = 'Modifié';
                } else {
                    $notification = 'Erreur lors de la modification';
                }
            } else {
                $notification = 'Le nom de la marque ne peut pas être vide';
            }
            break;
        }

    case 'supprimerMarque': {
            $idMarque = $_POST['txtIdMarque'];
            $result = $db->supprimerMarque($idMarque);
            if ($result) {
                $notification = 'Supprimé';
            } else {
                $notification = 'Erreur lors de la suppression';
            }
            break;
        }
}

$tbMarques  = $db->getLesMarques();
require 'vue/v_lesMarques.php';
