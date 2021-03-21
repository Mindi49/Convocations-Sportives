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
        $licencies = $this->joueur->getJoueursLicencies();
        $nonlicencies = $this->joueur->getJoueursNonLicencies();
        $categories = $this->categorie->getCategories();
        $vue = new Vue("MenuCompte");
        $vue->generer(array('joueurs' => $joueurs, 'licencies' => $licencies, 'nonlicencies' => $nonlicencies, 'categories' => $categories, 'role' => $this->session->getRole(),'nomUtilisateur' => $this->session->getAttribut("nomUtilisateur")));
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
            header("Location:index.php?action=connexion");
        }
    }

    public function ajouterJoueur($nom,$prenom,$categorie,$licencie) {
        if ($this->session->estSecretaire()) {
            $this->joueur->ajouterJoueur($nom,$prenom,$categorie,$licencie);
            header("Location:index.php?action=menuCompte");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=menuCompte");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }

    public function ajouterLicence($idJoueur) {
        if ($this->session->estSecretaire()) {
            $this->joueur->ajouterLicence($idJoueur);
            header("Location:index.php?action=menuCompte");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=menuCompte");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }

    public function retirerLicence($idJoueur) {
        if ($this->session->estSecretaire()) {
            $this->joueur->retirerLicence($idJoueur);
            header("Location:index.php?action=menuCompte");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=menuCompte");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }


}