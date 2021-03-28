<?php

/**
 * Classe abstraite.
 * Gère les accès à la base de donnée.
 * Utilise l'API PDO de PHP.
 */
abstract class Modele {
    /** Objet PDO d'accès à la base de donnée. */
    private $bdd;

    /**
     * Exécute une requête SQL.
     *
     * @param $sql                  Requête SQL.
     * @param null $params          Paramètre(s) de la requête.
     * @return false|PDOStatement   Résultat(s) de la requête.
     */
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

    /**
     * Renvoie l'identifiant de la derniere insertion dans la base de donnée.
     *
     * @return string   L'identifiant de la dernière insertion.
     */
    protected function getLastInsertID() {
        return $this->getBdd()->lastInsertId();
    }

    /**
     * Renvoie un objet de connexion à la BDD en initialisant la connexion au besoin.
     *
     * @return PDO  Un objet PDO de conenxion à la base de donnée.
     */
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