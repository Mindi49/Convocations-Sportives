DELETE FROM T_ABSENCE;
DELETE FROM T_CONVOCATION;
DELETE FROM T_MATCH;
DELETE FROM T_JOUEUR;
DELETE FROM T_EQUIPE;
DELETE FROM T_COMPETITION;
DELETE FROM T_CATEGORIE;
DELETE FROM T_UTILISATEUR;

ALTER TABLE T_JOUEUR AUTO_INCREMENT = 1;
ALTER TABLE T_MATCH AUTO_INCREMENT = 1;
ALTER TABLE T_CONVOCATION AUTO_INCREMENT = 1;

INSERT INTO T_UTILISATEUR VALUES
('Deschamps','didou','Entraineur'),
('Aude','audoudou','Secretaire');

INSERT INTO T_CATEGORIE VALUES
('SENIORS');

INSERT INTO T_COMPETITION VALUES
('Amical'),
('Coupe de France'),
('Coupe de l''Anjou'),
('Coupe des Pays de la Loire'),
('Coupe des Réserves'),
('D1 - Groupe A'),
('D4 - Groupe E'),
('D5 - Groupe A'),
('Coupe du Monde');

INSERT INTO T_EQUIPE VALUES
('SENIORS A'),
('SENIORS B'),
('SENIORS C');


INSERT INTO T_JOUEUR (Prenom,Nom) VALUES
('Al', 'Ambiqué'),
('Bonnie', 'Dée'),
('Ève', 'Anescense'),
('Hal', 'Aniche'),
('Hubert', 'Gamote'),
('Maxime', 'Ome'),
('José', 'Patelefaire'),
('Marie', 'Covert'),
('Marie', 'Nière'),
('Marie', 'Rouanna'),
('Marion', 'Lait'),
('Marty', 'Ni'),
('Maude', 'Cologne'),
('Mehdi', 'Zan'),
('Mélusine', 'Engraiv'),
('Mouss', 'Tache'),
('Otto', 'Psie'),
('Paul', 'Iglotte'),
('Paul', 'Arbère'),
('Pierre', 'Oglyphe'),
('Sam', 'Soule'),
('Terry', 'Dicule'),
('Théo', 'Jasmin');

INSERT INTO T_MATCH (Categorie,Competition,Equipe,EquipeAdverse,Date,Heure,Terrain,Site) VALUES
('SENIORS','Amical','SENIORS A', 'AMBILLOU ASVR 1', CURRENT_DATE, '14:45',NULL,'ALLONNES'),
('SENIORS','Coupe des Pays de la Loire','SENIORS B', 'ADVERSE', CURRENT_DATE, '19:15',NULL,'Angers'),
('SENIORS','Coupe de l''Anjou','SENIORS C', 'ANGERS NDC 2', '2021-04-02', '15:00',NULL,'Laval'),
('SENIORS','Coupe de France','SENIORS A', 'CORON OSTVC 2', CURRENT_DATE, '11:20',NULL,NULL);

