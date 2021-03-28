<?php

require_once 'Modele/Absence.php';
require_once 'Modele/Joueur.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

/**
 * Contrôleur des actions liées aux absences.
 */
class ControleurAbsence extends ControleurSession {
    /** Les modèles fournissant les différents services d'accès */
    private $absence;
    private $joueur;

    /**
     * Constructeur qui intancie les modèles.
     */
    public function __construct() {
        parent::__construct();
        $this->absence = new Absence();
        $this->joueur = new Joueur();
    }

    /**
     * Récupère les données nécessaires à l'affichage de la vue.
     * Affiche la vue de la page des absences.
     *
     * Si l'utilisateur n'est pas connecté, redirige vers la page de connexion.
     */
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

    /**
     * Supprime une absence.
     *
     * Si l'utilisateur n'est pas connecté, redirige vers la page de connexion.
     *
     * @param $idJoueur L'identifiant du joueur dont on veut supprimer l'absence.
     * @param $date     La date de l'absence.
     */
    public function supprimerAbsence($idJoueur,$date) {
        if ($this->session->estConnecte()) {
            $this->absence->supprimerAbsence($idJoueur, $date);
            header("Location:index.php?action=absence");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    /**
     * Ajoute une absence.
     *
     * Si l'utilisateur n'est pas connecté, redirige vers la page de connexion.
     *
     * @param $idJoueur     L'identifiant du joueur auquel on ajoute l'absence.
     * @param $date         La date de l'absence.
     * @param $motif        Le motif de l'absence.
     * @throws Exception    Exception lancée quand l'absence est déjà présente.
     */
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