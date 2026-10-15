# CV dynamique — PHP / MySQL

Premier site web dynamique réalisé à Epitech (B-WEB-100) : un CV en ligne pour deux personnes, dont le contenu est stocké en base de données et modifiable depuis le site.

## Fonctionnalités

- Affichage du CV de chaque personne : identité, photo, compétences, expériences, formations
- Formulaires d'édition pour ajouter, modifier ou supprimer chaque élément
- Formulaire de contact
- Environnement complet conteneurisé (serveur web + base MySQL)

## Stack technique

| Couche | Technologies |
| --- | --- |
| Front-end | HTML, CSS, JavaScript |
| Back-end | PHP (mysqli) |
| Base de données | MySQL 8 — tables `users`, `skills`, `experience`, `education` |
| Déploiement | Docker, Docker Compose |

## Lancer le projet

```bash
docker compose up --build
```

Le site est accessible sur http://localhost:8080.

## Limites connues

C'est un projet de début de première année. Les requêtes SQL sont construites par concaténation de chaînes, ce qui les rend vulnérables aux injections SQL. La correction consisterait à utiliser des requêtes préparées (`mysqli_prepare` ou PDO avec paramètres liés) et à échapper les sorties HTML. Les projets suivants (E-Todo, Job Aggregator) utilisent des requêtes paramétrées.

## Auteurs

Philippe Rastoul et Mathieu Jin — Epitech, 2025.
