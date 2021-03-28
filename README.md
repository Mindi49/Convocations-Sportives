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

