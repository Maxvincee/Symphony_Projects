# 🎮 Projet Symfony - Gestion de Jeux Vidéo

## 📋 Informations du Projet

**Module** : R5A.05 - Programmation Avancée & Symfony  
**Formation** : BUT Informatique - 3ème année  
**Technologies** : Symfony 7.3, PHP 8.2, MySQL/MariaDB, Bootstrap 5

---

## 🚀 Installation

### Prérequis

-   PHP 8.2 ou supérieur
-   Composer
-   MySQL/MariaDB
-   Symfony CLI (optionnel mais recommandé)

### Étapes d'Installation

1. **Cloner/Extraire le projet**

```bash
cd mon_projet
```

2. **Installer les dépendances**

```bash
composer install
```

3. **Configurer la base de données**

Créer un fichier `.env.local` :

```env
DATABASE_URL="mysql://root:root@127.0.0.1:3306/bdd_mon_projet?serverVersion=MariaDB-10.6.5&charset=utf8mb4"
```

4. **Créer la base de données**

```bash
php bin/console doctrine:database:create
```

5. **Importer le fichier SQL fourni**

```bash
mysql -u root -p bdd_mon_projet < export_bdd.sql
```

OU exécuter les migrations :

```bash
php bin/console doctrine:migrations:migrate
```

6. **Charger les fixtures (données de test)**

```bash
php bin/console doctrine:fixtures:load
```

7. **Lancer le serveur**

```bash
symfony server:start
```

OU

```bash
php -S localhost:8000 -t public
```

8. **Accéder à l'application**

Ouvrir : http://127.0.0.1:8000

---

## 🎯 Fonctionnalités

### Gestion des Jeux Vidéo

-   ✅ Liste des jeux avec pagination
-   ✅ Ajout de jeux avec upload d'image
-   ✅ Modification de jeux
-   ✅ Suppression de jeux
-   ✅ Consultation détaillée

### Gestion des Genres

-   ✅ CRUD complet
-   ✅ Activation/désactivation
-   ✅ Association aux jeux

### Gestion des Éditeurs

-   ✅ CRUD complet
-   ✅ Informations (pays, site web)

### Gestion des Développeurs

-   ✅ CRUD complet
-   ✅ Informations détaillées

### Gestion des Collections

-   ✅ Collections par utilisateur
-   ✅ 8 statuts de jeux (Possédé, Souhaité, etc.)
-   ✅ Prix d'achat et calcul de réduction
-   ✅ Commentaires
-   ✅ Dates de modification

### API REST

-   ✅ 8 endpoints JSON
-   ✅ GET `/api/jeu_video` - Liste des jeux
-   ✅ GET `/api/jeu_video/{id}` - Un jeu
-   ✅ GET `/api/genre` - Liste des genres
-   ✅ GET `/api/genre/{id}` - Un genre
-   ✅ GET `/api/utilisateur/{id}/collection` - Collection
-   ✅ DELETE `/api/genre/{id}` - Supprimer genre
-   ✅ GET `/api/ping` - Ping/pong
-   ✅ GET `/api/healthcheck` - État de santé

### Système de Logs

-   ✅ Logging avec Monolog
-   ✅ Rotation automatique (30 fichiers)
-   ✅ Format : `dev-YYYY-MM-DD.log`
-   ✅ Logging de toutes les actions

---

## 🔧 Configuration

### Environnements

**Développement (par défaut)** :

```env
APP_ENV=dev
APP_DEBUG=1
```

**Production** :

```env
APP_ENV=prod
APP_DEBUG=0
```

### Changer d'Environnement

**Méthode 1** : Modifier `.env.local`

```env
APP_ENV=prod
APP_DEBUG=0
```

**Méthode 2** : Ligne de commande

```bash
# Vider le cache en prod
php bin/console cache:clear --env=prod

# Réchauffer le cache
php bin/console cache:warmup --env=prod
```

### Profiler Symfony

**Activer** (dev) :

```yaml
# config/packages/web_profiler.yaml
when@dev:
    web_profiler:
        toolbar: true
```

**Désactiver** :

```yaml
when@dev:
    web_profiler:
        toolbar: false
```

---

## 📊 Structure de la Base de Données

### Entités Principales

-   **JeuVideo** : Jeux vidéo (titre, prix, date sortie, image, etc.)
-   **Genre** : Genres de jeux (Action, RPG, etc.)
-   **Editeur** : Éditeurs de jeux
-   **Developpeur** : Développeurs de jeux
-   **Utilisateur** : Utilisateurs avec collections
-   **Collect** : Collections (relation User-Jeu avec statut)

### Relations

-   JeuVideo ↔ Genre (ManyToOne)
-   JeuVideo ↔ Editeur (ManyToOne)
-   JeuVideo ↔ Developpeur (ManyToOne)
-   Utilisateur ↔ Collect (OneToMany)
-   JeuVideo ↔ Collect (OneToMany)

---

## 🧪 Tests

### Tester l'Application

1. **Page d'accueil** : http://127.0.0.1:8000
2. **Liste des jeux** : http://127.0.0.1:8000/jeu_video
3. **Collections** : http://127.0.0.1:8000/collect

### Tester l'API

1. **Ping** : http://127.0.0.1:8000/api/ping
2. **Jeux** : http://127.0.0.1:8000/api/jeu_video
3. **Healthcheck** : http://127.0.0.1:8000/api/healthcheck

### Consulter les Logs

```bash
# Logs du jour
tail -f var/log/dev-2025-12-11.log

# Tous les logs
ls -lh var/log/
```

---

## 📦 Commandes Utiles

### Cache

```bash
# Vider le cache
php bin/console cache:clear

# Vider le cache prod
php bin/console cache:clear --env=prod
```

### Base de Données

```bash
# Créer la BDD
php bin/console doctrine:database:create

# Mettre à jour le schéma
php bin/console doctrine:schema:update --force

# Charger les fixtures
php bin/console doctrine:fixtures:load
```

### Informations

```bash
# Informations sur l'application
php bin/console about

# Liste des routes
php bin/console debug:router

# Liste des services
php bin/console debug:container
```

---

## 🎬 Données de Démonstration

Le projet inclut des fixtures avec :

-   12 jeux vidéo
-   6 genres
-   5 éditeurs
-   5 développeurs
-   6 utilisateurs
-   36 entrées de collection

---

## 🔐 Sécurité

-   ✅ Pas de mots de passe en dur
-   ✅ CSRF protection activée
-   ✅ Validation des formulaires
-   ✅ Gestion des erreurs

---

## 📝 Auteurs

**Binôme** : VINCENT Maxence & DURAND Ruben

**Date** : Décembre 2025

---

## 📚 Documentation

-   [Symfony Documentation](https://symfony.com/doc/current/index.html)
-   [Doctrine ORM](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/)
-   [Twig Documentation](https://twig.symfony.com/doc/3.x/)
-   [Bootstrap 5](https://getbootstrap.com/docs/5.3/)

---

## 🆘 Support

En cas de problème :

1. Vérifier les logs : `var/log/dev-YYYY-MM-DD.log`
2. Vider le cache : `php bin/console cache:clear`
3. Vérifier la configuration de la BDD dans `.env.local`
4. Consulter la documentation Symfony
