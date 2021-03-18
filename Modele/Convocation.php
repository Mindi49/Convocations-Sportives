<?php

require_once 'Modele/Modele.php';

class Convocation extends Modele {

    // récupère toutes les convocations
    public function getConvocations() {
        $sql = 'SELECT * FROM T_CONVOCATION C JOIN T_MATCH M ON M.NumMatch = C.NumMatch ';
        $convocationsMatch = $this->executerRequete($sql);
        return $convocationsMatch->fetchAll();
    }

    // récupère toutes les convocations publiées
     public function getConvocationsPubliees() {
         $sql = 'SELECT * FROM T_CONVOCATION C JOIN T_MATCH M ON M.NumMatch = C.NumMatch WHERE Publie = TRUE';
         $convocationsMatch = $this->executerRequete($sql);
         return $convocationsMatch->fetchAll();
     }

     // récupère une convocation
    public function getConvocation($numConvoc) {
        $sql = 'SELECT * FROM T_CONVOCATION JOIN T_MATCH'
            . ' WHERE NumConvoc = ?';
        $convocation = $this->executerRequete($sql, array($numConvoc));
        if ($convocation->rowCount() > 0)
            return $convocation->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun équipe ne correspond à cet id : '$numConvoc'");
    }

    // récupère tous les joueurs convoqués à un match
     public function getJoueursConvoques($numConvoc) {
        $sql = 'SELECT * FROM T_CONVOCATION_JOUEUR JOIN T_JOUEUR '
            . ' WHERE NumConvoc = ?';
        $convocationsMatch = $this->executerRequete($sql, array($numConvoc));
        return $convocationsMatch->fetchAll();
    }

    // récupère toutes les convocations pour un joueur
     public function getConvocationsJoueur($idJoueur) {
        $sql = 'SELECT NumConvoc, NumMatch, Publie FROM'
            . ' T_CONVOCATION JOIN T_CONVOCATION_JOUEUR '
            . ' WHERE IdJoueur = ?';
        $convocationsJoueur = $this->executerRequete($sql, array($idJoueur));
        return $convocationsJoueur->fetchAll();
    }


    // ajoute une convocation pour un match
     public function ajouterConvocation($numMatch) {
        $sql = 'INSERT INTO T_CONVOCATION(NumMatch)'
            . ' VALUES(?)';
        $this->executerRequete($sql,array($numMatch));
        return $this->getLastInsertID();
    }

    // ajoute un joueur dans les joueurs convoqués au match
    public function ajouterJoueurConvoque($numConvocation,$idJoueur) {
        $sql = 'INSERT INTO T_CONVOCATION_JOUEUR'
            . ' VALUES(?,?)';
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

    // supprime une convocation pour un match
    public function supprimerConvocation($numConvoc) {
        $sql = 'DELETE FROM T_CONVOCATION'
            . ' WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numConvoc));
    }

    // supprime tous les joueurs convoqués à la convocation donnée
    public function supprimerJoueursConvoques($numConvoc) {
        $sql = 'DELETE FROM T_CONVOCATION_JOUEUR'
            . ' WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numConvoc));
    }

    // supprimer une convocation d'un joueur pour un match
     public function supprimerJoueurConvoque($numConvoc,$idJoueur) {
        $sql = 'DELETE FROM T_CONVOCATION_JOUEUR'
            . ' WHERE NumConvoc = ? AND IdJoueur = ?';
        $this->executerRequete($sql, array($numConvoc,$idJoueur));
    }

    // supprime un joueur de toutes les convocations
    public function supprimerConvocationsJoueur($idJoueur) {
        $sql = 'DELETE FROM T_CONVOCATION_JOUEUR'
            . ' WHERE IdJoueur = ?';
        $this->executerRequete($sql, array($idJoueur));
    }

}