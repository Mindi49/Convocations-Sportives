<?php
require_once 'Controleur/ControleurAccueil.php';
require_once 'Controleur/ControleurMenuCompte.php';
require_once 'Controleur/ControleurMatch.php';
require_once 'Controleur/ControleurConvocation.php';
require_once 'Controleur/ControleurAbsence.php';
require_once 'Controleur/ControleurConnexion.php';
require_once 'Controleur/ControleurAnnexe.php';
require_once 'Vue/Vue.php';

/**
 * Gère le routage des requêtes entrantes.
 */
class Routeur {
    /**
     * Les contrôleurs liés aux différentes pages.
     */
    private $ctrlAccueil;
    private $ctrlMenuCompte;
    private $ctrlConvocation;
    private $ctrlMatch;
    private $ctrlAbsence;
    private $ctrlConnexion;
    private $ctrlAnnexe;

    /**
     * Constructeur qui initialise les contructeurs.
     */
    public function __construct() {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlMenuCompte = new ControleurMenuCompte();
        $this->ctrlMatch = new ControleurMatch();
        $this->ctrlConvocation = new ControleurConvocation();
        $this->ctrlAbsence = new ControleurAbsence();
        $this->ctrlConnexion = new ControleurConnexion();
        $this->ctrlAnnexe = new ControleurAnnexe();
    }

    /**
     * Méthode principale qui examine la requête et execute l'action appropriée.
     */
    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    // Pages principales
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

                    // Menu compte - Ajout, suppression de joueurs du club
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

                    // Catégorie - Annexe
                    case 'supprimerCategorie' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $this->ctrlAnnexe->supprimerCategorie($nom);
                        break;
                    case 'ajouterCategorie' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $this->ctrlAnnexe->ajouterCategorie($nom);
                        break;

                    // Compétition - Annexe
                    case 'supprimerCompetition' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $this->ctrlAnnexe->supprimerCompetition($nom);
                        break;
                    case 'ajouterCompetition' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $this->ctrlAnnexe->ajouterCompetition($nom);
                        break;

                    // Équipe - Annexe
                    case 'supprimerEquipe' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $this->ctrlAnnexe->supprimerEquipe($nom);
                        break;
                    case 'ajouterEquipe' :
                        $nom = $this->getParametre($_POST, 'nom');
                        $this->ctrlAnnexe->ajouterEquipe($nom);
                        break;

                    // Match - Ajout, modification, suppression de matchs
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

                    // Absence - Ajout, suppression d'absences
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

                    // Convocation - Accès, ajout, modification, suppression, publication de convocations.
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
                        $ensIdJoueur = array();
                        for ($i = 1; $i < 15; $i++) {
                            $idJoueur = $this->getParametre($_POST, 'idJoueur' . $i);
                            if (!empty($idJoueur)) {
                                array_push($ensIdJoueur, $idJoueur);
                            }
                        }
                        $this->ctrlConvocation->modifierConvocation($numConvocation, $ensIdJoueur);
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

    /**
     * Instancie et affiche la vue d'erreur.
     *
     * @param $msgErreur    Le message d'erreur.
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    private function erreur($msgErreur) {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    /**
     * Vérifie si un élément est un paramètre du tableau, si oui retourne
     * cet élément, sinon lance une erreur.
     *
     * @param $tableau      Le tableau dont on vérifie la présence d'un paramètre.
     * @param $nom          Le paramètre en question.
     * @return mixed        L'élément du tableau.
     * @throws Exception    Exception lancée si le paramètre n'est pas présent.
     */
    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        }
        else {
            throw new Exception("Paramètre '$nom' absent");
        }
    }

}
