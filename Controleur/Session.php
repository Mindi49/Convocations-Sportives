<?php

class Session {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function detruire() {
        session_destroy();
    }

    public function estConnecte() {
        return $this->existeAttribut("nomUtilisateur");
    }

    public function estEntraineur() {
        return ($this->estConnecte() && $this->getAttribut("role") == "Entraineur");
    }

    public function estSecretaire() {
        return ($this->estConnecte() && $this->getAttribut("role") == "Secretaire");
    }

    public function getRole() {
        if ($this->estEntraineur())
            return 'E';
        else if ($this->estSecretaire())
            return 'S';
        else return 'V';
    }

    public function setAttribut($nom, $valeur) {
        $_SESSION[$nom] = $valeur;
    }

    public function existeAttribut($nom) {
        return (isset($_SESSION[$nom]) && $_SESSION[$nom] != "");
    }

    public function getAttribut($nom) {
        if ($this->existeAttribut($nom)) {
            return $_SESSION[$nom];
        }
        else {
            throw new Exception("Attribut '$nom' absent de la session");
        }
    }
}

