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
('Aude','audodo','Secretaire');

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


INSERT INTO T_MATCH (Equipe, Competition, EquipeAdverse, Date, Heure, Terrain, Site) VALUES
('SENIORS A', 'Amical', 'AMBILLOU ASVR 1', '2020-08-16', '14:45', NULL, 'AMBILLOU'),
('SENIORS A', 'Coupe de France', 'BRAIN/ALLONES UF 1', '2020-08-23', '15:00', 'STADE DE CONTADES', 'ALLONNES'),
('SENIORS A', 'Amical', 'ST GEMMES/LOIRE', '2020-08-30', '15:00', NULL, 'ST GEMMES/LOIRE'),
('SENIORS A', 'Coupe des Pays de la Loire', 'BEAUFORT EN VALLEE U 1', '2020-09-06', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'THOUARCE FC LAYON 1', '2020-09-13', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS A', 'Coupe des Pays de la Loire', 'DOUE LA FONTAINE RC 1', '2020-09-20', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'LE MAY SUR EVRE 1', '2020-09-27', '15:00', 'STADE MUNICIPAL 1', 'LE MAY SUR EVRE'),
('SENIORS A', 'Coupe des Pays de la Loire', 'CHEMILLE MELAY O 1', '2020-10-04', '15:00', 'STADE DE LA GABARDIÈRE 1', 'CHEMILLE EN ANJOU'),
('SENIORS A', 'D1 - Groupe A', 'ANGERS NDC 2', '2020-10-11', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS A', 'Coupe de l''Anjou', 'SEICHES MARCE AS 1', '2020-10-18', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'CHOLET JEUNE FRANCE 1', '2020-10-25', '15:00', 'STADE BORDAGE LUNEAU', 'CHOLET'),
('SENIORS A', 'D1 - Groupe A', 'ST SYLVAIN ANJOU AS 1', '2020-11-08', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'ANDREZE JUB-JALLAIS 1', '2020-11-15', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'PELLOUAILLES CORZE 1', '2020-11-22', '15:00', 'COMPLEXE SPORTIF RENÉ BOUBLIN', 'VERRIERES EN ANJOU'),
('SENIORS A', 'D1 - Groupe A', 'LES PONTS DE CE AS 1', '2020-11-29', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'SAUMUR OFC 3', '2020-12-06', '12:30', 'STADE DES RIVES DU THOUET N° 1', 'SAUMUR'),
('SENIORS A', 'D1 - Groupe A', 'LE LONGERON TORFOU 1', '2020-12-13', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'TOUTLEMONDE MAULEVR 1', '2021-01-17', '15:00', 'STADE PAUL FORMON', 'TOUTLEMONDE'),
('SENIORS A', 'D1 - Groupe A', 'SOMLOIRYZERNAY CP 1', '2021-01-24', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'ST MATH MENITRE FC 1', '2021-01-31', '15:00', 'STADE MAURICE TROUILLARD', 'LOIRE AUTHION'),
('SENIORS A', 'D1 - Groupe A', 'THOUARCE FC LAYON 1', '2021-02-07', '15:00', 'STADE DES RONDIÈRES', 'BELLEVIGNE EN LAYON'),
('SENIORS A', 'D1 - Groupe A', 'LE MAY SUR EVRE 1', '2021-02-14', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'TOUTLEMONDE MAULEVR 1', '2021-02-21', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'ANGERS NDC 2', '2021-03-14', '15:00', 'STADE ANDRÉ BERTIN 1', 'ANGERS'),
('SENIORS A', 'D1 - Groupe A', 'CHOLET JEUNE FRANCE 1', '2021-03-21', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'SOMLOIRYZERNAY CP 1', '2021-03-28', '15:00', 'STADE G. AIGUILLE', 'SOMLOIRE'),
('SENIORS A', 'D1 - Groupe A', 'ST SYLVAIN ANJOU AS 1', '2021-04-11', '15:00', 'COMPLEXE SPORTIF BOIS LA SALLE 1', 'VERRIERES EN ANJOU'),
('SENIORS A', 'D1 - Groupe A', 'ANDREZE JUB-JALLAIS 1', '2021-04-18', '15:00', 'STADE DU BORDAGE 1', 'BEAUPREAU EN MAUGES'),
('SENIORS A', 'D1 - Groupe A', 'PELLOUAILLES CORZE 1', '2021-04-25', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'LES PONTS DE CE AS 1', '2021-05-09', '15:00', 'STADE DE LA CHESNAIE 1', 'LES PONTS DE CE'),
('SENIORS A', 'D1 - Groupe A', 'SAUMUR OFC 3', '2021-05-16', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS A', 'D1 - Groupe A', 'LE LONGERON TORFOU 1', '2021-05-30', '15:00', 'STADE RAYMOND GABORIAU 1', 'SEVREMOINE'),
('SENIORS A', 'D1 - Groupe A', 'ST MATH MENITRE FC 1', '2021-06-06', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS B', 'Amical', 'ST CERBOUILLE 2', '2020-08-19', '19:00', 'STADE MUNICIPAL', 'CERSAY'),
('SENIORS B', 'Amical', 'R.C. DOUE LA FONTAINE', '2020-08-30', '13:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS B', 'Amical', 'ST MELAINE OLYMPIQUE SPORT', '2020-09-06', '12:30', NULL, 'ST MELAINE'),
('SENIORS B', 'D4 - Groupe E', 'ST MELAINE S/AUBANCE 2', '2020-09-13', '15:00', 'STADE JULIEN LAMBERT 1', 'ST MELAINE SUR AUBANCE'),
('SENIORS B', 'Coupe des Réserves', 'BOUCHEMAINE ES 3', '2020-09-20', '12:30', 'TERRAIN A', 'MARTIGNE'),
('SENIORS B', 'D4 - Groupe E', 'THOUARCE FC LAYON 2', '2020-09-27', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS B', 'Coupe des Réserves', 'VALANJOU AS 2', '2020-10-04', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS B', 'D4 - Groupe E', 'LE PUY VAUDELNAY ES 2', '2020-10-11', '12:30', 'STADE PAUL BOIVIN 1', 'LE PUY NOTRE DAME'),
('SENIORS B', 'Coupe des Réserves', 'ANGERS SCA 2', '2020-10-18', '12:30', 'STADE DE LA BARATERIE', 'ANGERS'),
('SENIORS B', 'D4 - Groupe E', 'VALANJOU AS 2', '2020-10-25', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS B', 'D4 - Groupe E', 'MONTREUIL BELLAY UA 1', '2020-11-08', '15:00', 'STADE GASTON AMY 1', 'MONTREUIL BELLAY'),
('SENIORS B', 'D4 - Groupe E', 'BRISSAC AUBANCE ES 3', '2020-11-15', '12:30', 'STADE DES ALLEUDS', 'LES ALLEUDS'),
('SENIORS B', 'D4 - Groupe E', 'DOUE LA FONTAINE RC 3', '2020-11-22', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS B', 'D4 - Groupe E', 'AMBILLOU ASVR 2', '2020-11-29', '15:00', 'STADE MUNICIPAL JOSEPH CHARGE', 'TUFFALUN'),
('SENIORS B', 'D4 - Groupe E', 'CORON OSTVC 2', '2020-12-06', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS B', 'D4 - Groupe E', 'ST HILAIRE VIHIERS 3', '2020-12-13', '12:30', 'STADE DU DOMINO 1', 'ST HILAIRE DU BOIS'),
('SENIORS B', 'D4 - Groupe E', 'SOMLOIRYZERNAY CP 4', '2021-01-31', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS B', 'D4 - Groupe E', 'ST MELAINE S/AUBANCE 2', '2021-02-07', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS B', 'D4 - Groupe E', 'THOUARCE FC LAYON 2', '2021-02-14', '15:00', 'STADE DES RONDIÈRES', 'BELLEVIGNE EN LAYON'),
('SENIORS B', 'D4 - Groupe E', 'LE PUY VAUDELNAY ES 2', '2021-03-14', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS B', 'D4 - Groupe E', 'VALANJOU AS 2', '2021-03-21', '15:00', 'STADE ALPHONSE LEROI 1', 'VALANJOU'),
('SENIORS B', 'D4 - Groupe E', 'MONTREUIL BELLAY UA 1', '2021-04-11', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS B', 'D4 - Groupe E', 'BRISSAC AUBANCE ES 3', '2021-04-18', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS B', 'D4 - Groupe E', 'DOUE LA FONTAINE RC 3', '2021-04-25', '12:30', 'STADE MARCEL HABERT 1', 'DOUE LA FONTAINE'),
('SENIORS B', 'D4 - Groupe E', 'AMBILLOU ASVR 2', '2021-05-09', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS B', 'D4 - Groupe E', 'CORON OSTVC 2', '2021-05-16', '15:00', 'STADE FLORIMOND COUGNAUD 1', 'VEZINS'),
('SENIORS B', 'D4 - Groupe E', 'ST HILAIRE VIHIERS 3', '2021-05-30', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS B', 'D4 - Groupe E', 'SOMLOIRYZERNAY CP 4', '2021-06-06', '12:30', 'STADE G. AIGUILLE', 'SOMLOIRE'),
('SENIORS C', 'Amical', 'F.C. DU LAYON', '2020-09-20', '13:00', NULL, 'THOUARCE'),
('SENIORS C', 'D5 - Groupe A', 'THOUARCE FC LAYON 3', '2020-09-27', '15:00', 'STADE DES RONDIÈRES', 'BELLEVIGNE EN LAYON'),
('SENIORS C', 'D5 - Groupe A', 'ST HILAIRE VIHIERS 4', '2020-10-11', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS C', 'D5 - Groupe A', 'GENNES LES ROSIERS 2', '2020-10-25', '12:30', 'STADE DE LA LUISETTE', 'LES ROSIERS SUR LOIRE'),
('SENIORS C', 'D5 - Groupe A', 'LE PUY VAUDELNAY ES 3', '2020-11-08', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS C', 'D5 - Groupe A', 'DOUE LA FONTAINE RC 4', '2020-11-15', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS C', 'D5 - Groupe A', 'AMBILLOU ASVR 3', '2020-11-22', '15:00', 'STADE MUNICIPAL JOSEPH CHARGE', 'TUFFALUN'),
('SENIORS C', 'D5 - Groupe A', 'SAUMUR BAYARD AS 3', '2020-11-29', '15:00', 'TERRAIN A', 'MARTIGNE'),
('SENIORS C', 'D5 - Groupe A', 'MONTILLIERS ES 3', '2020-12-06', '15:00', 'STADE RAMPILLON MAGNILS 1', 'MONTILLIERS'),
('SENIORS C', 'D5 - Groupe A', 'MONTREUIL BELLAY UA 2', '2021-02-07', '15:00', 'STADE GASTON AMY 1', 'MONTREUIL BELLAY'),
('SENIORS C', 'D5 - Groupe A', 'THOUARCE FC LAYON 3', '2021-02-14', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS C', 'D5 - Groupe A', 'ST HILAIRE VIHIERS 4', '2021-03-14', '12:30', 'STADE HENRI MANCEAU', 'ST PAUL DU BOIS'),
('SENIORS C', 'D5 - Groupe A', 'GENNES LES ROSIERS 2', '2021-03-21', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS C', 'D5 - Groupe A', 'LE PUY VAUDELNAY ES 3', '2021-04-11', '15:00', 'STADE PAUL BOIVIN 1', 'LE PUY NOTRE DAME'),
('SENIORS C', 'D5 - Groupe A', 'DOUE LA FONTAINE RC 4', '2021-04-18', '15:00', 'STADE MARCEL HABERT 1', 'DOUE LA FONTAINE'),
('SENIORS C', 'D5 - Groupe A', 'AMBILLOU ASVR 3', '2021-04-25', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS C', 'D5 - Groupe A', 'SAUMUR BAYARD AS 3', '2021-05-09', '15:00', 'STADE PIERRE DE BODMAN', 'SAUMUR'),
('SENIORS C', 'D5 - Groupe A', 'MONTILLIERS ES 3', '2021-05-16', '15:00', 'TERRAIN A ou B', 'MARTIGNE'),
('SENIORS C', 'D5 - Groupe A', 'MONTREUIL BELLAY UA 2', '2021-06-06', '15:00', 'TERRAIN A ou B', 'MARTIGNE');

