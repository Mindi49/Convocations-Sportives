<?php

require_once 'Modele/Modele.php';

class Competition extends Modele {

    public function getCompetitions() {
        $sql = 'SELECT * FROM T_COMPETITION ORDER BY Nom ASC';
        $compet = $this->executerRequete($sql);
        return $compet->fetchAll();
    }
    public function ajouterCompetition($nom) {
        $sql = 'INSERT INTO T_COMPETITION VALUES(?)';
        $this->executerRequete($sql, array($nom));
    }

    public function supprimerCompetition($nom) {
        $sql = 'DELETE FROM T_COMPETITION WHERE Nom = ?';
        $this->executerRequete($sql, array($nom));
    }

}