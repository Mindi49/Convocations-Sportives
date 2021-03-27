<?php
require_once 'Controleur/ControleurAccueil.php';
require_once 'Controleur/ControleurMenuCompte.php';
require_once 'Controleur/ControleurMatch.php';
require_once 'Controleur/ControleurConvocation.php';
require_once 'Controleur/ControleurAbsence.php';
require_once 'Controleur/ControleurConnexion.php';
require_once 'Controleur/ControleurAnnexe.php';
require_once 'Vue/Vue.php';

class Routeur {

    private $ctrlAccueil;
    private $ctrlMenuCompte;
    private $ctrlConvocation;
    private $ctrlMatch;
    private $ctrlAbsence;
    private $ctrlConnexion;
    private $ctrlAnnexe;

    public function __construct() {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlMenuCompte = new ControleurMenuCompte();
        $this->ctrlMatch = new ControleurMatch();
        $this->ctrlConvocation = new ControleurConvocation();
        $this->ctrlAbsence = new ControleurAbsence();
        $this->ctrlConnexion = new ControleurConnexion();
        $this->ctrlAnnexe = new ControleurAnnexe();
    }

    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    // Pages d'accueil
                    case 'menuCompte' :
                        $this->ctrlMenuCompte->menuCompte();
                        break;
                    case 'convocation' :
                        $this->ctrlConvocation->convocation();
                        break;
                    case 'match' :
                        $this->ctrlMatch->match();
                        break;
                    case 'absence' :
                        $this->ctrlAbsence->absence();
                        break;
                    case 'afficherConnexion' :
                        $this->ctrlConnexion->afficherConnexion();
                        break;
                    case 'connexion' :
                        $nomUtilisateur = $this->getParametre($_POST, 'nomUtilisateur');
                        $mdp = $this->getParametre($_POST, 'mdp');
                        $this->ctrlConnexion->connexion($nomUtilisateur, $mdp);
                        break;
                    case 'deconnexion' :
                        $this->ctrlConnexion->deconnexion();
                        break;
                    case 'annexe' :
                        $this->ctrlAnnexe->annexe();
                        break;

                    // JOUEUR - Menu Compte
                    case 'supprimerJoueur' :
                        $idJoueur = $this->getParametre($_POST, 'idJoueur');
                        $this->ctrlMenuCompte->supprimerJoueur($idJoueur);
                        break;
                    case 'ajouterJoueur' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $prenom = $this->getParametre($_POST, 'prenom');
                        $categorie = $this->getParametre($_POST, 'categorie');
                        $licence = $this->getParametre($_POST, 'licence');
                        $this->ctrlMenuCompte->ajouterJoueur($nom, $prenom, $categorie, $licence);
                        break;

                    // CATEGORIE - Annexe
                    case 'supprimerCategorie' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $this->ctrlAnnexe->supprimerCategorie($nom);
                        break;
                    case 'ajouterCategorie' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $this->ctrlAnnexe->ajouterCategorie($nom);
                        break;

                    // COMPETITION - Annexe
                    case 'supprimerCompetition' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $this->ctrlAnnexe->supprimerCompetition($nom);
                        break;
                    case 'ajouterCompetition' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $this->ctrlAnnexe->ajouterCompetition($nom);
                        break;

                    // EQUIPE - Annexe
                    case 'supprimerEquipe' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $this->ctrlAnnexe->supprimerEquipe($nom);
                        break;
                    case 'ajouterEquipe' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $this->ctrlAnnexe->ajouterEquipe($nom);
                        break;

