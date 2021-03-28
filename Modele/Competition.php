<?php

require_once 'Modele/Modele.php';

/**
 * Fournit les services d'accès aux compétitions.
 */
class Competition extends Modele {
    /**
     * Renvoie la liste des compétitions.
     *
     * @return array La liste des compétitions.
     */
    public function getCompetitions() {
        $sql = 'SELECT * FROM T_COMPETITION ORDER BY Nom ASC';
        $compet = $this->executerRequete($sql);
        return $compet->fetchAll();
    }

    /**
     * Ajoute une compétition.
     *
     * @param $nom          Le nom de la compétition à ajouter.
     * @throws Exception    Exception lancée si une compétition du même nom existe déjà.
     */
    public function ajouterCompetition($nom) {
        try {
            $sql = 'INSERT INTO T_COMPETITION VALUES(?)';
            $this->executerRequete($sql, array($nom));
        } catch (Exception $e) {
            throw new Exception("La compétition $nom existe déjà.");
        }
    }

    /**
     * Supprime une compétition.
     *
     * @param $nom  Le nom de la compétition à supprimer.
     */
    public function supprimerCompetition($nom) {
        $sql = 'DELETE FROM T_COMPETITION WHERE Nom = ?';
        $this->executerRequete($sql, array($nom));
    }

}