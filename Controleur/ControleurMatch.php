<?php

require_once 'Modele/Match.php';
require_once 'Modele/Equipe.php';
require_once 'Modele/Categorie.php';
require_once 'Modele/Competition.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

class ControleurMatch extends ControleurSession {
    private $match;
    private $categorie;
    private $competition;
    private $equipe;


    public function __construct() {
        parent::__construct();
        $this->match = new Match();
        $this->categorie = new Categorie();
        $this->competition = new Competition();
        $this->equipe = new Equipe();
    }

    public function match() {
        if (!$this->session->estConnecte()) {
            header("Location:index.php?action=afficherConnexion");
            return;
        }
        $matchs = $this->match->getMatchs();
        $categories = $this->categorie->getCategories();
        $competitions = $this->competition->getCompetitions();
        $equipes = $this->equipe->getEquipes();
        $vue = new Vue("Match");
        $vue->generer(array('matchs' => $matchs, 'categories' => $categories, 'competitions' => $competitions, 'equipes' => $equipes, 'role' => $this->session->getRole()));
    }

    public function supprimerMatch($numMatch) {
        if ($this->session->estSecretaire()) {
            $this->match->supprimerMatch($numMatch);
            header("Location:index.php?action=match");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=match");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }

    public function ajouterMatch($categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site) {
        if ($this->session->estSecretaire()) {
            $this->match->ajouterMatch($categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site);
            header("Location:index.php?action=match");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=match");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }

    public function accesModifierMatch($numMatch) {
        if ($this->session->estSecretaire()) {
            $match = $this->match->getMatch($numMatch);
            $categories = $this->categorie->getCategories();
            $competitions = $this->competition->getCompetitions();
            $equipes = $this->equipe->getEquipes();
            $vue = new Vue("ModificationMatch");
            $vue->generer(array('match' => $match,'categories' => $categories, 'competitions' => $competitions, 'equipes' => $equipes, 'role' => $this->session->getRole()));
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=match");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }

    public function modifierMatch($numMatch, $categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site) {
        if ($this->session->estSecretaire()) {
            $this->match->modifierMatch($numMatch, $categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site);
            header("Location:index.php?action=match");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=match");
        }
        else {
            header("Location:index.php?action=connexion");
        }

    }

}