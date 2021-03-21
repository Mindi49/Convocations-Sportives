<?php

require_once 'Modele/Equipe.php';
require_once 'Modele/Competition.php';
require_once 'Modele/Categorie.php';
require_once 'Modele/Convocation.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

class ControleurAccueil extends ControleurSession {
    private $competition;
    private $equipe;
    private $categorie;
    private $convocation;


    public function __construct() {
        parent::__construct();
        $this->competition = new Competition();
        $this->equipe = new Equipe();
        $this->convocation = new Convocation();
        $this->categorie = new Categorie();
    }


    public function accueil($erreurs = array()) {
        $competitions = $this->competition->getCompetitions();
        $equipes = $this->equipe->getEquipes();
        $convocations = $this->convocation->getConvocations();
        $convocationsPubliees = $this->convocation->getConvocationsPubliees();
        $categories = $this->categorie->getCategories();

        $vue = new Vue("Accueil");

        $vue->generer(array('categories' => $categories, 'competitions' => $competitions, 'equipes' => $equipes, 'convocations' => $convocations, 'convocationsPubliees' => $convocationsPubliees, 'erreurs' => $erreurs, 'role' => $this->session->getRole()));
    }



    public function supprimerCategorie($nom) {
        $this->categorie->supprimerCategorie($nom);
        header("Location:index.php");
    }
    public function ajouterCategorie($nom) {
        $this->categorie->ajouterCategorie($nom);
        header("Location:index.php");
    }


    public function supprimerCompetition($nom) {
        $this->competition->supprimerCompetition($nom);
        header("Location:index.php");
    }
    public function ajouterCompetition($nom) {
        $this->competition->ajouterCompetition($nom);
        header("Location:index.php");
    }


    public function supprimerEquipe($nom) {
        $this->equipe->supprimerEquipe($nom);
        header("Location:index.php");
    }
    public function ajouterEquipe($nom) {
        $this->equipe->ajouterEquipe($nom);
        header("Location:index.php");
    }

}