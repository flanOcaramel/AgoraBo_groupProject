# TODO: Update Database Table and Columns for Games

## Tasks
- [x] Update `modele/class.PdoJeux.inc.php`:
  - [x] Change table name from "jeu" to "jeu_video" in all SQL queries
  - [x] Update `getLesJeux()` to select refJeu, idPlateforme, idPegi, idGenre, idMarque, nom
  - [x] Update `ajouterJeu()` method signature and SQL to insert into jeu_video with new columns
  - [x] Update `modifierJeu()` method signature and SQL to update jeu_video with new columns
  - [x] Update `supprimerJeu()` to delete from jeu_video using refJeu
- [x] Update `controlleur/c_gererJeux.php`:
  - [x] Update calls to `ajouterJeu()` with new parameters: nom, idPlateforme, idPegi, idGenre, idMarque
  - [x] Update calls to `modifierJeu()` with new parameters
  - [x] Update variable names if needed (e.g., idJeu to refJeu)
- [x] Update `vue/v_lesJeux.php`:
  - [x] Update column references from old names to new ones (e.g., nomJeu to nom, idJeu to refJeu)
- [ ] Test the application to ensure changes work correctly
