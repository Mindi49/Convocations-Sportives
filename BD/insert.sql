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
('Deschamps','didou','entraineur'),
('Aude','audoudou','secretaire');

INSERT INTO T_CATEGORIE VALUES
('SENIOR'),
('JUNIOR NON UTILISEE');
('CADET NON UTILISEE');

INSERT INTO T_COMPETITION VALUES
('Amical'),
('Coupe de France'),
('Coupe de l''Anjou'),
('Coupe des Pays de la Loire');
('Coupe du Monde');

INSERT INTO T_EQUIPE VALUES
('SENIOR A'),
('SENIOR B'),
('SENIOR C');


INSERT INTO T_JOUEUR (Nom,Prenom,Categorie,Licencie) VALUES
('Ome','Maxime','SENIOR','oui'),
('Tache','Mouss','SENIOR','non'),
('Nière','Marie','SENIOR','oui'),
('Ambiqué','Al','SENIOR','oui'),
('Dée','Bonnie','SENIOR','non'),
('Anescense','Ève','SENIOR','non');

INSERT INTO T_MATCH (Categorie,Competition,Equipe,EquipeAdverse,Date,Heure,Terrain,Site) VALUES
('SENIOR','Amical','SENIOR A', 'ADVERSE', CURRENT_DATE, '19:15','Terrain de Foot','Saumur'),
('SENIOR','Coupe des Pays de la Loire','SENIOR B', 'ADVERSE', CURRENT_DATE, '19:15',NULL,'Angers'),
('SENIOR','Coupe de France','SENIOR C', 'CUCULE', '2021-03-14', '15:00',NULL,'Laval'),
('SENIOR','Coupe de France','SENIOR A', 'AZE', CURRENT_DATE, '11:20',NULL,NULL);

