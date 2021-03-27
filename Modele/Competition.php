<?php

require_once 'Modele/Modele.php';

class Competition extends Modele {
    public function getCompetitions() {
        $sql = 'SELECT * FROM T_COMPETITION ORDER BY Nom ASC';
        $compet = $this->executerRequete($sql);
        return $compet->fetchAll();
    }

    public function ajouterCompetition($nom) {
        try {
            $sql = 'INSERT INTO T_COMPETITION VALUES(?)';
            $this->executerRequete($sql, array($nom));
        } catch (Exception $e) {
            throw new Exception("La compétition $nom existe déjà.");
        }
    }

    public function supprimerCompetition($nom) {
        $sql = 'DELETE FROM T_COMPETITION WHERE Nom = ?';
        $this->executerRequete($sql, array($nom));
    }

}