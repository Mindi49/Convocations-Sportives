<?php

require_once 'Modele/Joueur.php';
require_once 'Modele/Categorie.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

/**
 * Contrôleur des actions liées à la page du menu du compte.
 */
class ControleurMenuCompte extends ControleurSession {
    /** Les modèles fournissant les différents services d'accès */
    private $joueur;
    private $categorie;

    /**
     * Constructeur qui instancie les modèles.
     */
    public function __construct() {
        parent::__construct();
        $this->joueur = new Joueur();
        $this->categorie = new Categorie();
    }

    /**
     * Récupère les données nécessaires à l'affichage de la vue.
     * Affiche la vue de la page de menu du compte.
     *
     * Si l'utilisateur n'est pas connecté, redirige vers la page de connexion.
     */
    public function menuCompte() {
        if (!$this->session->estConnecte()) {
            header("Location:index.php?action=afficherConnexion");
            return;
        }
        $joueurs = $this->joueur->getJoueurs();
        $categories = $this->categorie->getCategories();
        $vue = new Vue("MenuCompte");
        $vue->generer(array('joueurs' => $joueurs, 'categories' => $categories, 'role' => $this->session->getRole(),'nomUtilisateur' => $this->session->getAttribut("nomUtilisateur")));
    }

    /**
     * Supprime un joueur du club.
     *
     * Si l'utilisateur n'est pas connecté en tant que secrétaire.
     * redirige vers la page de connexion ou le menu du compte.
     *
     * @param $idJoueur L'identifiant du joueur que l'on supprime.
     */
    public function supprimerJoueur($idJoueur) {
        if ($this->session->estSecretaire()) {
            $this->joueur->supprimerJoueur($idJoueur);
            header("Location:index.php?action=menuCompte");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=menuCompte");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    /**
     * Ajoute un joueur au club.
     *
     * Si l'utilisateur n'est pas connecté en tant que secrétaire.
     * redirige vers la page de connexion ou le menu du compte.
     *
     * @param $nom          Le nom du joueur.
     * @param $prenom       Le prénom du joueur.
     * @param $categorie    La catégorie dans laquelle est inscrit le joueur.
     * @param $licence      Le type de licence que possède le joueur.
     * @throws Exception    Exception lancée un joueur avec le même nom, prénom et
     *                      dans la même catégorie existe déjà.
     */
    public function ajouterJoueur($nom,$prenom,$categorie,$licence) {
        if ($this->session->estSecretaire()) {
            $this->joueur->ajouterJoueur($nom,$prenom,$categorie,$licence);
            header("Location:index.php?action=menuCompte");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=menuCompte");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }
}