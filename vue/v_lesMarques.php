<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Marques</title>
    <link rel="stylesheet" href="web/css/style.css">
</head>

<body>
    <!-- page start-->
    <div class="col-sm-6">
        <section class="panel">
            <div class="chat-room-head">
                <h3><i class="fa fa-angle-right"></i> Gérer les marques</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-advance table-hover">
                    <thead>
                        <tr class="tableau-entete">
                            <th><i class="fa fa-bullhorn"></i> Identifiant</th>
                            <th><i class="fa fa-bookmark"></i> Libellé</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- formulaire pour ajouter une nouvelle marque-->
                        <tr>
                            <form action="index.php?uc=gererMarques" method="post">
                                <td>Nouveau</td>
                                <td>
                                    <input type="text" id="txtLibMarque" name="txtLibMarque" size="24" required minlength="2"
                                        maxlength="40" placeholder="Libellé" title="De 2 à 40 caractères" />
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-xs" type="submit" name="cmdAction"
                                        value="ajouterNouvelleMarque" title="Enregistrer nouvelle marque"><i
                                            class="fa fa-save"></i></button>
                                    <button class="btn btn-info btn-xs" type="reset" title="Effacer la saisie"><i
                                            class="fa fa-eraser"></i></button>
                                </td>
                            </form>
                        </tr>

                        <?php foreach ($tbMarques as $marque): ?>
                            <tr>
                                <form action="index.php?uc=gererMarques" method="post">
                                    <td>
                                        <?= $marque->identifiant ?>
                                        <input type="hidden" name="txtIdMarque" value="<?= $marque->identifiant ?>" />
                                    </td>
                                    <td>
                                        <?php
                                        if ($marque->identifiant != $idMarqueModif) {
                                            echo htmlspecialchars($marque->libelle);
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($notification != 'rien' && isset($idMarqueNotif) && $marque->identifiant == $idMarqueNotif) {
                                                echo '<button class="btn btn-success btn-xs"><i class="fa fa-check"></i> ' . htmlspecialchars($notification) . '</button>';
                                            } ?>
                                        <button class="btn btn-primary btn-xs" type="submit" name="cmdAction"
                                            value="demanderModifierMarque" title="Modifier"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs" type="submit" name="cmdAction"
                                            value="supprimerMarque" title="Supprimer"
                                            onclick="return confirm('Voulez-vous vraiment supprimer cette marque?');"><i
                                                class="fa fa-trash-o"></i></button>
                                    </td>
                                <?php
                                        } else {
                                ?>
                                    <input type="text" id="txtLibMarque" name="txtLibMarque" size="24" required minlength="2"
                                        maxlength="40" value="<?= htmlspecialchars($marque->libelle) ?>" />
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-xs" type="submit" name="cmdAction"
                                            value="validerModifierMarque" title="Enregistrer"><i class="fa fa-save"></i></button>
                                        <button class="btn btn-info btn-xs" type="reset" title="Effacer la saisie"><i
                                                class="fa fa-eraser"></i></button>
                                        <button class="btn btn-warning btn-xs" type="submit" name="cmdAction"
                                            value="annulerModifierMarque" title="Annuler"><i class="fa fa-undo"></i></button>
                                    </td>
                                <?php
                                        }
                                ?>
                                </form>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div><!-- fin div panel-body-->
        </section><!-- fin section marques-->
    </div><!--fin div col-sm-6-->
</body>

</html>