<?php
require_once 'Modele/Modele.php';

class Joueur extends Modele {
    public function getJoueurs() {
        $sql = 'SELECT *'
            . ' FROM T_JOUEUR'
            . ' ORDER BY Prenom, Nom';
        $effectifs = $this->executerRequete($sql);
        return $effectifs->fetchAll();
    }

    public function ajouterJoueur($nom, $prenom, $categorie, $licence='Libre') {
        try {
            $sql = 'INSERT INTO T_JOUEUR(Nom,Prenom,Categorie,Licence)'
                . ' VALUES(?, ?, ?, ?)';
            $this->executerRequete($sql, array($nom, $prenom, $categorie, $licence));
        } catch (Exception $e) {
            throw new Exception("$prenom $nom existe déjà avec les mêmes catactéristiques.");
        }
    }

    public function supprimerJoueur($idJoueur) {
        $sql = 'DELETE FROM T_JOUEUR'
            . ' WHERE (IdJoueur = ?)';
        $this->executerRequete($sql, array($idJoueur));
    }
}