<?php

require_once 'Modele/Modele.php';

class Convocation extends Modele {
    // recupère toutes les convocations
    public function getConvocations() {
        $sql = 'SELECT C.NumConvoc as NumConvoc, M.Categorie as Categorie, Competition,'
            . ' Equipe, EquipeAdverse, Date, Heure, Terrain, Site, J.IdJoueur as IdJoueur, Nom, Prenom, Licencie'
            . ' FROM (T_CONVOCATION C JOIN T_MATCH M ON C.NumMatch = M.NumMatch) JOIN T_JOUEUR J ON C.IdJoueur = J.IdJoueur';
        $convocationsMatch = $this->executerRequete($sql);
        return $convocationsMatch->fetchAll();
    }

    public function getConvocationsPubliees() {
        $sql = 'SELECT C.NumConvoc as NumConvoc, M.Categorie as Categorie, Competition,'
            . ' Equipe, EquipeAdverse, Date, Heure, Terrain, Site, J.IdJoueur as IdJoueur, Nom, Prenom, Licencie'
            . ' FROM (T_CONVOCATION C JOIN T_MATCH M ON C.NumMatch = M.NumMatch) JOIN T_JOUEUR J ON C.IdJoueur = J.IdJoueur WHERE Publie = TRUE';
        $convocationsMatch = $this->executerRequete($sql);
        return $convocationsMatch->fetchAll();
    }

    // récupère une convocation pour un joueur et un match
    public function getConvocation($numConvoc) {
        $sql = 'SELECT * FROM T_CONVOCATION'
            . ' WHERE NumConvoc = ?';
        $convocation = $this->executerRequete($sql, array($numConvoc));
        if ($convocation->rowCount() > 0)
            return $convocation->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun équipe ne correspond à cet id : '$numConvoc'");
    }

    // récupère les convocations pour un match donné
    public function getConvocationsMatch($numMatch) {
        $sql = 'SELECT * FROM T_CONVOCATION'
            . ' WHERE NumMatch = ?';
        $convocationsMatch = $this->executerRequete($sql, array($numMatch));
        return $convocationsMatch->fetchAll();
    }

    // récupère les convocations d'un joueur donné
    public function getConvocationsJoueur($idJoueur) {
        $sql = 'SELECT * FROM T_CONVOCATION'
            . ' WHERE IdJoueur = ?';
        $convocationsJoueur = $this->executerRequete($sql, array($idJoueur));
        return $convocationsJoueur->fetchAll();
    }

    public function ajouterConvocation($numMatch,$idJoueur) {
        $sql = 'INSERT INTO T_CONVOCATION(NumMatch,IdJoueur)'
            . ' VALUES(?,?)';
        $this->executerRequete($sql,array($numMatch,$idJoueur));
    }

    public function publier($numConvoc) {
        $sql = 'UPDATE T_CONVOCATION'
            . ' SET Publie = TRUE'
            . ' WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numConvoc));
    }
    public function supprimerConvocation($numConvoc) {
        $sql = 'DELETE FROM T_CONVOCATION'
            . ' WHERE NumConvoc = ?';
        $this->executerRequete($sql, array($numConvoc));
    }

    public function supprimerConvocationsMatch($numMatch) {
        $sql = 'DELETE FROM T_CONVOCATION'
            . ' WHERE NumMatch = ?';
        $this->executerRequete($sql, array($numMatch));
    }

    public function supprimerConvocationsJoueur($idJoueur) {
        $sql = 'DELETE FROM T_CONVOCATION'
            . ' WHERE IdJoueur = ?';
        $this->executerRequete($sql, array($idJoueur));
    }
}