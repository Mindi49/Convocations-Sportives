<?php

require_once 'Modele/Modele.php';

class Absence extends Modele {
    public function getAbsences() {
        $sql = 'SELECT A.IdJoueur as IdJoueur,Nom,Prenom,Date,Motif FROM T_JOUEUR J JOIN T_ABSENCE A ON J.IdJoueur = A.IdJoueur ORDER BY Date';
        $absence = $this->executerRequete($sql);
        return $absence->fetchAll();
    }

    public function isAbsent($idJoueur,$date) {
        $sql = 'SELECT *'
            . ' FROM T_ABSENCE'
            . ' WHERE IdJoueur = ? AND Date = ?';
        $absence = $this->executerRequete($sql, array($idJoueur,$date));
        if ($absence->rowCount() > 0) {
            return $absence->fetch();
        }
        else {
            return 0;
        }
    }

    public function ajouterAbsence($idJoueur,$date,$motif) {
        try {
            $sql = 'INSERT INTO T_ABSENCE VALUES(?,?,?)';
            $this->executerRequete($sql, array($idJoueur, $date, $motif));
        } catch (Exception $e) {
            throw new Exception("Une absence de ce joueur existe déjà pour cette date.");
        }
    }

    public function supprimerAbsence($idJoueur,$date) {
        $sql = 'DELETE FROM T_ABSENCE WHERE IdJoueur = ? and Date = ?';
        $this->executerRequete($sql, array($idJoueur, $date));
    }
}