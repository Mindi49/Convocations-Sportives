# Convocations Sportives MVC

## Installation

- Installer `Twig 3.3`  avec `composer`

`[Convocations-Sportives]$ php composer.phar install` 

- Créer la base de données `convocation`

```
[Convocations-Sportives]$ mariadb -u etudiant -p
Enter password: 
...
MariaDB [(none)]> CREATE DATABASE IF NOT EXISTS convocation CHARACTER SET=utf8mb4 COLLATE utf8mb4_unicode_ci;
Query OK, 1 row affected (0.000 sec)
MariaDB [(none)]> exit;
Bye

[Convocations-Sportives]$ mariadb -u etudiant -p convocation < BD/convocation.sql 
Enter password: 
[Convocations-Sportives]$ mariadb -u etudiant -p convocation < BD/insert.sql 
Enter password:
```

- Les identifiants et mot de passe de la base de donnée se trouvent dans le fichier `BD/config.ini`.


## Informations complémentaires


Pour se connecter sur le site en tant que :
- Secrétaire :
```
Nom d'utilisateur	: Aude
Mot de passe		: audodo
```
- Entraîneur :
```
Nom d'utilisateur	: Deschamps
Mot de passe		: didou
```


## Liens utiles 
L'ensemble des fichiers ainsi que les autres versions sont disponibles sur [GitHub](https://github.com/Mindi49/Convocations-Sportives).