                    // MATCH - Match
                    case 'supprimerMatch' :
                        $numMatch = $this->getParametre($_POST, 'num');
                        $this->ctrlMatch->supprimerMatch($numMatch);
                        break;
                    case 'ajouterMatch' :
                        $categorie = $this->getParametre($_POST, 'categorie');
                        $competition = $this->getParametre($_POST, 'competition');
                        $idEquipe = $this->getParametre($_POST, 'equipe');
                        $equipeadv = $this->getParametre($_POST, 'equipeadv');
                        $date = date('Y-m-d', strtotime($this->getParametre($_POST, 'date')));
                        $heure = $this->getParametre($_POST, 'heure');
                        $terrain = $this->getParametre($_POST, 'terrain');
                        $site = $this->getParametre($_POST, 'site');
                        $this->ctrlMatch->ajouterMatch($categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site);
                        break;
                    case 'importerMatch':
                        $fichier = $this->getParametre($_FILES,'fichier');
                        $this->ctrlMatch->importerMatch($fichier);
                        break;
                    case 'modifierMatch' :
                        $numMatch = $this->getParametre($_POST, 'num');
                        $categorie = $this->getParametre($_POST, 'categorie');
                        $competition = $this->getParametre($_POST, 'competition');
                        $idEquipe = $this->getParametre($_POST, 'equipe');
                        $equipeadv = $this->getParametre($_POST, 'equipeadv');
                        $date = date('Y-m-d', strtotime($this->getParametre($_POST, 'date')));
                        $heure = $this->getParametre($_POST, 'heure');
                        $terrain = $this->getParametre($_POST, 'terrain');
                        $site = $this->getParametre($_POST, 'site');
                        $this->ctrlMatch->modifierMatch($numMatch, $categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site);
                        break;
                    case 'accesModifierMatch' :
                        $numMatch = $this->getParametre($_GET, 'num');
                        $this->ctrlMatch->accesModifierMatch($numMatch);
                        break;

                    // ABSENCE - Absence
                    case 'supprimerAbsence' :
                        $idJoueur = $this->getParametre($_POST, 'idJoueur');
                        $date = date('Y-m-d', strtotime($this->getParametre($_POST, 'date')));
                        $this->ctrlAbsence->supprimerAbsence($idJoueur, $date);
                        break;
                    case 'ajouterAbsence' :
                        $idJoueur = $this->getParametre($_POST, 'idJoueur');
                        $date = date('Y-m-d', strtotime($this->getParametre($_POST, 'date')));
                        $motif = $this->getParametre($_POST, 'motif');
                        $this->ctrlAbsence->ajouterAbsence($idJoueur, $date, $motif);
                        break;

                    // CONVOCATION - Convocation
                    case 'supprimerConvocation' :
                        $numConvocation = $this->getParametre($_POST, 'num');
                        $this->ctrlConvocation->supprimerConvocation($numConvocation);
                        break;
                    case 'supprimerConvocationsJoueur' :
                        $idJoueur = $this->getParametre($_POST, 'idJoueur');
                        $this->ctrlConvocation->supprimerConvocationsJoueur($idJoueur);
                        break;
                    case 'ajouterConvocation' :
                        $numMatch = $this->getParametre($_POST, 'num');
                        $numConvocation = $this->ctrlConvocation->ajouterConvocation($numMatch);
                        $this->ctrlConvocation->accesModifierConvocation($numConvocation);
                        break;
                    case 'accesModifierConvocation' :
                        $numConvocation = $this->getParametre($_GET, 'num');
                        $this->ctrlConvocation->accesModifierConvocation($numConvocation);
                        break;
                    case 'informationsConvocation' :
                        $numConvocation = $this->getParametre($_GET, 'num');
                        $this->ctrlConvocation->informationsConvocation($numConvocation);
                        break;
                    case 'modifierConvocation' :
                        $numConvocation = $this->getParametre($_POST, 'num');
                        $numMatch = $this->getParametre($_POST, 'numMatch');
                        $ensIdJoueur = array();
                        for ($i = 1; $i < 15; $i++) {
                            $idJoueur = $this->getParametre($_POST, 'idJoueur' . $i);
                            if (!empty($idJoueur)) {
                                array_push($ensIdJoueur, $idJoueur);
                            }
                        }
                        $this->ctrlConvocation->modifierConvocation($numConvocation, $numMatch, $ensIdJoueur);
                        header("Location:index.php?action=convocation");
                                break;
                    case 'publier' :
                        $numConvocation = $this->getParametre($_POST, 'num');
                        $this->ctrlConvocation->publier($numConvocation);
                        break;
                    case 'depublier' :
                        $numConvocation = $this->getParametre($_POST, 'num');
                        $this->ctrlConvocation->depublier($numConvocation);
                        break;
                    default:
                        throw new Exception("Action non valide");
                }
            }
            else {
                $this->ctrlAccueil->accueil();
            }
        }
        catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }

    // Affiche une erreur
    private function erreur($msgErreur) {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    // Recherche un paramètre dans un tableau
    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        }
        else {
            throw new Exception("Paramètre '$nom' absent");
        }
    }

}
