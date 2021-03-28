<?php

require_once 'Modele/Utilisateur.php';
require_once 'ControleurSession.php';

/**
 * Contrôleur des actions liées à la page de connexion.
 */
class ControleurConnexion extends ControleurSession {
    /** Les modèles fournissant les différents services d'accès */
    private $utilisateur;

    /**
     * Constructeur qui instancie les modèles.
     */
    public function __construct() {
        parent::__construct();
        $this->utilisateur = new Utilisateur();
    }

    /**
     * Récupère les données nécessaires à l'affichage de la vue.
     * Affiche la vue de la page de connexion.
     *
     * Si l'utilisateur est déjà connecté, redirige vers la page de menu du compte.
     */
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

    /**
     * Réalise la connexion d'un utilisateur en tant qu'entraîneur ou secrétaire.
     * Redirige ensuite vers la page de menu du compte.
     *
     * Si les données d'utilisateur sont incorrectes, affiche de nouveau la page de
     * connexion avec un message d'erreur.
     *
     * @param $nomUtilisateur   Le nom entré par l'utilisateur pour se connecter.
     * @param $mdp              Le mot de passe de l'utilisateur pour se connecter.
     */
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

    /**
     * Détruit la session si l'utilisateur est connecté, redirige vers la page de connexion sinon.
     */
    public function deconnexion() {
        if ($this->session->estConnecte()) {
            $this->session->detruire();
            header("Location:index.php");
        }
        else header("Location:index.php?action=afficherConnexion");
    }
}