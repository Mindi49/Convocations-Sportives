<?php

require_once 'Modele/Modele.php';

class Absence extends Modele {
    // recupère une absence donnée
    public function getAbsence($idJoueur,$date) {
        $sql = 'SELECT *'
            . ' FROM T_ABSENCE'
            . ' WHERE IdJoueur = ? and Date = ?' ;
        $absence = $this->executerRequete($sql, array($idJoueur,$date));
        if ($absence->rowCount() > 0)
            return $absence->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucune absence pour ce joueur à cette date ( '$idJoueur' - '$date'");
    }

    // recupère toutes les absences d'un joueur
    public function getAbsencesJoueur($idJoueur) {
        $sql = 'SELECT *'
            . ' FROM T_ABSENCE'
            . ' WHERE IdJoueur = ?' ;
        $absence = $this->executerRequete($sql, array($idJoueur));
        return $absence->fetchAll();
    }

    // récupère tous les absents à une date donnée
    public function getAbsencesDate($date) {
        $sql = 'SELECT *'
            . ' FROM T_ABSENCE'
            . ' WHERE Date = ?' ;
        $absence = $this->executerRequete($sql, array($date));
        $absence->fetchAll();
    }

    public function getAbsences() {
        $sql = 'SELECT A.IdJoueur as IdJoueur,Nom,Prenom,Date,Motif FROM T_JOUEUR J JOIN T_ABSENCE A ON J.IdJoueur = A.IdJoueur ORDER BY Date';
        $absence = $this->executerRequete($sql);
        return $absence->fetchAll();
    }

    public function ajouterAbsence($idJoueur,$date,$motif) {
        $sql = 'INSERT INTO T_ABSENCE VALUES(?,?,?)';
        $this->executerRequete($sql, array($idJoueur,$date,$motif));
    }

    public function supprimerAbsence($idJoueur,$date) {
        $sql = 'DELETE FROM T_ABSENCE WHERE IdJoueur = ? and Date = ?';
        $this->executerRequete($sql, array($idJoueur, $date));
    }
}