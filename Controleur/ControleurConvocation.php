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
        $vue->generer(array('convocations' => $convocations, 'convocationsPubliees' => $convocationsPubliees, 'joueurs' => $joueurs, 'matchs' => $matchs));
    }

    public function accesModifierConvocation($numConvoc) {
        $convocation = $this->convocation->getConvocation($numConvoc);
        $matchs = $this->match->getMatchs();
        $joueurs = $this->joueur->getJoueurs();
        $vue = new Vue("ModificationConvocation");
        var_dump($convocation);
        $vue->generer(array('convocation' => $convocation,'matchs' => $matchs, 'joueurs' => $joueurs));
    }

    public function modifierConvocation($numConvoc, $numMatch) {
        $this->convocation->modifierConvocation($numConvoc, $numMatch);
        header("Location:index.php?action=match");
    }
    public function ajouterConvocation($numMatch) {
        return $this->convocation->ajouterConvocation($numMatch);
    }

    public function ajouterJoueurConvoque ($numConvocation,$idJoueur) {
        $this->convocation->ajouterJoueurConvoque($numConvocation,$idJoueur);
    }

    public function supprimerConvocation($numConvocation) {
        $this->convocation->supprimerJoueursConvoques($numConvocation);
        $this->convocation->supprimerConvocation($numConvocation);
        header("Location:index.php?action=convocation");
    }

    public function supprimerConvocationsJoueur($idJoueur) {
        $this->convocation->supprimerConvocationsJoueur($idJoueur);
        header("Location:index.php?action=convocation");
    }

    public function supprimerJoueurConvoque($numConvocation,$idJoueur) {
        $this->convocation->supprimerJoueurConvoque($numConvocation,$idJoueur);
        header("Location:index.php?action=convocation");
    }

    public function supprimerJoueursConvoques($numConvocation) {
        $this->convocation->supprimerJoueurConvoques($numConvocation);
        header("Location:index.php?action=convocation");
    }

    public function publier($numConvocation) {
        $this->convocation->publier($numConvocation);
        header("Location:index.php?action=convocation");
    }
    public function depublier($numConvocation) {
        $this->convocation->depublier($numConvocation);
        header("Location:index.php?action=convocation");
    }
}