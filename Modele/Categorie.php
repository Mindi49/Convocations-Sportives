<?php

require_once 'Modele/Modele.php';

/**
 * Fournit les services d'accès aux catégories.
 */
class Categorie extends Modele {
    /**
     * Renvoie la liste des catégories.
     *
     * @return array La liste des catégories.
     */
    public function getCategories() {
        $sql = 'SELECT * FROM T_CATEGORIE ORDER BY Nom DESC';
        $categ = $this->executerRequete($sql);
        return $categ->fetchAll();
    }

    /**
     * Ajoute une catégorie.
     *
     * @param $nom          Le nom de la catégorie à ajouter.
     * @throws Exception    Exception lancée si une catégorie du même nom existe déjà.
     */
    public function ajouterCategorie($nom) {
        try {
            $sql = 'INSERT INTO T_CATEGORIE VALUES(?)';
            $this->executerRequete($sql, array($nom));
        }
        catch (Exception $e) {
            throw new Exception("La catégorie $nom existe déjà.");
        }
    }

    /**
     * Supprime une catégorie.
     *
     * @param $nom  Le nom de la catégorie à supprimer.
     */
    public function supprimerCategorie($nom) {
        $sql = 'DELETE FROM T_CATEGORIE WHERE Nom = ?';
        $this->executerRequete($sql, array($nom));
    }
}