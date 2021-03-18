<?php

require_once 'Modele/Match.php';
require_once 'Modele/Equipe.php';
require_once 'Modele/Categorie.php';
require_once 'Modele/Competition.php';
require_once 'Vue/Vue.php';

class ControleurMatch
{
    private $match;
    private $categorie;
    private $competition;
    private $equipe;


    public function __construct()
    {
        $this->match = new Match();
        $this->categorie = new Categorie();
        $this->competition = new Competition();
        $this->equipe = new Equipe();
    }

    public function match() {
        $matchs = $this->match->getMatchs();
        $categories = $this->categorie->getCategories();
        $competitions = $this->competition->getCompetitions();
        $equipes = $this->equipe->getEquipes();
        $vue = new Vue("Match");
        $vue->generer(array('matchs' => $matchs, 'categories' => $categories, 'competitions' => $competitions, 'equipes' => $equipes));
    }

    public function supprimerMatch($numMatch) {
        $this->match->supprimerMatch($numMatch);
        header("Location:index.php?action=match");
    }

    public function ajouterMatch($categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site) {
        $this->match->ajouterMatch($categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site);
        header("Location:index.php?action=match");
    }

    public function accesModifierMatch($numMatch) {
        $match = $this->match->getMatch($numMatch);
        $vue = new Vue("ModificationMatch");
        $vue->generer(array('match' => $match));
    }

    public function modifierMatch($numMatch, $categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site) {
        $this->match->modifierMatch($numMatch, $categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site);
        header("Location:index.php?action=match");
    }

}