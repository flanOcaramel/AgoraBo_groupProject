<div class ="panel panel-primary">
        <div class="panel-heading">Liste des jeux</div>
        <div class="panel-body">
        
        <table class="table table-striped table-bordered table-responsive">
            <thead>
            <tr>
                <th style="width:10%;">Id</th>
                <th style="width:70%;">Nom</th>
                <th style="width:20%;">Actions</th>
            </tr>
            </thead>
            <tbody>
        <tr 
        class = "tableau-entete">
            <form action="index.php?uc=gererJeux" method="post">
                <td>Nouveau</td>
                <td>
                    <input type="text" id="txtLibJeu" name="txtLibJeu" size="40" required minlength="4"  maxlength="64"  placeholder="Nom du jeu" title="De 4 à 64 caractères"  />
                </td>
                <td> 
                    <input type="number" id="txtIdGenre" name="txtIdGenre" size="5" required min="1" max="99" placeholder="Id Genre" title="Entrez l'id du genre (1 à 99)" />
                    <input type="number" id="txtPegi" name="txtPegi" size="5" required min="3" max="18" placeholder="Pegi" title="Entrez le Pegi (3 à 18)" />
                    <input type="text" id="txtMarque" name="txtMarque" size="10" required minlength="2" maxlength="24" placeholder="Marque" title="De 2 à 24 caractères"/>
                    <input type="text" id="txtPlateforme" name="txtPlateforme" size="10" required minlength="2" maxlength="24" placeholder="Plateforme" title="De 2 à 24 caractères"/>
                    <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="ajouterNouveauJeu" title="Enregistrer nouveau jeu"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-xs" type="reset" title="Effacer la saisie"><i class="fa fa-eraser"></i></button>    
                </td>
            </form>
        </tr>
        <?php
        foreach ($tbJeux as $jeu) {
        ?>
        <tr>
            <form action="index.php?uc=gererJeux" method="post">
                <td><?php echo $jeu->identifiant; ?><input type="hidden"  name="txtIdJeu" value="<?php echo $jeu->identifiant; ?>" /></td>
                <td><?php
                    if ($jeu->identifiant != $refJeuModif) {
                        echo $jeu->nom;
                        ?>
                        </td><td>
                            <?php if ($notification != 'rien' && $jeu->identifiant == $refJeuNotif) {
                                echo '<button class="btn btn-success btn-xs"><i class="fa fa-check"></i>' . $notification . '</button>';

                            } ?>
                            <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="demanderModifierJeu" title="Modifier"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btn-xs" type="submit" name="cmdAction" value="supprimerJeu" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer ce jeu?');"><i class="fa fa-trash-o "></i></button>
                        </td>
                    <?php
                    }
                    else {
                        ?><input type="text" id="txtLibJeu" name="txtLibJeu" size="40" required minlength="4"  maxlength="64"   value="<?php echo $jeu->nom; ?>" />
                        </td>
                        <td>
                            <input type="number" id="txtIdGenre" name="txtIdGenre" size="5" required min="1" max="99" placeholder="Id Genre" title="Entrez l'id du genre (1 à 99)" value="<?php echo $jeu->idGenre; ?>" />
                            <input type="number" id="txtPegi" name="txtPegi" size="5" required min="3" max="18" placeholder="Pegi" title="Entrez le Pegi (3 à 18)" value="<?php echo $jeu->idPegi; ?>" />
                            <input type="text" id="txtMarque" name="txtMarque" size="10" required minlength="2" maxlength="24" placeholder="Marque" title="De 2 à 24 caractères" value="<?php echo $jeu->idMarque; ?>"/>
                            <input type="text" id="txtPlateforme" name="txtPlateforme" size="10" required minlength="2" maxlength="24" placeholder="Plateforme" title="De 2 à 24 caractères" value="<?php echo $jeu->idPlateforme; ?>"/>
                            <button class="btn btn-primary btn-xs" type="submit" name="cmdAction" value="validerModifierJeu" title="Enregistrer"><i class="fa fa-save"></i></button>
                            <button class="btn btn-info btn-xs" type="reset" title="Effacer la saisie"><i class="fa fa-eraser"></i></button>
                            <button class="btn btn-warning btn-xs" type="submit" name="cmdAction" value="annulerModifierJeu" title="Annuler"><i class="fa fa-undo"></i></button>
                        </td>
                    <?php
                    }
                    ?>
                </form>
        </tr>  
        <?php
        }
        ?>
            </tbody>
        </table>
        </div>
    </session>
    </div>

