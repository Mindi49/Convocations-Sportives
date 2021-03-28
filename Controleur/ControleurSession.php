<?php

require_once 'Session.php';

/**
 * Classe abstraite dont héritent tous les autres contrôleurs.
 * Gère les sessions pour assurer la connexion des utilisateurs et leur accès aux pages.
 */
abstract class ControleurSession {
    protected $session;

    public function __construct() {
        $this->session = new Session();
    }
}