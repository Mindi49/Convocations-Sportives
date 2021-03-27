<?php

require_once 'Modele/Joueur.php';
require_once 'Modele/Categorie.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

class ControleurMenuCompte extends ControleurSession {
    private $joueur;
    private $categorie;

    public function __construct() {
        parent::__construct();
        $this->joueur = new Joueur();
        $this->categorie = new Categorie();
    }

    public function menuCompte() {
        if (!$this->session->estConnecte()) {
            header("Location:index.php?action=afficherConnexion");
            return;
        }
        $joueurs = $this->joueur->getJoueurs();
        $categories = $this->categorie->getCategories();
        $vue = new Vue("MenuCompte");
        $vue->generer(array('joueurs' => $joueurs, 'categories' => $categories, 'role' => $this->session->getRole(),'nomUtilisateur' => $this->session->getAttribut("nomUtilisateur")));
    }

    public function supprimerJoueur($idJoueur) {
        if ($this->session->estSecretaire()) {
            $this->joueur->supprimerJoueur($idJoueur);
            header("Location:index.php?action=menuCompte");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=menuCompte");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    public function ajouterJoueur($nom,$prenom,$categorie,$licence) {
        if ($this->session->estSecretaire()) {
            $this->joueur->ajouterJoueur($nom,$prenom,$categorie,$licence);
            header("Location:index.php?action=menuCompte");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=menuCompte");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }
}