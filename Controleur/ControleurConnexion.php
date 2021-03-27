<?php

require_once 'Modele/Utilisateur.php';
require_once 'ControleurSession.php';


class ControleurConnexion extends ControleurSession {
    private $utilisateur;

    public function __construct() {
        parent::__construct();
        $this->utilisateur = new Utilisateur();
    }

    public function afficherConnexion($erreurs = array()) {
        if (!$this->session->estConnecte()) {
            $utilisateurs = $this->utilisateur->getUtilisateurs();
            $vue = new Vue("Connexion");
            $vue->generer(array('utilisateurs' => $utilisateurs, 'erreurs' => $erreurs, 'role' => $this->session->getRole()));
        }
        else {
            header("Location:index.php?action=menuCompte");
        }
    }

    public function connexion ($nomUtilisateur,$mdp) {
        try {
            $utilisateur = $this->utilisateur->getUtilisateur($nomUtilisateur,$mdp);
            $this->session->setAttribut("nomUtilisateur", $nomUtilisateur);
            $this->session->setAttribut("role", $utilisateur['Role']);
            header("Location:index.php?action=menuCompte");
        } catch (Exception $e) {
            $erreurs = $e->getMessage();
            $this->afficherConnexion($erreurs);
        }
    }

    public function deconnexion() {
        if ($this->session->estConnecte()) {
            $this->session->detruire();
            header("Location:index.php");
        }
        else header("Location:index.php?action=afficherConnexion");
    }
}