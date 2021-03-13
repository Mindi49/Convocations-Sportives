<?php

require_once 'Modele/Convocation.php';
require_once 'Modele/Match.php';
require_once 'Modele/Joueur.php';
require_once 'Vue/Vue.php';

class ControleurConvocation {
    private $convocation;
    private $match;
    private $joueur;

    public function __construct() {
        $this->convocation = new Convocation();
        $this->match = new Match();
        $this->joueur = new Joueur();
    }


    public function convocation() {
        $convocations = $this->convocation->getConvocations();
        $convocationsPubliees = $this->convocation->getConvocationsPubliees();
        $matchs = $this->match->getMatchs();
        $joueurs = $this->joueur->getJoueurs();
        $vue = new Vue("Convocation");
        $vue->generer(array('convocations' => $convocations, 'convocationsPubliees' => $convocationsPubliees, 'matchs' => $matchs, 'joueurs' => $joueurs));
    }


    public function ajouterConvocation($numMatch,$idJoueur) {
        $this->convocation->ajouterConvocation($numMatch,$idJoueur);
        header("Location:index.php?action=convocation");
    }

    public function supprimerConvocation($numConvocation) {
        $this->convocation->supprimerConvocation($numConvocation);
        header("Location:index.php?action=convocation");
    }

    public function supprimerConvocationsMatch($numMatch) {
        $this->convocation->supprimerConvocationsMatch($numMatch);
        header("Location:index.php?action=convocation");
    }

    public function supprimerConvocationsJoueur($idJoueur) {
        $this->convocation->supprimerConvocationsJoueur($idJoueur);
        header("Location:index.php?action=convocation");
    }
}