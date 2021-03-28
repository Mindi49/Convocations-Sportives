<?php

require_once 'Modele/Modele.php';

/**
 * Fournit les services d'accès aux convocations.
 */
class Convocation extends Modele {
    /**
     * Renvoie la liste des convocations.
     *
     * @return array La liste des convocations.
     */
    public function getConvocations() {
        $sql = 'SELECT * FROM T_CONVOCATION C JOIN T_MATCH M ON M.NumMatch = C.NumMatch ORDER BY Date, Equipe';
        $convocationsMatch = $this->executerRequete($sql);
        return $convocationsMatch->fetchAll();
    }

    /**
     * Renvoie la liste des convocations publiées.
     *
     * @return array La liste des convocations publiées.
     */
     public function getConvocationsPubliees() {
         $sql = 'SELECT * FROM T_CONVOCATION C JOIN T_MATCH M ON M.NumMatch = C.NumMatch WHERE Publie = TRUE ORDER BY Date,Equipe';
         $convocationsMatch = $this->executerRequete($sql);
         return $convocationsMatch->fetchAll();
     }

    /**
     * Renvoie les informations sur une convocation.
     *
     * @param $numConvoc    L'identifiant de la convocation recherchée.
     * @return mixed        La convocation recherchée.
     * @throws Exception    Exception lancée si la convocation recherchée n'existe pas.
     */
    public function getConvocation($numConvoc) {
        $sql = 'SELECT * FROM T_CONVOCATION C JOIN T_MATCH M ON M.NumMatch = C.NumMatch'
            . ' WHERE NumConvoc = ?';
        $convocation = $this->executerRequete($sql, array($numConvoc));
        if ($convocation->rowCount() > 0) {
            return $convocation->fetch(PDO::FETCH_ASSOC);
        }
        else {
            throw new Exception("La convocation demandée n'existe pas ou a été supprimée.");
        }
    }

    /**
     * Renvoie la liste des joueurs convoqués à une convocations.
     *
     * @param $numConvoc    La convocation dont on veut les joueurs convoqués.
     * @return array        La liste des joueurs convoqués.
     */
     public function getJoueursConvoques($numConvoc) {
         $sql = 'SELECT * FROM T_CONVOCATION_JOUEUR C JOIN T_JOUEUR J ON C.IdJoueur = J.IdJoueur '
             . ' WHERE NumConvoc = ? ORDER BY NumConvocJoueur ASC';
         $convocationsMatch = $this->executerRequete($sql, array($numConvoc));
         return $convocationsMatch->fetchAll();
     }

    /**
     * Renvoie le nombre de joueurs convoqués à une convocation.
     * @param $numConvoc    L'identifiant de la convocation.
     * @return int|mixed    Le nombre de joueurs convoqués.
     */
    public function getNbJoueursConvoques($numConvoc) {
        $sql = 'SELECT Count(*) as NbJoueurs FROM T_CONVOCATION_JOUEUR '
            . ' WHERE NumConvoc = ?';
        $convocationsMatch = $this->executerRequete($sql, array($numConvoc));
        if ($convocationsMatch->rowCount() > 0) {
            return $convocationsMatch->fetch(PDO::FETCH_ASSOC);
        }
        else {
            return 0;
        }
    }

    /**
     * Renvoie la liste des joueurs qui peuvent être convoqués à une convocation.
     *
     * @param $numConvoc    L'identifiant de la convocation.
     * @return array        La liste des joueurs convocables à la convocation.
     */
    public function getJoueursConvocables($numConvoc) {
        $sql = 'SELECT * FROM T_JOUEUR'
            . ' WHERE IdJoueur NOT IN '
            . '(SELECT IdJoueur FROM T_ABSENCE'
            . ' WHERE Date = (SELECT Date FROM T_CONVOCATION C JOIN T_MATCH M ON C.NumMatch = M.NumMatch WHERE NumConvoc = ?))'
            . ' AND IdJoueur NOT IN '
            . '(SELECT CJ.IdJoueur'
            . ' FROM (T_CONVOCATION_JOUEUR CJ JOIN T_CONVOCATION C ON CJ.NumConvoc = C.NumConvoc) JOIN T_MATCH M ON C.NumMatch = M.NumMatch '
            . 'WHERE C.NumConvoc <> ? AND Date = (SELECT Date FROM T_CONVOCATION C JOIN T_MATCH M ON C.NumMatch = M.NumMatch WHERE NumConvoc = ?))';
        $convocationsMatch = $this->executerRequete($sql, array($numConvoc,$numConvoc,$numConvoc));
        return $convocationsMatch->fetchAll();
    }

