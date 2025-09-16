<div class="col-sm-12">
    <section class="panel">
        <div class="chat-room-head">
            <h3><i class="fa fa-gamepad"></i> Gérer les jeux</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr class="tableau-entete">
                        <th><i class="fa fa-barcode"></i> Réf.</th>
                        <th><i class="fa fa-bookmark"></i> Nom</th>
                        <th><i class="fa fa-eur"></i> Prix</th>
                        <th><i class="fa fa-calendar"></i> Parution</th>
                        <th>Genre</th>
                        <th>Marque</th>
                        <th>Plateforme</th>
                        <th>PEGI</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Formulaire pour ajouter un nouveau jeu -->
                    <tr>
                        <form action="index.php?uc=gererJeux" method="post">
                            <td><input type="text" name="refJeu" size="10" required placeholder="Référence"></td>
                            <td><input type="text" name="nom" size="20" required placeholder="Nom du jeu"></td>
                            <td><input type="number" name="prix" step="0.01" style="width:80px;" required placeholder="Prix"></td>
                            <td><input type="date" name="dateParution" style="width:130px;" required></td>
                            <td>
                                <select name="idGenre">
                                    <?php foreach($tbGenres as $genre) echo '<option value="'.$genre->identifiant.'">'.$genre->libelle.'</option>'; ?>
                                </select>
                            </td>
                            <td>
                                <select name="idMarque">
                                    <?php foreach($tbMarques as $marque) echo '<option value="'.$marque->identifiant.'">'.$marque->libelle.'</option>'; ?>
                                </select>
                            </td>
                            <td>
                                <select name="idPlateforme">
                                    <?php foreach($tbPlateformes as $plateforme) echo '<option value="'.$plateforme->identifiant.'">'.$plateforme->libelle.'</option>'; ?>
                                </select>
                            </td>
                            <td>
                                <select name="idPegi">
                                    <?php foreach($tbPegis as $pegi) echo '<option value="'.$pegi->identifiant.'">'.$pegi->age.'</option>'; ?>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="ajouterNouveauJeu" title="Enregistrer nouveau jeu"><i class="fa fa-save"></i></button>
                                <button class="btn btn-info btn-xs" type="reset" title="Effacer la saisie"><i class="fa fa-eraser"></i></button>
                            </td>
                        </form>
                    </tr>

                    <?php foreach ($tbJeux as $jeu): ?>
                        <tr>
                            <form action="index.php?uc=gererJeux" method="post">
                                <input type="hidden" name="refJeu" value="<?php echo htmlspecialchars($jeu->refJeu); ?>">
                                
                                <?php if (isset($refJeuModif) && $jeu->refJeu == $refJeuModif): ?>
                                    <td><?php echo htmlspecialchars($jeu->refJeu); ?></td>
                                    <td><input type="text" name="nom" value="<?php echo htmlspecialchars($jeu->nom); ?>" size="20"></td>
                                    <td><input type="number" name="prix" step="0.01" value="<?php echo htmlspecialchars($jeu->prix); ?>" style="width:80px;"></td>
                                    <td><input type="date" name="dateParution" value="<?php echo htmlspecialchars($jeu->dateParution); ?>" style="width:130px;"></td>
                                    <td>
                                        <select name="idGenre">
                                            <?php foreach($tbGenres as $genre) {
                                                $selected = ($jeu->libGenre == $genre->libelle) ? 'selected' : '';
                                                echo '<option value="'.$genre->identifiant.'" '.$selected.'>'.$genre->libelle.'</option>';
                                            } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="idMarque">
                                            <?php foreach($tbMarques as $marque) {
                                                $selected = ($jeu->nomMarque == $marque->libelle) ? 'selected' : '';
                                                echo '<option value="'.$marque->identifiant.'" '.$selected.'>'.$marque->libelle.'</option>';
                                            } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="idPlateforme">
                                            <?php foreach($tbPlateformes as $plateforme) {
                                                $selected = ($jeu->libPlateforme == $plateforme->libelle) ? 'selected' : '';
                                                echo '<option value="'.$plateforme->identifiant.'" '.$selected.'>'.$plateforme->libelle.'</option>';
                                            } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="idPegi">
                                            <?php foreach($tbPegis as $pegi) {
                                                $selected = ($jeu->ageLimite == $pegi->age) ? 'selected' : '';
                                                echo '<option value="'.$pegi->identifiant.'" '.$selected.'>'.$pegi->age.'</option>';
                                            } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="validerModifierJeu" title="Enregistrer"><i class="fa fa-save"></i></button>
                                        <button class="btn btn-warning btn-xs" type="submit" name="cmdAction" value="annulerModifierJeu" title="Annuler"><i class="fa fa-undo"></i></button>
                                    </td>
                                <?php else: ?>
                                    <td><?php echo htmlspecialchars($jeu->refJeu); ?></td>
                                    <td><?php echo htmlspecialchars($jeu->nom); ?></td>
                                    <td><?php echo htmlspecialchars($jeu->prix); ?> €</td>
                                    <td><?php echo date('d/m/Y', strtotime($jeu->dateParution)); ?></td>
                                    <td><?php echo htmlspecialchars($jeu->libGenre); ?></td>
                                    <td><?php echo htmlspecialchars($jeu->nomMarque); ?></td>
                                    <td><?php echo htmlspecialchars($jeu->libPlateforme); ?></td>
                                    <td><?php echo htmlspecialchars($jeu->ageLimite); ?></td>
                                    <td>
                                        <?php if ($notification != 'rien' && $jeu->refJeu == $refJeuNotif) {  
                                            echo '<button class="btn btn-success btn-xs"><i class="fa fa-check"></i> ' . $notification . '</button>'; 
                                        } ?>
                                        <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="demanderModifierJeu" title="Modifier"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs" type="submit" name="cmdAction" value="supprimerJeu" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer ce jeu ?');"><i class="fa fa-trash-o "></i></button>
                                    </td>
                                <?php endif; ?>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>