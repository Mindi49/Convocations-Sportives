<?php

require_once 'Modele/Modele.php';

class Equipe extends Modele {
    public function getEquipes() {
        $sql = 'SELECT * FROM T_EQUIPE ORDER BY Nom';
        $compet = $this->executerRequete($sql);
        return $compet->fetchAll();
    }

    public function ajouterEquipe($nom) {
        try {
            $sql = 'INSERT INTO T_EQUIPE VALUES(?)';
            $this->executerRequete($sql, array($nom));
        } catch (Exception $e) {
            throw new Exception("L'équipe $nom existe déjà.");
        }
    }

    public function supprimerEquipe($nom) {
        $sql = 'DELETE FROM T_EQUIPE WHERE Nom = ?';
        $this->executerRequete($sql, array($nom));
    }
}