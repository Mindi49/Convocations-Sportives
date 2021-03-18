<?php

require_once 'Modele/Utilisateur.php';

class ControleurConnexion {
    private $utilisateur;

    public function __construct() {
        $this->utilisateur = new Utilisateur();
    }

    public function connexion() {
        $utilisateurs = $this->utilisateur->getUtilisateurs();
        $vue = new Vue("Connexion");
        $vue->generer(array('utilisateurs' => $utilisateurs));
    }

}