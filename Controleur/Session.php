<?php

class Session {
    /** Démarre ou restaure la session  */
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**  Détruit la session actuelle   */
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

    /** Ajoute un attribut à la session   */
    public function setAttribut($nom, $valeur) {
        $_SESSION[$nom] = $valeur;
    }

    /** Renvoie vrai si l'attribut existe dans la session    */
    public function existeAttribut($nom) {
        return (isset($_SESSION[$nom]) && $_SESSION[$nom] != "");
    }

    /** Renvoie la valeur de l'attribut demandé   */
    public function getAttribut($nom) {
        if ($this->existeAttribut($nom)) {
            return $_SESSION[$nom];
        }
        else {
            throw new Exception("Attribut '$nom' absent de la session");
        }
    }
}

