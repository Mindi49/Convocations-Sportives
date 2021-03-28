<?php
require_once 'Modele/Modele.php';

/**
 * Fournit les services d'accès aux joueurs.
 */
class Joueur extends Modele {
    /**
     * Renvoie la liste des joueurs.
     *
     * @return array La liste des joueurs.
     */
    public function getJoueurs() {
        $sql = 'SELECT *'
            . ' FROM T_JOUEUR'
            . ' ORDER BY Prenom, Nom';
        $effectifs = $this->executerRequete($sql);
        return $effectifs->fetchAll();
    }

    /**
     * Ajoute un joueur au club.
     *
     * @param $nom              Le nom du joueur.
     * @param $prenom           Le prénom du joueur.
     * @param $categorie        La catégorie dans laquelle sera inscrit le joueur.
     * @param string $licence   Le type de licence du joueur.
     * @throws Exception        Exception lancée si le joueur est déjà présent.
     */
    public function ajouterJoueur($nom, $prenom, $categorie, $licence='Libre') {
        try {
            $sql = 'INSERT INTO T_JOUEUR(Nom,Prenom,Categorie,Licence)'
                . ' VALUES(?, ?, ?, ?)';
            $this->executerRequete($sql, array($nom, $prenom, $categorie, $licence));
        } catch (Exception $e) {
            throw new Exception("$prenom $nom existe déjà avec les mêmes catactéristiques.");
        }
    }

    /**
     * Supprime un joueur.
     *
     * @param $idJoueur L'identifiant du joueur à supprimer.
     */
    public function supprimerJoueur($idJoueur) {
        $sql = 'DELETE FROM T_JOUEUR'
            . ' WHERE (IdJoueur = ?)';
        $this->executerRequete($sql, array($idJoueur));
    }
}