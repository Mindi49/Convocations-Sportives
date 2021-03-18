<?php
require_once 'Controleur/ControleurAccueil.php';
require_once 'Controleur/ControleurMenuCompte.php';
require_once 'Controleur/ControleurMatch.php';
require_once 'Controleur/ControleurConvocation.php';
require_once 'Controleur/ControleurAbsence.php';
require_once 'Controleur/ControleurConnexion.php';
require_once 'Vue/Vue.php';

class Routeur {

    private $ctrlAccueil;
    private $ctrlMenuCompte;
    private $ctrlConvocation;
    private $ctrlMatch;
    private $ctrlAbsence;
    private $ctrlConnexion;


    public function __construct() {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlMenuCompte = new ControleurMenuCompte();
        $this->ctrlMatch = new ControleurMatch();
        $this->ctrlConvocation = new ControleurConvocation();
        $this->ctrlAbsence = new ControleurAbsence();
        $this->ctrlConnexion = new ControleurConnexion();
    }

    // Route une requête entrante : exécution l'action associée
    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'menuCompte') {
                    $this->ctrlMenuCompte->menuCompte();
                }
                else if ($_GET['action'] == 'convocation') {
                    $this->ctrlConvocation->convocation();
                }
                else if ($_GET['action'] == 'match') {
                    $this->ctrlMatch->match();
                }
                else if ($_GET['action'] == 'absence') {
                    $this->ctrlAbsence->absence();
                }
                else if ($_GET['action'] == 'connexion') {
                    $this->ctrlConnexion->connexion();
                }
                // JOUEUR - Menu Compte
                else if ($_GET['action'] == 'supprimerJoueur') {
                    $this->ctrlMenuCompte->supprimerJoueur($idJoueur);
                }
                else if ($_GET['action'] == 'ajouterJoueur') {
                    $nom = $this->getParametre($_POST, 'nom');
                    $prenom = $this->getParametre($_POST, 'prenom');
                    $categorie= $this->getParametre($_POST, 'categorie');
                    $licencie= $this->getParametre($_POST, 'licencie');
                    $this->ctrlMenuCompte->ajouterJoueur($nom,$prenom,$categorie,$licencie);
                }
                else if ($_GET['action'] == 'ajouterLicence') {
                    $idJoueur = $this->getParametre($_POST, 'idJoueur');
                    $this->ctrlMenuCompte->ajouterLicence($idJoueur);
                }
                // CATEGORIE - Accueil pour l'instant
                else if ($_GET['action'] == 'supprimerCategorie') {
                    $nom = $this->getParametre($_POST,'nom');
                    $this->ctrlAccueil->supprimerCategorie($nom);
                }
                else if ($_GET['action'] == 'ajouterCategorie')  {
                    $nom = $this->getParametre($_POST,'nom');
                    $this->ctrlAccueil->ajouterCategorie($nom);
                }
                // COMPETITION - Accueil pour l'instant
                else if ($_GET['action'] == 'supprimerCompetition') {
                    $nom = $this->getParametre($_POST,'nom');
                    $this->ctrlAccueil->supprimerCompetition($nom);
                }
                else if ($_GET['action'] == 'ajouterCompetition')  {
                    $nom = $this->getParametre($_POST,'nom');
                    $this->ctrlAccueil->ajouterCompetition($nom);
                }
                // EQUIPE - Accueil pour l'instant
                else if ($_GET['action'] == 'supprimerEquipe') {
                    $nom = $this->getParametre($_POST,'nom');
                    $this->ctrlAccueil->supprimerEquipe($nom);
                }
                else if ($_GET['action'] == 'ajouterEquipe')  {
                    $nom = $this->getParametre($_POST,'nom');
                    $this->ctrlAccueil->ajouterEquipe($nom);
                }

                // MATCH - Match
                else if ($_GET['action'] == 'supprimerMatch') {
                    $numMatch = $this->getParametre($_POST,'num');
                    $this->ctrlMatch->supprimerMatch($numMatch);
                }
                else if ($_GET['action'] == 'ajouterMatch') {
                    $categorie = $this->getParametre($_POST, 'categorie');
                    $competition = $this->getParametre($_POST, 'competition');
                    $idEquipe = $this->getParametre($_POST, 'equipe');
                    $equipeadv = $this->getParametre($_POST, 'equipeadv');
                    $date = date('Y-m-d', strtotime($this->getParametre($_POST, 'date')));
                    $heure = $this->getParametre($_POST, 'heure');
                    $terrain = $this->getParametre($_POST, 'terrain');
                    $site = $this->getParametre($_POST, 'site');
                    $this->ctrlMatch->ajouterMatch($categorie, $competition, $idEquipe, $equipeadv, $date, $heure, $terrain, $site);
                }
                else if ($_GET['action'] == 'modifierMatch') {
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
                }
                else if ($_GET['action'] == 'accesModifierMatch') {
                    $numMatch = $this->getParametre($_POST, 'num');
                    $this->ctrlMatch->accesModifierMatch($numMatch);
                }
                // ABSENCE - Absence
                else if ($_GET['action'] == 'supprimerAbsence') {
                    $idJoueur = $this->getParametre($_POST,'idJoueur');
                    $date = date('Y-m-d', strtotime($this->getParametre($_POST, 'date')));
                    $this->ctrlAbsence->supprimerAbsence($idJoueur,$date);
                }
                else if ($_GET['action'] == 'ajouterAbsence') {
                    $idJoueur = $this->getParametre($_POST,'idJoueur');
                    $date = date('Y-m-d', strtotime($this->getParametre($_POST, 'date')));
                    $motif = $this->getParametre($_POST,'motif');
                    $this->ctrlAbsence->ajouterAbsence($idJoueur,$date,$motif);
                }

                // CONVOCATION - Convocation
                // TODO : voir la suppression d'un joueur convoqué dans l'équipe + celle de toute la convoc (toute l'équipe)
                // supprime que la convoc d'un joueur pour un match
                else if ($_GET['action'] == 'supprimerConvocation') {
                    $numConvocation = $this->getParametre($_POST,'num');
                    $this->ctrlConvocation->supprimerConvocation($numConvocation);
                }
                else if ($_GET['action'] == 'supprimerConvocationsJoueur') {
                    $idJoueur = $this->getParametre($_POST,'idJoueur');
                    $this->ctrlConvocation->supprimerConvocationsJoueur($idJoueur);
                }
                else if ($_GET['action'] == 'ajouterConvocation') {
                    $numMatch = $this->getParametre($_POST, 'num');
                    $numConvocation = $this->ctrlConvocation->ajouterConvocation($numMatch);
                    for ($i = 1; $i < 15; $i++) {
                        $idJoueur = $this->getParametre($_POST, 'idJoueur' . $i);
                        if(isset($idJoueur))
                            $this->ctrlConvocation->ajouterJoueurConvoque($numConvocation,$idJoueur);
                    }
                    header("Location:index.php?action=convocation");
                }
                else if ($_GET['action'] == 'publier') {
                    $numConvocation = $this->getParametre($_POST,'num');
                    $this->ctrlConvocation->publier($numConvocation);
                }
                else if ($_GET['action'] == 'depublier') {
                    $numConvocation = $this->getParametre($_POST,'num');
                    $this->ctrlConvocation->depublier($numConvocation);
                }

            else
                    throw new Exception("Action non valide");
            }
            else {  // aucune action définie : affichage de l'accueil
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
        else
            throw new Exception("Paramètre '$nom' absent");
    }

}
