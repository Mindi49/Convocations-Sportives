<?php

require_once 'Modele/Convocation.php';
require_once 'Modele/Match.php';
require_once 'Modele/Joueur.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

class ControleurConvocation extends ControleurSession {
    private $convocation;
    private $match;
    private $joueur;

    public function __construct() {
        parent::__construct();
        $this->convocation = new Convocation();
        $this->match = new Match();
        $this->joueur = new Joueur();
    }


    public function convocation() {
        if (!$this->session->estConnecte()) {
            header("Location:index.php?action=afficherConnexion");
            return;
        }
        $convocations = $this->convocation->getConvocations();
        $convocationsPubliees = $this->convocation->getConvocationsPubliees();
        $matchs = $this->match->getMatchs();
        $joueurs = $this->joueur->getJoueurs();
        $vue = new Vue("Convocation");
        $vue->generer(array('convocations' => $convocations, 'convocationsPubliees' => $convocationsPubliees, 'joueurs' => $joueurs, 'matchs' => $matchs, 'role' => $this->session->getRole()));
    }

    public function accesModifierConvocation($numConvoc) {
        if ($this->session->estEntraineur()) {
            $convocation = $this->convocation->getConvocation($numConvoc);
            $matchs = $this->match->getMatchs();
            $joueursConvoques = $this->convocation->getJoueursConvoques($numConvoc);
            $joueurs = $this->joueur->getJoueurs();
            $vue = new Vue("ModificationConvocation");
            $vue->generer(array('convocation' => $convocation, 'matchs' => $matchs, 'joueurs' => $joueurs, 'joueursConvoques' => $joueursConvoques,'role' => $this->session->getRole()));
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }
    public function informationsConvocation($numConvoc) {
        $convocation = $this->convocation->getConvocation($numConvoc);
        $joueursConvoques = $this->convocation->getJoueursConvoques($numConvoc);
        $vue = new Vue("InformationsConvocation");
        $vue->generer(array('convocation' => $convocation, 'joueursConvoques' => $joueursConvoques, 'role' => $this->session->getRole()));
    }

    public function modifierConvocation($numConvoc, $numMatch) {
        if ($this->session->estEntraineur()) {
            $this->convocation->modifierConvocation($numConvoc, $numMatch);
            header("Location:index.php?action=convocation");
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=connexion");
        }

    }
    public function ajouterConvocation($numMatch) {
        if ($this->session->estEntraineur()) {
            return $this->convocation->ajouterConvocation($numMatch);
            header("Location:index.php?action=convocation");
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }

    public function ajouterJoueurConvoque ($numConvocation,$idJoueur) {
        $this->convocation->ajouterJoueurConvoque($numConvocation,$idJoueur);
    }

    public function supprimerConvocation($numConvocation) {
        if ($this->session->estEntraineur()) {
            $this->convocation->supprimerJoueursConvoques($numConvocation);
            $this->convocation->supprimerConvocation($numConvocation);
            header("Location:index.php?action=convocation");
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=connexion");
        }

    }

    public function supprimerConvocationsJoueur($idJoueur) {
        if ($this->session->estEntraineur()) {
            $this->convocation->supprimerConvocationsJoueur($idJoueur);
            header("Location:index.php?action=convocation");
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }

    public function supprimerJoueurConvoque($numConvocation,$idJoueur) {
        if ($this->session->estEntraineur()) {
            $this->convocation->supprimerJoueurConvoque($numConvocation,$idJoueur);
            header("Location:index.php?action=convocation");
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }

    public function supprimerJoueursConvoques($numConvocation) {
        if ($this->session->estEntraineur()) {
            $this->convocation->supprimerJoueursConvoques($numConvocation);
            header("Location:index.php?action=convocation");
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }

    public function publier($numConvocation) {
        if ($this->session->estEntraineur()) {
            $this->convocation->publier($numConvocation);
            header("Location:index.php?action=convocation");
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }
    public function depublier($numConvocation) {
        if ($this->session->estEntraineur()) {
            $this->convocation->depublier($numConvocation);
            header("Location:index.php?action=convocation");
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=connexion");
        }
    }
}