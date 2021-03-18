<?php

require_once 'Modele/Modele.php';

class Match extends Modele {

    public function getMatch($numMatch) {
        $sql = 'SELECT *'
            . ' FROM T_MATCH'
            . ' WHERE NumMatch = ?' ;;
        $match = $this->executerRequete($sql, array($numMatch));
        if ($match->rowCount() > 0)
            return $match->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun match ne correspond à match numéro '$numMatch'");
    }

    public function getMatchs() {
        $sql = 'SELECT * FROM T_MATCH';
        $categ = $this->executerRequete($sql);
        return $categ->fetchAll();
    }

    public function ajouterMatch($categorie, $competition, $equipe, $equipeadverse, $date, $heure, $terrain, $site) {
        $sql = 'INSERT INTO T_MATCH (Categorie,Competition,Equipe,EquipeAdverse,Date,Heure,Terrain,Site) VALUES(?,?,?,?,?,?,?,?)';
        $this->executerRequete($sql, array($categorie, $competition, $equipe, $equipeadverse, $date, $heure, $terrain, $site));
    }

    public function supprimerMatch($numMatch) {
        $sql = 'DELETE FROM T_MATCH WHERE NumMatch = ?';
        $this->executerRequete($sql, array($numMatch));
    }



    // TODO: voir l'update de la date qui doit être possible
    public function modifierMatch($numMatch, $categorie, $competition, $equipe, $equipeadverse, $date, $heure, $terrain, $site) {
        $sql = 'UPDATE T_MATCH'
            . ' SET Categorie = ?, Competition = ?, Equipe = ?,'
            . ' EquipeAdverse = ?, Date = ?, Heure = ?,'
            . ' Terrain = ?, Site = ? '
            . ' WHERE NumMatch = ?';
        $this->executerRequete($sql, array($categorie, $competition, $equipe, $equipeadverse, $date, $heure, $terrain, $site, $numMatch));
    }
}