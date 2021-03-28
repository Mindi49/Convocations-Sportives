<?php

/**
 * Classe modélisant la session.
 * Encapsule la superglobale PHP $_SESSION.
 */
class Session {
    /**
     * Constructeur qui démarre ou restaure la session.
     */
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Détruit la session actuelle.
     */
    public function detruire() {
        session_destroy();
    }

    /**
     * Vérifie si l'utilisateur est connecté.
     *
     * @return bool Vrai si l'utilisateur est connecté, faux sinon.
     */
    public function estConnecte() {
        return $this->existeAttribut("nomUtilisateur");
    }

    /**
     * Vérifie si l'utilisateur est connecté en tant qu'entraîneur.
     *
     * @return bool Vrai si l'utilisateur est connecté en tant qu'entraîneur, faux sinon.
     */
    public function estEntraineur() {
        return ($this->estConnecte() && $this->getAttribut("role") == "Entraineur");
    }

    /**
     * Vérifie si l'utilisateur est connecté en tant que secrétaire.
     *
     * @return bool Vrai si l'utilisateur est connecté en tant que secrétaire, faux sinon.
     */
    public function estSecretaire() {
        return ($this->estConnecte() && $this->getAttribut("role") == "Secretaire");
    }

    /**
     * Récupère sous forme d'un caractère le rôle de l'utilisateur.
     *
     * @return string   Un caractère représentant le rôle de l'utilisateur.
     */
    public function getRole() {
        if ($this->estEntraineur())
            return 'E';
        else if ($this->estSecretaire())
            return 'S';
        else return 'V';
    }

    /**
     * Ajoute un attribut à la session.
     *
     * @param $nom      Le nom de l'attribut à ajouter.
     * @param $valeur   La valeur de l'attribut.
     */
    public function setAttribut($nom, $valeur) {
        $_SESSION[$nom] = $valeur;
    }

    /**
     * Vérifie si l'attribut existe dans la session.
     *
     * @param $nom  Le nom de l'attribut.
     * @return bool Vrai sur l'attribut existe dans la session, faux sinon.
     */
    public function existeAttribut($nom) {
        return (isset($_SESSION[$nom]) && $_SESSION[$nom] != "");
    }

    /**
     * Renvoie la valeur de l'attribut passé en paramètre ou lance une erreur
     * si celui-ci n'existe pas dans la session.
     * @param $nom          Le nom de l'attribut recherché.
     * @return mixed        La valeur de l'attribut s'il existe.
     * @throws Exception    Exception lancée si l'attribut n'est pas présent dans la session.
     */
    public function getAttribut($nom) {
        if ($this->existeAttribut($nom)) {
            return $_SESSION[$nom];
        }
        else {
            throw new Exception("Attribut '$nom' absent de la session");
        }
    }
}