    /**
     * Renvoie la liste des joueurs qui ne peuvent pas être convoqués à une convocation.
     * @param $numConvoc    L'identifiant de la convocation.
     * @return array        La liste des joueurs non convocables à la convocation.
     */
    public function getJoueursNonConvocables($numConvoc) {
        $sql = 'SELECT * FROM T_JOUEUR'
            . ' WHERE IdJoueur IN '
            . '(SELECT IdJoueur FROM T_ABSENCE'
            . ' WHERE Date = (SELECT Date FROM T_CONVOCATION C JOIN T_MATCH M ON C.NumMatch = M.NumMatch WHERE NumConvoc = ?))'
            . ' OR IdJoueur IN '
            . '(SELECT CJ.IdJoueur'
            . ' FROM (T_CONVOCATION_JOUEUR CJ JOIN T_CONVOCATION C ON CJ.NumConvoc = C.NumConvoc) JOIN T_MATCH M ON C.NumMatch = M.NumMatch '
            . ' WHERE C.NumConvoc <> ? AND Date = (SELECT Date FROM T_CONVOCATION C JOIN T_MATCH M ON C.NumMatch = M.NumMatch WHERE NumConvoc = ?))';
        $convocationsMatch = $this->executerRequete($sql, array($numConvoc,$numConvoc,$numConvoc));
        return $convocationsMatch->fetchAll();
    }

    /**
     * Renvoie la liste des matchs pour lesquels aucune convacation n'a encore été créée.
     *
     * @return array        La liste des liste des matchs convocables.
     */
    public function getMatchsConvocables () {
        $sql = 'SELECT * FROM T_MATCH WHERE NumMatch NOT IN (SELECT NumMatch FROM T_CONVOCATION) ORDER BY Date,Equipe';
        $convocationsMatch = $this->executerRequete($sql, array());
        return $convocationsMatch->fetchAll();

    }

    /**
     * Crée une convocation pour un match.
     *
     * @param $numMatch L'identifiant du match auquel est associée la convocation.
     * @return string   L'identifiant de la convocation ainsi créée.
     */
     public function ajouterConvocation($numMatch) {
        $sql = 'INSERT INTO T_CONVOCATION (NumMatch)'
            . ' VALUES (?)';
        $this->executerRequete($sql,array($numMatch));
        return $this->getLastInsertID();
    }

    /**
     * Ajoute une convocation pour un joueur.
     *
     * @param $numConvocation   L'identifiant de la convocation.
     * @param $idJoueur         L'identifiant du joueur convoqué.
     */
    public function ajouterJoueurConvoque($numConvocation,$idJoueur) {
        $sql = 'INSERT INTO T_CONVOCATION_JOUEUR'
            . ' VALUES (NULL,?,?)';
        $this->executerRequete($sql,array($numConvocation,$idJoueur));
    }

    /**
     * Publie la convocation
     *
     * @param $numConvoc   L'identifiant de la convocaiton à publier.
     */
    public function publier($numConvoc) {
        $sql = 'UPDATE T_CONVOCATION'
            . ' SET Publie = TRUE'
            . ' WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numConvoc));
    }

    /**
     * Retire une convocation des convoations publiées.
     *
     * @param $numConvoc L'identifiant de la convocation à retirer des publications.
     */
    public function depublier($numConvoc) {
        $sql = 'UPDATE T_CONVOCATION'
            . ' SET Publie = FALSE'
            . ' WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numConvoc));
    }

    /**
     * Supprime une convocation.
     *
     * @param $numConvoc    L'identifiant de la convocation à supprimer.
     */
    public function supprimerConvocation($numConvoc) {
        $sql = 'DELETE FROM T_CONVOCATION'
            . ' WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numConvoc));
    }

    /**
     * Supprime toutes les convocations de joueurs à la convocation donnée.
     *
     * @param $numConvoc    L'identifiant de la convocation dont on supprime les joueurs associés.
     */
    public function supprimerJoueursConvoques($numConvoc) {
        $sql = 'DELETE FROM T_CONVOCATION_JOUEUR'
            . ' WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numConvoc));
    }

    /**
     * Supprimes toutes les convocations liées à un joueur.
     *
     * @param $idJoueur L'identifiant du joueur.
     */
    public function supprimerConvocationsJoueur($idJoueur) {
        $sql = 'DELETE FROM T_CONVOCATION_JOUEUR'
            . ' WHERE IdJoueur = ?';
        $this->executerRequete($sql, array($idJoueur));
    }

}