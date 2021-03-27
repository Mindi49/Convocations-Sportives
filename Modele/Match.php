<?php

require_once 'Modele/Modele.php';

class Match extends Modele {
    public function getMatch($numMatch) {
        $sql = 'SELECT *'
            . ' FROM T_MATCH'
            . ' WHERE NumMatch = ?' ;;
        $match = $this->executerRequete($sql, array($numMatch));
        if ($match->rowCount() > 0) {
            return $match->fetch();  // Accès à la première ligne de résultat
        }
        else {
            throw new Exception("Le match demandé n'existe pas ou a été supprimé.");
        }
    }

    public function getMatchs() {
        $sql = 'SELECT * FROM T_MATCH ORDER BY Date';
        $categ = $this->executerRequete($sql);
        return $categ->fetchAll();
    }

    public function ajouterMatch($categorie, $competition, $equipe, $equipeadverse, $date, $heure, $terrain, $site) {
        try {
            $sql = 'INSERT INTO T_MATCH (Categorie,Competition,Equipe,EquipeAdverse,Date,Heure,Terrain,Site) VALUES(?,?,?,?,?,?,?,?)';
            $this->executerRequete($sql, array($categorie, $competition, $equipe, $equipeadverse, $date, $heure, $terrain, $site));
        } catch (Exception $e) {
            if ($e->getCode() == 22007) {
                throw new Exception("Format de date invalide.");
            } else if ($e->getCode() == 23000) {
                throw new Exception("Un champ est invalide et ne fait pas partie de ceux présents (catégorie, compétition ou équipe).");
            }
            else {
                throw new Exception("Un match pour cette date ($date) et cette équipe ($equipe) existe déjà.");
            }
        }
    }

    public function supprimerMatch($numMatch) {
        $sql = 'SELECT * FROM T_CONVOCATION WHERE NumMatch = ?';
        $match = $this->executerRequete($sql, array($numMatch));
        $convocationPresente = ($match->rowCount() > 0);

        $sql = 'DELETE FROM T_MATCH WHERE NumMatch = ?';
        $this->executerRequete($sql, array($numMatch));

        if ($convocationPresente){
            echo json_encode(array('warning' => "Les convocations rédigées pour ce match ont également été supprimées."));
        }
        else {
            echo json_encode(array());
        }
    }

    public function modifierMatch($numMatch, $categorie, $competition, $equipe, $equipeadverse, $date, $heure, $terrain, $site) {
        $sql = 'UPDATE T_MATCH'
            . ' SET Categorie = ?, Competition = ?, Equipe = ?,'
            . ' EquipeAdverse = ?, Date = ?, Heure = ?,'
            . ' Terrain = ?, Site = ? '
            . ' WHERE NumMatch = ?';
        $this->executerRequete($sql, array($categorie, $competition, $equipe, $equipeadverse, $date, $heure, $terrain, $site, $numMatch));
    }
}