<?php

require_once 'Modele/Absence.php';
require_once 'Modele/Joueur.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

class ControleurAbsence extends ControleurSession {
    private $absence;
    private $joueur;

    public function __construct() {
        parent::__construct();
        $this->absence = new Absence();
        $this->joueur = new Joueur();
    }

    public function absence() {
        if ($this->session->estConnecte()) {
            $joueurs = $this->joueur->getJoueurs();
            $absences = $this->absence->getAbsences();
            $vue = new Vue("Absence");
            $vue->generer(array('joueurs' => $joueurs, 'absences' => $absences, 'role' => $this->session->getRole()));
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    public function supprimerAbsence($idJoueur,$date) {
        if ($this->session->estConnecte()) {
            $this->absence->supprimerAbsence($idJoueur, $date);
            header("Location:index.php?action=absence");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    public function ajouterAbsence($idJoueur,$date,$motif) {
        if ($this->session->estConnecte()) {
            $this->absence->ajouterAbsence($idJoueur, $date, $motif);
            header("Location:index.php?action=absence");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

}