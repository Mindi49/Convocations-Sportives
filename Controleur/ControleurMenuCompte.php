<?php

require_once 'Modele/Joueur.php';
require_once 'Modele/Categorie.php';
require_once 'Vue/Vue.php';

class ControleurMenuCompte {
    private $joueur;
    private $categorie;


    public function __construct() {
        $this->joueur = new Joueur();
        $this->categorie = new Categorie();
    }

    public function menuCompte() {
        $joueurs = $this->joueur->getJoueurs();
        $licencies = $this->joueur->getJoueursLicencies();
        $nonlicencies = $this->joueur->getJoueursNonLicencies();
        $categories = $this->categorie->getCategories();
        $vue = new Vue("MenuCompte");
        $vue->generer(array('joueurs' => $joueurs, 'licencies' => $licencies, 'nonlicencies' => $nonlicencies, 'categories' => $categories));
    }


    public function supprimerJoueur($idJoueur) {
        $this->joueur->supprimerJoueur($idJoueur);
        header("Location:index.php?action=menuCompte");
    }

    public function ajouterJoueur($nom,$prenom,$categorie,$licencie) {
        $this->joueur->ajouterJoueur($nom,$prenom,$categorie,$licencie);
        header("Location:index.php?action=menuCompte");
    }

    public function ajouterLicence($idJoueur) {
        $this->joueur->ajouterLicence($idJoueur);
        header("Location:index.php?action=menuCompte");
    }


}