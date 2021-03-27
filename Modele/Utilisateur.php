<?php

require_once 'Modele/Modele.php';

class Utilisateur extends Modele {
    public function getUtilisateurs() {
        $sql = 'SELECT * FROM T_UTILISATEUR ORDER BY NomUtilisateur';
        $utilisateurs = $this->executerRequete($sql);
        return $utilisateurs->fetchAll();
    }

    public function getUtilisateur($nom,$mdp) {
        $sql = 'SELECT * FROM T_UTILISATEUR WHERE NomUtilisateur = ? AND Mdp = ?';
        $convocation = $this->executerRequete($sql, array($nom,$mdp));
        if ($convocation->rowCount() > 0) {
            return $convocation->fetch();  // Accès à la première ligne de résultat
        }
        else {
            throw new Exception("Nom d'utilisateur ou mot de passe incorrecte, veuillez réessayer");
        }
    }
}