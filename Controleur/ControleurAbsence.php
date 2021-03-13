<?php

require_once 'Modele/Absence.php';
require_once 'Modele/Joueur.php';
require_once 'Vue/Vue.php';

class ControleurAbsence {
    private $absence;
    private $joueur;

    public function __construct() {
        $this->absence = new Absence();
        $this->joueur = new Joueur();
    }

    public function absence() {
        $joueurs = $this->joueur->getJoueurs();
        $absences = $this->absence->getAbsences();
        //$absencesDate = $this->absence->getAbsencesDate();
        //$absencesJoueur = $this->absence->getAbsencesJoueur();
        $vue = new Vue("Absence");
        $vue->generer(array('joueurs' => $joueurs, 'absences' => $absences));//  'absencesDate' => $absencesDate, 'absencesJoueur' => $absencesJoueur));
    }

    public function supprimerAbsence($idJoueur,$date) {
        $this->absence->supprimerAbsence($idJoueur,$date);
        header("Location:index.php?action=absence");
    }
    public function ajouterAbsence($idJoueur,$date,$motif) {
        $this->absence->ajouterAbsence($idJoueur,$date,$motif);
        header("Location:index.php?action=absence");
    }

}