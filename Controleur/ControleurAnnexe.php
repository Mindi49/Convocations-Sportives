<?php

require_once 'Modele/Equipe.php';
require_once 'Modele/Competition.php';
require_once 'Modele/Categorie.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

/**
 * Contrôleur des actions liées à la page annexe.
 */
class ControleurAnnexe extends ControleurSession {
    /** Les modèles fournissant les différents services d'accès */
    private $categorie;
    private $competition;
    private $equipe;

    /**
     * Constructeur qui intancie les modèles.
     */
    public function __construct() {
        parent::__construct();
        $this->categorie = new Categorie();
        $this->competition = new Competition();
        $this->equipe = new Equipe();
    }

    /**
     * Récupère les données nécessaires à l'affichage de la vue.
     * Affiche la vue de la page annexe.
     *
     * Si l'utilisateur n'est pas connecté, redirige vers la page de connexion.
     */
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

    /**
     * Supprime une catégorie.
     *
     * Si l'utilisateur n'est pas connecté, redirige vers la page de connexion.
     *
     * @param $nom  Le nom de la catégorie à supprimer.
     */
    public function supprimerCategorie($nom) {
        if ($this->session->estConnecte()) {
            $this->categorie->supprimerCategorie($nom);
            header("Location:index.php?action=annexe");
        } else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    /**
     * Ajoute une catégorie.
     *
     * Si l'utilisateur n'est pas connecté, redirige vers la page de connexion.
     *
     * @param $nom          La catégorie à ajouter.
     * @throws Exception    Exception lancée si la catégorie est déjà présente.
     */
    public function ajouterCategorie($nom) {
        if ($this->session->estConnecte()) {
            $this->categorie->ajouterCategorie($nom);
            header("Location:index.php?action=annexe");
        } else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    /**
     * Supprime une compétition.
     *
     * Si l'utilisateur n'est pas connecté, redirige vers la page de connexion.
     *
     * @param $nom  Le nom de la compétition à supprimer.
     */
    public function supprimerCompetition($nom) {
        if ($this->session->estConnecte()) {

            $this->competition->supprimerCompetition($nom);
            header("Location:index.php?action=annexe");
        } else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    /**
     * Ajoute une compétition.
     *
     * Si l'utilisateur n'est pas connecté, redirige vers la page de connexion.
     *
     * @param $nom          La compétition à ajouter.
     * @throws Exception    Exception lancée si la compétition est déjà présente.
     */
    public function ajouterCompetition($nom) {
        if ($this->session->estConnecte()) {

            $this->competition->ajouterCompetition($nom);
            header("Location:index.php?action=annexe");
        } else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    /**
     * Supprime une équipe.
     *
     * Si l'utilisateur n'est pas connecté, redirige vers la page de connexion.
     *
     * @param $nom  Le nom de l'équipe à supprimer.
     */
    public function supprimerEquipe($nom) {
        if ($this->session->estConnecte()) {

            $this->equipe->supprimerEquipe($nom);
            header("Location:index.php?action=annexe");
        } else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    /**
     * Ajoute une équipe.
     *
     * Si l'utilisateur n'est pas connecté, redirige vers la page de connexion.
     *
     * @param $nom          L'équipe à ajouter.
     * @throws Exception    Exception lancée si la équipe est déjà présente.
     */
    public function ajouterEquipe($nom) {
        if ($this->session->estConnecte()) {

            $this->equipe->ajouterEquipe($nom);
            header("Location:index.php?action=annexe");
        } else {
            header("Location:index.php?action=afficherConnexion");
        }
    }
}