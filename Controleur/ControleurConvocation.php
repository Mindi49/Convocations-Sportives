<?php

require_once 'Modele/Convocation.php';
require_once 'Modele/Absence.php';
require_once 'Modele/Match.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

class ControleurConvocation extends ControleurSession {
    private $convocation;
    private $match;
    private $absence;

    public function __construct() {
        parent::__construct();
        $this->convocation = new Convocation();
        $this->match = new Match();
        $this->absence = new Absence();
    }

    public function convocation() {
        if (!$this->session->estConnecte()) {
            header("Location:index.php?action=afficherConnexion");
            return;
        }

        $convocations = $this->convocation->getConvocations();
        foreach ($convocations as &$c) {
            $c = array_merge($c, $this->convocation->getNbJoueursConvoques($c['NumConvoc']));
        }
        $convocationsPubliees = $this->convocation->getConvocationsPubliees();
        $matchsConvocables = $this->convocation->getMatchsConvocables();
        $vue = new Vue("Convocation");
        $vue->generer(array('convocations' => $convocations, 'convocationsPubliees' => $convocationsPubliees, 'matchsConvocables' => $matchsConvocables, 'role' => $this->session->getRole()));
    }

    public function accesModifierConvocation($numConvoc) {
        if ($this->session->estEntraineur()) {
            $convocation = $this->convocation->getConvocation($numConvoc);
            $matchConvoc = $this->match->getMatch($convocation['NumMatch']);
            $matchsConvocables = $this->convocation->getMatchsConvocables();
            $joueursConvocables = $this->convocation->getJoueursConvocables($numConvoc);
            $joueursNonConvocables = $this->convocation->getJoueursNonConvocables($numConvoc);
            foreach ($joueursNonConvocables as &$nc) {
                $abs = $this->absence->isAbsent($nc['IdJoueur'],$matchConvoc['Date']);
                if ($abs) {
                    $nc = array_merge($nc, $abs);
                }
                else {
                    $nc['Motif'] = "Déjà convoqué";
                }
            }
            $joueursConvoques = $this->convocation->getJoueursConvoques($numConvoc);
            $vue = new Vue("ModificationConvocation");
            $vue->generer(array('convocation' => $convocation, 'matchsConvocables' => $matchsConvocables, 'joueursConvoques' => $joueursConvoques, 'joueursConvocables' => $joueursConvocables, 'joueursNonConvocables' => $joueursNonConvocables, 'matchConvoc' => $matchConvoc,'role' => $this->session->getRole()));
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    public function informationsConvocation($numConvoc) {
        $convocation = $this->convocation->getConvocation($numConvoc);
        $joueursConvoques = $this->convocation->getJoueursConvoques($numConvoc);
        $vue = new Vue("InformationsConvocation");
        $vue->generer(array('convocation' => $convocation, 'joueursConvoques' => $joueursConvoques, 'role' => $this->session->getRole()));
    }

    public function modifierConvocation($numConvoc, $numMatch,$ensIdJoueur) {
        if ($this->session->estEntraineur()) {
            $this->convocation->supprimerJoueursConvoques($numConvoc);
            foreach ($ensIdJoueur as $idJoueur) {
                $this->convocation->ajouterJoueurConvoque($numConvoc, $idJoueur);
            }
            $this->convocation->modifierConvocation($numConvoc, $numMatch);
            header("Location:index.php?action=convocation");
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }

    }

    public function ajouterConvocation($numMatch) {
        if ($this->session->estEntraineur()) {
            return $this->convocation->ajouterConvocation($numMatch);
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
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
            header("Location:index.php?action=afficherConnexion");
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
            header("Location:index.php?action=afficherConnexion");
        }
    }


    public function publier($numConvocation) {
        if ($this->session->estEntraineur()) {
            $nbJoueursConvoques = count($this->convocation->getJoueursConvoques($numConvocation));
            if ($nbJoueursConvoques < 11) {
                // Pas assez de joueurs pour publier la convocation
                header("Location:index.php?action=convocation");
            } else {
                $this->convocation->publier($numConvocation);
                header("Location:index.php?action=convocation");
            }
        }
        else if ($this->session->estSecretaire()) {
            header("Location:index.php?action=convocation");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
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
            header("Location:index.php?action=afficherConnexion");
        }
    }
}