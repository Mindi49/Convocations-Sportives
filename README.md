# Convocations Sportives MVC

## Installation

- Installer `Twig 3.3`  avec `composer`

`[blog_mvc_objet]$ php composer.phar install` 

- Créer la base de données `convocation`

```
[blog_mvc_objet]$ mariadb -u etudiant -p
Enter password: 
...
MariaDB [(none)]> CREATE DATABASE IF NOT EXISTS convocation CHARACTER SET=utf8mb4 COLLATE utf8mb4_unicode_ci;
Query OK, 1 row affected (0.000 sec)
MariaDB [(none)]> exit;
Bye
[blog_mvc_objet]$ mariadb -u etudiant -p convocation < BD/convocation.sql 
Enter password: 
[blog_mvc_objet]$ mariadb -u etudiant -p convocation < BD/insert.sql 
Enter password:
```

- Visiter la [page d'accueil](http://localhost/devweb/PROJET/Convocations_sportives_MVC/index.php)