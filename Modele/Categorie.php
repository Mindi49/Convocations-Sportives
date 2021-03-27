<?php

require_once 'Modele/Modele.php';

class Categorie extends Modele {
    public function getCategories() {
        $sql = 'SELECT * FROM T_CATEGORIE ORDER BY Nom DESC';
        $categ = $this->executerRequete($sql);
        return $categ->fetchAll();
    }

    public function ajouterCategorie($nom) {
        try {
            $sql = 'INSERT INTO T_CATEGORIE VALUES(?)';
            $this->executerRequete($sql, array($nom));
        }
        catch (Exception $e) {
            throw new Exception("La catégorie $nom existe déjà.");
        }
    }

    public function supprimerCategorie($nom) {
        $sql = 'DELETE FROM T_CATEGORIE WHERE Nom = ?';
        $this->executerRequete($sql, array($nom));
    }
}