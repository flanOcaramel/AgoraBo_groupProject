<?php

/**
 *  AGORA
 * 	©  Logma, 2019
 * @package default
 * @author MD
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 * 
 * Classe d'accès aux données. 
 * Utilise les services de la classe PDO
 * pour l'application AGORA
 * Les attributs sont tous statiques,
 * $monPdo de type PDO 
 * $monPdoJeux qui contiendra l'unique instance de la classe
 */
class PdoJeux {

    private static $monPdo;
    private static $monPdoJeux = null;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct() {
		// A) >>>>>>>>>>>>>>>   Connexion au serveur et à la base
		try {   
			// encodage
			$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''); 
			// Crée une instance (un objet) PDO qui représente une connexion à la base
			PdoJeux::$monPdo = new PDO(DSN,DB_USER,DB_PWD, $options);
			// configure l'attribut ATTR_ERRMODE pour définir le mode de rapport d'erreurs 
			// PDO::ERRMODE_EXCEPTION: émet une exception 
			PdoJeux::$monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// configure l'attribut ATTR_DEFAULT_FETCH_MODE pour définir le mode de récupération par défaut 
			// PDO::FETCH_OBJ: retourne un objet anonyme avec les noms de propriétés 
			//     qui correspondent aux noms des colonnes retournés dans le jeu de résultats
			PdoJeux::$monPdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		}
		catch (PDOException $e)	{	// $e est un objet de la classe PDOException, il expose la description du problème
			die('<section id="main-content"><section class="wrapper"><div class = "erreur">Erreur de connexion à la base de données !<p>'
				.$e->getmessage().'</p></div></section></section>');
		}
    }
	
    /**
     * Destructeur, supprime l'instance de PDO  
     */
    public function _destruct() {
        PdoJeux::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * Appel : $instancePdoJeux = PdoJeux::getPdoJeux();
     * 
     * @return l'unique objet de la classe PdoJeux
     */
    public static function getPdoJeux() {
        if (PdoJeux::$monPdoJeux == null) {
            PdoJeux::$monPdoJeux = new PdoJeux();
        }
        return PdoJeux::$monPdoJeux;
    }

	//==============================================================================
	//
	//	METHODES POUR LA GESTION DES GENRES
	//
	//==============================================================================
	
    /**
     * Retourne tous les genres sous forme d'un tableau d'objets 
     * 
     * @return array le tableau d'objets  (Genre)
     */
    public function getLesGenres(): array {
  		$requete =  'SELECT idGenre as identifiant, libGenre as libelle 
						FROM genre 
						ORDER BY libGenre';
		try	{	 
			$resultat = PdoJeux::$monPdo->query($requete);
			$tbGenres  = $resultat->fetchAll();	
			return $tbGenres;		
		}
		catch (PDOException $e)	{  
			die('<div class = "erreur">Erreur dans la requête !<p>'
				.$e->getmessage().'</p></div>');
		}
    }

	
	/**
	 * Ajoute un nouveau genre avec le libellé donné en paramètre
	 * 
	 * @param string $libGenre : le libelle du genre à ajouter
	 * @return int l'identifiant du genre crée
	 */
    public function ajouterGenre(string $libGenre): int {
        try {
            $requete_prepare = PdoJeux::$monPdo->prepare("INSERT INTO genre "
                    . "(idGenre, libGenre) "
                    . "VALUES (0, :unLibGenre) ");
            $requete_prepare->bindParam(':unLibGenre', $libGenre, PDO::PARAM_STR);
            $requete_prepare->execute();
			// récupérer l'identifiant crée
			return PdoJeux::$monPdo->lastInsertId(); 
        } catch (Exception $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
				.$e->getmessage().'</p></div>');
        }
    }
	
	
	 /**
     * Modifie le libellé du genre donné en paramètre
     * 
     * @param int $idGenre : l'identifiant du genre à modifier  
     * @param string $libGenre : le libellé modifié
     */
    public function modifierGenre(int $idGenre, string $libGenre): void {
        try {
            $requete_prepare = PdoJeux::$monPdo->prepare("UPDATE genre "
                    . "SET libGenre = :unLibGenre "
                    . "WHERE genre.idGenre = :unIdGenre");
            $requete_prepare->bindParam(':unIdGenre', $idGenre, PDO::PARAM_INT);
            $requete_prepare->bindParam(':unLibGenre', $libGenre, PDO::PARAM_STR);
            $requete_prepare->execute();
        } catch (Exception $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
				.$e->getmessage().'</p></div>');
        }
    }
	
	
	/**
     * Supprime le genre donné en paramètre
     * 
     * @param int $idGenre :l'identifiant du genre à supprimer 
     */
    public function supprimerGenre(int $idGenre): void {
        try {
            $requete_prepare = PdoJeux::$monPdo->prepare("DELETE FROM genre "
                    . "WHERE genre.idGenre = :unIdGenre");
            $requete_prepare->bindParam(':unIdGenre', $idGenre, PDO::PARAM_INT);
            $requete_prepare->execute();
        } catch (Exception $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
				.$e->getmessage().'</p></div>');
        }
    }
	public function getLesJeux(): array {
  	    $requete =  'SELECT refJeu as identifiant, nom, idPlateforme, idPegi, idGenre, idMarque
                        FROM jeu_video
                        ORDER BY nom';
        try	{
            $resultat = PdoJeux::$monPdo->query($requete);
            $tbJeux  = $resultat->fetchAll();
            return $tbJeux;
        }
        catch (PDOException $e)	{
            die('<div class = "erreur">Erreur dans la requête !<p>'
                .$e->getmessage().'</p></div>');
        }
    }

    public function ajouterJeu(string $nom, int $idPlateforme, int $idPegi, int $idGenre, int $idMarque): int {
        try {
            $requete_prepare = PdoJeux::$monPdo->prepare("INSERT INTO jeu_video "
                    . "(refJeu, nom, idPlateforme, idPegi, idGenre, idMarque) "
                    . "VALUES (0, :unNom, :unIdPlateforme, :unIdPegi, :unIdGenre, :unIdMarque) ");
            $requete_prepare->bindParam(':unNom', $nom, PDO::PARAM_STR);
            $requete_prepare->bindParam(':unIdPlateforme', $idPlateforme, PDO::PARAM_INT);
            $requete_prepare->bindParam(':unIdPegi', $idPegi, PDO::PARAM_INT);
            $requete_prepare->bindParam(':unIdGenre', $idGenre, PDO::PARAM_INT);
            $requete_prepare->bindParam(':unIdMarque', $idMarque, PDO::PARAM_INT);
            $requete_prepare->execute();
        }
        catch (Exception $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
                .$e->getmessage().'</p></div>');
        }
        // récupérer l'identifiant crée
        return PdoJeux::$monPdo->lastInsertId();
    }

    public function modifierJeu(int $refJeu, string $nom, int $idPlateforme, int $idPegi, int $idGenre, int $idMarque): void {
        try {
            $requete_prepare = PdoJeux::$monPdo->prepare("UPDATE jeu_video "
                    . "SET nom = :unNom, idPlateforme = :unIdPlateforme, idPegi = :unIdPegi, idGenre = :unIdGenre, idMarque = :unIdMarque "
                    . "WHERE jeu_video.refJeu = :unRefJeu");
            $requete_prepare->bindParam(':unRefJeu', $refJeu, PDO::PARAM_INT);
            $requete_prepare->bindParam(':unNom', $nom, PDO::PARAM_STR);
            $requete_prepare->bindParam(':unIdPlateforme', $idPlateforme, PDO::PARAM_INT);
            $requete_prepare->bindParam(':unIdPegi', $idPegi, PDO::PARAM_INT);
            $requete_prepare->bindParam(':unIdGenre', $idGenre, PDO::PARAM_INT);
            $requete_prepare->bindParam(':unIdMarque', $idMarque, PDO::PARAM_INT);
            $requete_prepare->execute();
        } catch (Exception $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
                .$e->getmessage().'</p></div>');
        }
    }

    public function supprimerJeu(int $refJeu): void {
        try {
            $requete_prepare = PdoJeux::$monPdo->prepare("DELETE FROM jeu_video "
                    . "WHERE jeu_video.refJeu = :unRefJeu");
            $requete_prepare->bindParam(':unRefJeu', $refJeu, PDO::PARAM_INT);
            $requete_prepare->execute();
        } catch (Exception $e) {
            die('<div class = "erreur">Erreur dans la requête !<p>'
                .$e->getmessage().'</p></div>');
        }
    }
}


?>