<?php

abstract class Modele {
    private $bdd;

    protected function executerRequete($sql, $params = null) {
        if ($params == null) {
            $resultat = $this->getBdd()->query($sql); // exécution directe
        }
        else {
            $resultat = $this->getBdd()->prepare($sql);  // requête préparée
            $resultat->execute($params);
        }
        return $resultat;
    }

    protected function getLastInsertID() {
        return $this->getBdd()->lastInsertId();
    }

    private function getBdd() {
        if ($this->bdd == null) {
            // Création de la connexion
            $params = parse_ini_file('BD/config.ini');
            $this->bdd = new PDO($params['dns'],
                $params['login'], $params['pass'],
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return $this->bdd;
    }
}