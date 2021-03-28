<?php

require_once 'Modele/Modele.php';

/**
 * Fournit les services d'accès aux absences.
 */
class Absence extends Modele {
    /**
     * Renvoie la liste des absences.
     *
     * @return array    La liste des absences.
     */
    public function getAbsences() {
        $sql = 'SELECT A.IdJoueur as IdJoueur,Nom,Prenom,Date,Motif FROM T_JOUEUR J JOIN T_ABSENCE A ON J.IdJoueur = A.IdJoueur ORDER BY Date';
        $absence = $this->executerRequete($sql);
        return $absence->fetchAll();
    }

    /**
     * Vérifie si un joueur est absent à une date donnée.
     * Si oui, renvoie les informations sur cette absence.
     *
     * @param $idJoueur     L'identifiant du joueur.
     * @param $date         La date de l'absence à vérifier.
     * @return int|mixed    L'absence en question ou 0 si le joueur n'est pas absent à cette date.
     */
    public function isAbsent($idJoueur,$date) {
        $sql = 'SELECT *'
            . ' FROM T_ABSENCE'
            . ' WHERE IdJoueur = ? AND Date = ?';
        $absence = $this->executerRequete($sql, array($idJoueur,$date));
        if ($absence->rowCount() > 0) {
            return $absence->fetch();
        }
        else {
            return 0;
        }
    }

    /**
     * Ajoute une absence d'un joueur pour une date
     *
     * @param $idJoueur     L'identifiant du joueur à noter absent.
     * @param $date         La date de l'absence.
     * @param $motif        Le motif de l'absence.
     * @throws Exception    Exception lancée si le joueur est déjà absent à cette date.
     */
    public function ajouterAbsence($idJoueur,$date,$motif) {
        try {
            $sql = 'INSERT INTO T_ABSENCE VALUES(?,?,?)';
            $this->executerRequete($sql, array($idJoueur, $date, $motif));
        } catch (Exception $e) {
            throw new Exception("Une absence de ce joueur existe déjà pour cette date.");
        }
    }

    /**
     * Supprime une absence d'un joueur à une date.
     *
     * @param $idJoueur L'identifiant du joueur dont on retire l'absence.
     * @param $date     La date de l'absence à retirer.
     */
    public function supprimerAbsence($idJoueur,$date) {
        $sql = 'DELETE FROM T_ABSENCE WHERE IdJoueur = ? and Date = ?';
        $this->executerRequete($sql, array($idJoueur, $date));
    }
}