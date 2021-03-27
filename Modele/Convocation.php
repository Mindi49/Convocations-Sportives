<?php

require_once 'Modele/Modele.php';

class Convocation extends Modele {
    public function getConvocations() {
        $sql = 'SELECT * FROM T_CONVOCATION C JOIN T_MATCH M ON M.NumMatch = C.NumMatch ORDER BY Date, Equipe';
        $convocationsMatch = $this->executerRequete($sql);
        return $convocationsMatch->fetchAll();
    }

     public function getConvocationsPubliees() {
         $sql = 'SELECT * FROM T_CONVOCATION C JOIN T_MATCH M ON M.NumMatch = C.NumMatch WHERE Publie = TRUE ORDER BY Date,Equipe';
         $convocationsMatch = $this->executerRequete($sql);
         return $convocationsMatch->fetchAll();
     }

    public function getConvocation($numConvoc) {
        $sql = 'SELECT * FROM T_CONVOCATION C JOIN T_MATCH M ON M.NumMatch = C.NumMatch'
            . ' WHERE NumConvoc = ?';
        $convocation = $this->executerRequete($sql, array($numConvoc));
        if ($convocation->rowCount() > 0) {
            return $convocation->fetch(PDO::FETCH_ASSOC);  // Accès à la première ligne de résultat
        }
        else {
            throw new Exception("La convocation demandée n'existe pas ou a été supprimée.");
        }
    }

     public function getJoueursConvoques($numConvoc) {
         $sql = 'SELECT * FROM T_CONVOCATION_JOUEUR C JOIN T_JOUEUR J ON C.IdJoueur = J.IdJoueur '
             . ' WHERE NumConvoc = ? ORDER BY NumConvocJoueur ASC';
         $convocationsMatch = $this->executerRequete($sql, array($numConvoc));
         return $convocationsMatch->fetchAll();
     }

    public function getNbJoueursConvoques($numConvoc) {
        $sql = 'SELECT Count(*) as NbJoueurs FROM T_CONVOCATION_JOUEUR '
            . ' WHERE NumConvoc = ?';
        $convocationsMatch = $this->executerRequete($sql, array($numConvoc));
        if ($convocationsMatch->rowCount() > 0) {
            return $convocationsMatch->fetch(PDO::FETCH_ASSOC);  // Accès à la première ligne de résultat
        }
        else {
            return 0;
        }
    }

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

    public function getJoueursNonConvocables($numConvoc) {
        $sql = 'SELECT * FROM T_JOUEUR'
            . ' WHERE IdJoueur IN '
            . '(SELECT IdJoueur FROM T_ABSENCE'
            . ' WHERE Date = (SELECT Date FROM T_CONVOCATION C JOIN T_MATCH M ON C.NumMatch = M.NumMatch WHERE NumConvoc = ?))'
            . ' OR IdJoueur IN '
            . '(SELECT CJ.IdJoueur'
            . ' FROM (T_CONVOCATION_JOUEUR CJ JOIN T_CONVOCATION C ON CJ.NumConvoc = C.NumConvoc) JOIN T_MATCH M ON C.NumMatch = M.NumMatch '
            . 'WHERE C.NumConvoc <> ? AND Date = (SELECT Date FROM T_CONVOCATION C JOIN T_MATCH M ON C.NumMatch = M.NumMatch WHERE NumConvoc = ?))';
        $convocationsMatch = $this->executerRequete($sql, array($numConvoc,$numConvoc,$numConvoc));
        return $convocationsMatch->fetchAll();
    }

    public function getMatchsConvocables () {
        $sql = 'SELECT * FROM T_MATCH WHERE NumMatch NOT IN (SELECT NumMatch FROM T_CONVOCATION) ORDER BY Date,Equipe';
        $convocationsMatch = $this->executerRequete($sql, array());
        return $convocationsMatch->fetchAll();

    }

     public function ajouterConvocation($numMatch) {
        $sql = 'INSERT INTO T_CONVOCATION (NumMatch)'
            . ' VALUES (?)';
        $this->executerRequete($sql,array($numMatch));
        return $this->getLastInsertID();
    }

    public function ajouterJoueurConvoque($numConvocation,$idJoueur) {
        $sql = 'INSERT INTO T_CONVOCATION_JOUEUR'
            . ' VALUES (NULL,?,?)';
        $this->executerRequete($sql,array($numConvocation,$idJoueur));
    }

    public function publier($numConvoc) {
        $sql = 'UPDATE T_CONVOCATION'
            . ' SET Publie = TRUE'
            . ' WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numConvoc));
    }

    public function depublier($numConvoc) {
        $sql = 'UPDATE T_CONVOCATION'
            . ' SET Publie = FALSE'
            . ' WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numConvoc));
    }

    public function supprimerConvocation($numConvoc) {
        $sql = 'DELETE FROM T_CONVOCATION'
            . ' WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numConvoc));
    }

    public function supprimerJoueursConvoques($numConvoc) {
        $sql = 'DELETE FROM T_CONVOCATION_JOUEUR'
            . ' WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numConvoc));
    }

     public function supprimerJoueurConvoque($numConvoc,$idJoueur) {
        $sql = 'DELETE FROM T_CONVOCATION_JOUEUR'
            . ' WHERE NumConvoc = ? AND IdJoueur = ?';
        $this->executerRequete($sql, array($numConvoc,$idJoueur));
    }

    public function supprimerConvocationsJoueur($idJoueur) {
        $sql = 'DELETE FROM T_CONVOCATION_JOUEUR'
            . ' WHERE IdJoueur = ?';
        $this->executerRequete($sql, array($idJoueur));
    }

    public function modifierConvocation($numConvoc, $numMatch) {
        $sql = 'UPDATE T_CONVOCATION'
            . ' SET NumMatch = ? WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numMatch,$numConvoc));
    }

}