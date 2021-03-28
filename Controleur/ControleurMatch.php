<?php

require_once 'Modele/Match.php';
require_once 'Modele/Equipe.php';
require_once 'Modele/Categorie.php';
require_once 'Modele/Competition.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

/**
 * Contrôleur des actions liées à la page des matchs.
 */
class ControleurMatch extends ControleurSession {
    /** Les modèles fournissant les différents services d'accès */
    private $match;
    private $categorie;
    private $competition;
    private $equipe;

    /**
     * Constructeur qui instancie les modèles.
     */
    public function __construct() {
        parent::__construct();
        $this->match = new Match();
        $this->categorie = new Categorie();
        $this->competition = new Competition();
        $this->equipe = new Equipe();
    }

    /**
     * Récupère les données nécessaires à l'affichage de la vue.
     * Affiche la vue de la page des matchs.
     *
     * Si l'utilisateur n'est pas connecté, redirige vers la page de connexion.
     */
    public function match() {
        if (!$this->session->estConnecte()) {
            header("Location:index.php?action=afficherConnexion");
            return;
        }
        $matchs = $this->match->getMatchs();
        $categories = $this->categorie->getCategories();
        $competitions = $this->competition->getCompetitions();
        $equipes = $this->equipe->getEquipes();
        $vue = new Vue("Match");
        $vue->generer(array('matchs' => $matchs, 'categories' => $categories, 'competitions' => $competitions, 'equipes' => $equipes, 'role' => $this->session->getRole()));
    }

    /**
     * Supprime un match.
     *
     * Si l'utilisateur n'est pas connecté en tant que secrétaire.
     * redirige vers la page de connexion ou celle des matchs.
     *
     * @param $numMatch L'identifiant du match à supprimer.
     */
    public function supprimerMatch($numMatch) {
        if ($this->session->estSecretaire()) {
            $this->match->supprimerMatch($numMatch);
        }
        else {
            echo json_encode(array('warning' => 'Vous n\'avez pas le droit de supprimer un match.'));
        }
    }

    /**
     * Ajoute un match
     *
     * Si l'utilisateur n'est pas connecté en tant que secrétaire.
     * redirige vers la page de connexion ou celle des matchs.
     *
     * @param $categorie    Le nom de la catégorie.
     * @param $competition  Le nom du type de compétition organisée.
     * @param $equipe       Le nom de l'équipe.
     * @param $equipeadv    Le nom de l'équipe adverse.
     * @param $date         La date du match.
     * @param $heure        L'heure de match.
     * @param $terrain      Le nom du terrain sur lequel se déroulera le match.
     * @param $site         Le nom du lieu / ville où se passera la rencontre.
     * @throws Exception    Exception lancée si le match est déjà répertorié.
     */
    public function ajouterMatch($categorie, $competition, $equipe, $equipeadv, $date, $heure, $terrain, $site) {
        if ($this->session->estSecretaire()) {
            $this->match->ajouterMatch($categorie, $competition, $equipe, $equipeadv, $date, $heure, $terrain, $site);
            header("Location:index.php?action=match");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=match");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    /**
     * Affiche la page de modification d'un match.
     * Récupère les données nécessaires à l'affichage de la vue.
     * Affiche la vue de la page de modification de matchs.
     *
     * Si l'utilisateur n'est pas connecté en tant que secrétaire.
     * redirige vers la page de connexion ou celle des matchs.
     *
     * @param $numMatch
     */
    public function accesModifierMatch($numMatch) {
        if ($this->session->estSecretaire()) {
            $match = $this->match->getMatch($numMatch);
            $categories = $this->categorie->getCategories();
            $competitions = $this->competition->getCompetitions();
            $equipes = $this->equipe->getEquipes();
            $vue = new Vue("ModificationMatch");
            $vue->generer(array('match' => $match,'categories' => $categories, 'competitions' => $competitions, 'equipes' => $equipes, 'role' => $this->session->getRole()));
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=match");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

    /**
     * Modifie un match.
     *
     * Si l'utilisateur n'est pas connecté en tant que secrétaire.
     * redirige vers la page de connexion ou celle des matchs.
     *
     * @param $numMatch     L'identifiant du match que l'on modifie.
     * @param $categorie    Le nom de la catégorie.
     * @param $competition  Le nom du type de compétition organisée.
     * @param $equipe       Le nom de l'équipe.
     * @param $equipeadv    Le nom de l'équipe adverse.
     * @param $date         La date du match.
     * @param $heure        L'heure de match.
     * @param $terrain      Le nom du terrain sur lequel se déroulera le match.
     * @param $site         Le nom du lieu / ville où se passera la rencontre.
     */
    public function modifierMatch($numMatch, $categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site) {
        if ($this->session->estSecretaire()) {
            $this->match->modifierMatch($numMatch, $categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site);
            header("Location:index.php?action=match");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=match");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }

    }

    /**
     * Importe un fichier CSV, traite les données associées pour créer les matchs correspondants.
     *
     * Si l'utilisateur n'est pas connecté en tant que secrétaire.
     * redirige vers la page de connexion ou celle des matchs.
     *
     * @param $fichier      Le fichier CSV importé.
     * @throws Exception    Exception lancée lors d'une erreur dans la forme ou la lecture du fichier.
     */
    public function importerMatch($fichier) {
        if ($this->session->estSecretaire()) {
            $matchsImportes = array();

            if (($matchs = fopen($fichier['tmp_name'], "r")) !== FALSE) {
                while (($ligne = fgetcsv($matchs, 1000, ",")) !== FALSE) {
                   if (count($ligne) !== 8) {
                       fclose($matchs);
                       throw new Exception('Une ligne du fichier est invalide. Le nombre de paramètres fournis est différent de celui attendu.');
                   }
                   else {
                       $categorie = $ligne[0];
                       $competition = $ligne[1];
                       $equipe = $ligne[2];
                       $equipeAdverse = $ligne[3];
                       $date = $ligne[4];
                       $heure = $ligne[5];
                       $terrain = $ligne[6];
                       $site = $ligne[7];

                       if (!$categorie || !$competition || !$equipe || !$equipeAdverse || !$date || !$heure) {
                           fclose($matchs);
                           throw new Exception('Une ligne du fichier est invalide. Certains paramètres requis sont manquants.');
                       }
                       else {
                           array_push($matchsImportes, array('categorie' => $categorie, 'competition' => $competition, 'equipe' => $equipe, 'equipeAdverse' => $equipeAdverse, 'date' => $date, 'heure' => $heure, 'terrain' => $terrain, 'site' => $site));
                       }
                   }
                }
                foreach ($matchsImportes as $matchsImporte) {
                    $this->match->ajouterMatch($matchsImporte['categorie'], $matchsImporte['competition'], $matchsImporte['equipe'], $matchsImporte['equipeAdverse'], $matchsImporte['date'], $matchsImporte['heure'], $matchsImporte['terrain'], $matchsImporte['site']);
                }
                fclose($matchs);
            }
            header("Location:index.php?action=match");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=match");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }
}