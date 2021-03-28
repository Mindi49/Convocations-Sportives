<?php

require_once 'Modele/Modele.php';

/**
 * Fournit les services d'accès aux équipes.
 */
class Equipe extends Modele {
    /**
     * Renvoie la liste des équipes.
     *
     * @return array La liste des équipes.
     */
    public function getEquipes() {
        $sql = 'SELECT * FROM T_EQUIPE ORDER BY Nom';
        $compet = $this->executerRequete($sql);
        return $compet->fetchAll();
    }

    /**
     * Ajoute une équipe.
     *
     * @param $nom          Le nom de l'équipe à ajouter.
     * @throws Exception    Exception lancée si une équipe du même nom existe déjà.
     */
    public function ajouterEquipe($nom) {
        try {
            $sql = 'INSERT INTO T_EQUIPE VALUES(?)';
            $this->executerRequete($sql, array($nom));
        } catch (Exception $e) {
            throw new Exception("L'équipe $nom existe déjà.");
        }
    }

    /**
     * Supprime une équipe.
     *
     * @param $nom  Le nom de l'équipe à supprimer.
     */
    public function supprimerEquipe($nom) {
        $sql = 'DELETE FROM T_EQUIPE WHERE Nom = ?';
        $this->executerRequete($sql, array($nom));
    }
}