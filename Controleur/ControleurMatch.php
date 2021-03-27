<?php

require_once 'Modele/Match.php';
require_once 'Modele/Equipe.php';
require_once 'Modele/Categorie.php';
require_once 'Modele/Competition.php';
require_once 'ControleurSession.php';
require_once 'Vue/Vue.php';

class ControleurMatch extends ControleurSession {
    private $match;
    private $categorie;
    private $competition;
    private $equipe;

    public function __construct() {
        parent::__construct();
        $this->match = new Match();
        $this->categorie = new Categorie();
        $this->competition = new Competition();
        $this->equipe = new Equipe();
    }

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

    public function supprimerMatch($numMatch) {
        if ($this->session->estSecretaire()) {
            $this->match->supprimerMatch($numMatch);
        }
        else {
            echo json_encode(array('warning' => 'Vous n\'avez pas le droit de supprimer un match.'));
        }
    }

    public function ajouterMatch($categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site) {
        if ($this->session->estSecretaire()) {
            $this->match->ajouterMatch($categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site);
            header("Location:index.php?action=match");
        }
        else if ($this->session->estEntraineur()) {
            header("Location:index.php?action=match");
        }
        else {
            header("Location:index.php?action=afficherConnexion");
        }
    }

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