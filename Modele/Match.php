<?php

require_once 'Modele/Modele.php';

/**
 * Fournit les services d'accès aux matchs.
 */
class Match extends Modele {
    /**
     * Renvoie la liste des matchs.
     *
     * @return array La liste des matchs.
     */
    public function getMatchs() {
        $sql = 'SELECT * FROM T_MATCH ORDER BY Date';
        $categ = $this->executerRequete($sql);
        return $categ->fetchAll();
    }

    /**
     * Renvoie les informations sur un match.
     *
     * @param $numMatch     L'identifiant du match.
     * @return mixed        Les informations sur le match.
     * @throws Exception    Exception lancée si le match n'est pas présent.
     */
    public function getMatch($numMatch) {
        $sql = 'SELECT *'
            . ' FROM T_MATCH'
            . ' WHERE NumMatch = ?' ;;
        $match = $this->executerRequete($sql, array($numMatch));
        if ($match->rowCount() > 0) {
            return $match->fetch();
        }
        else {
            throw new Exception("Le match demandé n'existe pas ou a été supprimé.");
        }
    }

    /**
     * Ajoute un match.
     *
     * @param $categorie        La catégorie pour laquelle a lieu le match.
     * @param $competition      La compétition associée.
     * @param $equipe           L'équipe associée.
     * @param $equipeadverse    L'équipe adverse.
     * @param $date             La date du match.
     * @param $heure            L'heure du match.
     * @param $terrain          Le terrain sur lequel se déroule le match.
     * @param $site             Le lieu / ville dans où se déroule la rencontre.
     * @throws Exception        Exception lancée si des données sont incorrectes ou qu'un match existe déjà.
     */
    public function ajouterMatch($categorie, $competition, $equipe, $equipeadverse, $date, $heure, $terrain, $site) {
        try {
            $sql = 'INSERT INTO T_MATCH (Categorie,Competition,Equipe,EquipeAdverse,Date,Heure,Terrain,Site) VALUES(?,?,?,?,?,?,?,?)';
            $this->executerRequete($sql, array($categorie, $competition, $equipe, $equipeadverse, $date, $heure, $terrain, $site));
        } catch (Exception $e) {
            if ($e->getCode() == 22007) {
                throw new Exception("Format de date invalide.");
            } else {
                throw new Exception("Un match pour cette date ($date) et cette équipe ($equipe) existe déjà. Ou un champ est invalide et ne fait pas partie de ceux présents (catégorie, compétition ou équipe).");
            }
        }
    }

    /**
     * Supprime un match.
     *
     * @param $numMatch L'identifiant du match.
     */
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

    /**
     * Modifie un match.
     *
     * @param $numMatch         L'identifiant du match modifié.
     * @param $categorie        La catégorie pour laquelle a lieu le match.
     * @param $competition      La compétition associée.
     * @param $equipe           L'équipe associée.
     * @param $equipeadverse    L'équipe adverse.
     * @param $date             La date du match.
     * @param $heure            L'heure du match.
     * @param $terrain          Le terrain sur lequel se déroule le match.
     * @param $site             Le lieu / ville dans où se déroule la rencontre.
     */
    public function modifierMatch($numMatch, $categorie, $competition, $equipe, $equipeadverse, $date, $heure, $terrain, $site) {
        try {
            $sql = 'UPDATE T_MATCH'
            . ' SET Categorie = ?, Competition = ?, Equipe = ?,'
            . ' EquipeAdverse = ?, Date = ?, Heure = ?,'
            . ' Terrain = ?, Site = ? '
            . ' WHERE NumMatch = ?';
        $this->executerRequete($sql, array($categorie, $competition, $equipe, $equipeadverse, $date, $heure, $terrain, $site, $numMatch));
        } catch (Exception $e) {
            if ($e->getCode() == 22007) {
                throw new Exception("Format de date invalide.");
            } else {
                throw new Exception("Un match pour cette date ($date) et cette équipe ($equipe) existe déjà. Ou un champ est invalide et ne fait pas partie de ceux présents (catégorie, compétition ou équipe).");
            }
        }
    }
}