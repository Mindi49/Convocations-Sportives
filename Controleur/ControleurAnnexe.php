<?php

require_once 'Modele/Equipe.php';
require_once 'Modele/Competition.php';
require_once 'Modele/Categorie.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

class ControleurAnnexe extends ControleurSession {
    private $categorie;
    private $competition;
    private $equipe;

    public function __construct() {
        parent::__construct();
        $this->categorie = new Categorie();
        $this->competition = new Competition();
        $this->equipe = new Equipe();
    }

    public function annexe() {
        if (!$this->session->estConnecte()) {
            header("Location:index.php?action=afficherConnexion");
            return;
        }
        $categories = $this->categorie->getCategories();
        $competitions = $this->competition->getCompetitions();
        $equipes = $this->equipe->getEquipes();
        $vue = new Vue("Annexe");
        $vue->generer(array('categories' => $categories, 'competitions' => $competitions, 'equipes' => $equipes, 'role' => $this->session->getRole()));
    }

    public function supprimerCategorie($nom) {
        if ($this->session->estConnecte()) {
            $this->categorie->supprimerCategorie($nom);
            header("Location:index.php?action=annexe");
        } else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    public function ajouterCategorie($nom) {
        if ($this->session->estConnecte()) {
            $this->categorie->ajouterCategorie($nom);
            header("Location:index.php?action=annexe");
        } else {
            header("Location:index.php?action=afficherConnexion");
        }
    }


    public function supprimerCompetition($nom) {
        if ($this->session->estConnecte()) {

            $this->competition->supprimerCompetition($nom);
            header("Location:index.php?action=annexe");
        } else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    public function ajouterCompetition($nom) {
        if ($this->session->estConnecte()) {

            $this->competition->ajouterCompetition($nom);
            header("Location:index.php?action=annexe");
        } else {
            header("Location:index.php?action=afficherConnexion");
        }
    }


    public function supprimerEquipe($nom) {
        if ($this->session->estConnecte()) {

            $this->equipe->supprimerEquipe($nom);
            header("Location:index.php?action=annexe");
        } else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    public function ajouterEquipe($nom) {
        if ($this->session->estConnecte()) {

            $this->equipe->ajouterEquipe($nom);
            header("Location:index.php?action=annexe");
        } else {
            header("Location:index.php?action=afficherConnexion");
        }
    }
}