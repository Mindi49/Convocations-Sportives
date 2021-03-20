<?php
require_once 'Modele/Modele.php';

class Joueur extends Modele {
    // TODO : voir où on met les absences / blessés / suspendus / exempts -> attribut ETAT check in (absent,blessé,suspendu,exempt,disponible)
    // liste de tous les joueurs présent dans la catégorie = effectif
    // type de licence

    public function getJoueur($idJoueur) {
        $sql = 'SELECT * FROM T_JOUEUR'
            . ' WHERE IdJoueur=?';
        $joueur = $this->executerRequete($sql, array($idJoueur));
        if ($joueur->rowCount() > 0)
            return $joueur->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun joueur ne correspond à cet id : '$idJoueur'");
    }
    public function getJoueurs() {
        $sql = 'SELECT *'
            . ' FROM T_JOUEUR'
            . ' ORDER BY Nom';
        $effectifs = $this->executerRequete($sql);
        return $effectifs->fetchAll();
    }

    public function getJoueursLicencies() {
        $sql = 'SELECT *'
            . ' FROM T_JOUEUR WHERE Licencie = \'oui\''
            . ' ORDER BY Nom';
        $effectifs = $this->executerRequete($sql);
        return $effectifs->fetchAll();
    }

    public function getJoueursNonLicencies() {
        $sql = 'SELECT *'
            . ' FROM T_JOUEUR WHERE Licencie = \'non\''
            . ' ORDER BY Nom';
        $effectifs = $this->executerRequete($sql);
        return $effectifs->fetchAll();
    }

    public function ajouterJoueur($nom, $prenom, $categorie, $licencie='non') {
        $sql = 'INSERT INTO T_JOUEUR(Nom,Prenom,Categorie,Licencie)'
            . ' VALUES(?, ?, ?, ?)';
        $this->executerRequete($sql, array($nom, $prenom, $categorie, $licencie));
    }

    public function changerCategorie($idJoueur, $categorie) {
        $sql = 'UPDATE T_JOUEUR'
            . ' SET Categorie = ?'
            . ' WHERE (IdJoueur = ?)';
        $this->executerRequete($sql, array($categorie, $idJoueur));

    }

    public function ajouterLicence($idJoueur) {
        $sql = 'UPDATE T_JOUEUR'
            . ' SET Licencie = "oui"'
            . ' WHERE (IdJoueur = ?)';
        $this->executerRequete($sql, array($idJoueur));
    }

    public function retirerLicence($idJoueur) {
        $sql = 'UPDATE T_JOUEUR'
            . ' SET Licencie = "non"'
            . ' WHERE (IdJoueur = ?)';
        $this->executerRequete($sql, array($idJoueur));
    }

    public function supprimerJoueur($idJoueur) {
        $sql = 'DELETE FROM T_JOUEUR'
            . ' WHERE (IdJoueur = ?)';
        $this->executerRequete($sql, array($idJoueur));
    }


}