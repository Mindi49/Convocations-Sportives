<?php

require_once 'Modele/Modele.php';

/**
 * Fournit les services d'accès utilisateurs.
 */
class Utilisateur extends Modele {
    /**
     * Renvoie la liste des utilisateurs inscrits.
     *
     * @return array La liste des utilisateurs inscrits.
     */
    public function getUtilisateurs() {
        $sql = 'SELECT * FROM T_UTILISATEUR ORDER BY NomUtilisateur';
        $utilisateurs = $this->executerRequete($sql);
        return $utilisateurs->fetchAll();
    }

    /**
     * Renvoie l'utilisateur associé.
     *
     * @param $nom          Le nom d'utilisateur.
     * @param $mdp          Le mot de passe associé.
     * @return mixed        Les informations sur cet utilisateur
     * @throws Exception    Exception lancée si les données d'utilisateur sont incorrectes.
     */
    public function getUtilisateur($nom,$mdp) {
        $sql = 'SELECT * FROM T_UTILISATEUR WHERE NomUtilisateur = ? AND Mdp = ?';
        $convocation = $this->executerRequete($sql, array($nom,$mdp));
        if ($convocation->rowCount() > 0) {
            return $convocation->fetch();
        }
        else {
            throw new Exception("Nom d'utilisateur ou mot de passe incorrecte, veuillez réessayer");
        }
    }
}