<?php

require_once 'Modele/Equipe.php';
require_once 'Modele/Competition.php';
require_once 'Modele/Categorie.php';
require_once 'Modele/Convocation.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

/**
 * Contrôleur des actions liées à la page d'accueil, accessible de tous.
 */
class ControleurAccueil extends ControleurSession {
    /** Les modèles fournissant les différents services d'accès */
    private $competition;
    private $equipe;
    private $categorie;
    private $convocation;

    /**
     * Constructeur qui instancie les modèles.
     */
    public function __construct() {
        parent::__construct();
        $this->competition = new Competition();
        $this->equipe = new Equipe();
        $this->convocation = new Convocation();
        $this->categorie = new Categorie();
    }

    /**
     * Récupère les données nécessaires à l'affichage de la vue.
     * Affiche la vue de la page d'accueil du site.
     */
    public function accueil() {
        $competitions = $this->competition->getCompetitions();
        $equipes = $this->equipe->getEquipes();
        $convocations = $this->convocation->getConvocations();
        $convocationsPubliees = $this->convocation->getConvocationsPubliees();
        $categories = $this->categorie->getCategories();

        $vue = new Vue("Accueil");

        $vue->generer(array('categories' => $categories, 'competitions' => $competitions, 'equipes' => $equipes, 'convocations' => $convocations, 'convocationsPubliees' => $convocationsPubliees, 'role' => $this->session->getRole()));
    }

}