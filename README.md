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

### Page d'Accueil

-   ✅ Tableau de bord avec statistiques en temps réel
-   ✅ 3 cartes de statistiques (Jeux, Genres, Utilisateurs)
-   ✅ Affichage des 3 derniers jeux ajoutés
-   ✅ Actions rapides (Ajouter jeu, Collection, API)
-   ✅ Design moderne avec cartes sombres cohérentes
-   ✅ Navigation intuitive vers toutes les sections

### Gestion des Jeux Vidéo

-   ✅ Liste des jeux avec cartes modernes
-   ✅ Ajout de jeux avec upload d'image
-   ✅ Modification de jeux
-   ✅ Suppression de jeux avec confirmation
-   ✅ Consultation détaillée avec toutes les informations
-   ✅ Badge de genre sur chaque jeu
-   ✅ Affichage des utilisateurs possédant le jeu

### Gestion des Genres

-   ✅ CRUD complet
-   ✅ Activation/désactivation
-   ✅ Association aux jeux
-   ✅ Affichage des jeux par genre

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

### Pages d'Erreur Personnalisées

-   ✅ Page 404 - Page non trouvée
-   ✅ Page 403 - Accès refusé
-   ✅ Page 500 - Erreur serveur
-   ✅ Design moderne cohérent
-   ✅ Illustrations SVG animées
-   ✅ Navigation intuitive

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
    - Tableau de bord avec statistiques
    - 3 derniers jeux ajoutés
    - Actions rapides
2. **Liste des jeux** : http://127.0.0.1:8000/jeu_video
3. **Genres** : http://127.0.0.1:8000/genre
4. **Collections** : http://127.0.0.1:8000/collect
5. **Éditeurs** : http://127.0.0.1:8000/editeur
6. **Développeurs** : http://127.0.0.1:8000/developpeur

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

### Tester les Pages d'Erreur Personnalisées

**Important** : Les pages d'erreur personnalisées ne s'affichent qu'en **mode production** !

#### Méthode 1 : Passer en Mode Production

1. **Créer/Modifier `.env.local`** :

```env
APP_ENV=prod
APP_DEBUG=0
```

2. **Vider le cache** :

```bash
php bin/console cache:clear --env=prod
php bin/console cache:warmup --env=prod
```

3. **Tester les pages** :

-   **404** : http://127.0.0.1:8000/page-qui-nexiste-pas
-   **500** : Créer une erreur volontaire dans un contrôleur

4. **Repasser en mode dev** (après les tests) :

```env
APP_ENV=dev
APP_DEBUG=1
```

#### Méthode 2 : Routes de Test (Temporaire)

Ajouter dans un contrôleur (ex: `HomeController`) :

```php
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/test-404', name: 'test_404')]
public function test404(): Response
{
    throw new NotFoundHttpException('Test de la page 404');
}

#[Route('/test-500', name: 'test_500')]
public function test500(): Response
{
    throw new \Exception('Test de la page 500');
}
```

Puis tester :

-   http://127.0.0.1:8000/test-404
-   http://127.0.0.1:8000/test-500

**N'oubliez pas de supprimer ces routes après les tests !**

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

## 🔧 Dépannage (Troubleshooting)

### ⚠️ Problèmes Courants Après Clone/Installation

#### 1. Pages Blanches (Développeur, Éditeur, etc.)

**Symptômes** : Pages complètement blanches, pas d'erreur affichée

**Solutions** :

```bash
# 1. Vider le cache
php bin/console cache:clear

# 2. Régénérer l'autoload
composer dump-autoload

# 3. Vérifier les logs
tail -f var/log/dev-YYYY-MM-DD.log
```

**Vérifier aussi** :

-   Le fichier `.env.local` existe et contient la bonne config BDD
-   Les dossiers `var/cache` et `var/log` sont accessibles en écriture

---

#### 2. Erreur "Cannot upload file" ou Images Manquantes

**Symptômes** : Impossible d'ajouter un jeu avec image, images non affichées

**Solution** :

```bash
# Créer le dossier uploads s'il n'existe pas
mkdir public\uploads

# Ou sur Linux/Mac
mkdir -p public/uploads
chmod 777 public/uploads
```

**Vérifier** : Le dossier `public/uploads` doit exister et être accessible en écriture.

---

#### 3. Erreur "Connection refused" ou "Access denied"

**Symptômes** : Impossible de se connecter à la base de données

**Solutions** :

1. **Vérifier que MySQL/MariaDB est démarré**

    - Windows : Vérifier dans les Services
    - XAMPP : Démarrer MySQL dans le panneau de contrôle

2. **Vérifier `.env.local`** :

```env
DATABASE_URL="mysql://root:root@127.0.0.1:3306/bdd_mon_projet?serverVersion=MariaDB-10.6.5&charset=utf8mb4"
```

3. **Tester la connexion** :

```bash
mysql -u root -p
# Entrer le mot de passe (root ou vide)
```

---

#### 4. Erreur "Table doesn't exist"

**Symptômes** : Erreur SQL mentionnant une table manquante

**Solution** : Réimporter la base de données

```bash
# 1. Supprimer la BDD existante
php bin/console doctrine:database:drop --force

# 2. Recréer la BDD
php bin/console doctrine:database:create

# 3. Importer le fichier SQL
mysql -u root -p bdd_mon_projet < export_bdd.sql
```

---

#### 5. Erreur 500 ou "An error occurred"

**Symptômes** : Erreur 500, message générique

**Solutions** :

```bash
# 1. Activer le mode debug (si désactivé)
# Dans .env.local :
APP_DEBUG=1

# 2. Vider le cache
php bin/console cache:clear

# 3. Consulter les logs détaillés
cat var/log/dev-YYYY-MM-DD.log
```

---

#### 6. "Class not found" ou "Namespace not found"

**Symptômes** : Erreur PHP sur une classe introuvable

**Solution** :

```bash
# Régénérer l'autoload de Composer
composer dump-autoload

# Si ça ne suffit pas, réinstaller les dépendances
rm -rf vendor
composer install
```

---

### 📋 Checklist Complète Après Clone

Si votre collègue a cloné le projet, demandez-lui de suivre ces étapes **dans l'ordre** :

```bash
# 1. Se placer dans le projet
cd my_project

# 2. Installer les dépendances
composer install

# 3. Créer .env.local
# Copier le contenu suivant dans .env.local :
DATABASE_URL="mysql://root:root@127.0.0.1:3306/bdd_mon_projet?serverVersion=MariaDB-10.6.5&charset=utf8mb4"
APP_ENV=dev
APP_DEBUG=1

# 4. Créer la base de données
php bin/console doctrine:database:create

# 5. Importer le fichier SQL
mysql -u root -p bdd_mon_projet < export_bdd.sql
# Entrer le mot de passe MySQL quand demandé

# 6. Créer le dossier uploads
mkdir public\uploads

# 7. Vider le cache
php bin/console cache:clear

# 8. Vérifier que tout est OK
php bin/console about

# 9. Lancer le serveur
symfony server:start

# 10. Tester l'application
# Ouvrir : http://127.0.0.1:8000
```

---

### 🔍 Vérifier les Logs

En cas de problème, **toujours consulter les logs** :

```bash
# Voir les dernières erreurs
tail -f var/log/dev-YYYY-MM-DD.log

# Ou ouvrir le fichier directement
# Le fichier se trouve dans : var/log/dev-2025-12-11.log
```

Les logs vous donneront l'erreur exacte avec le fichier et la ligne concernés.

---

### 💡 Astuce : Comparer les Configurations

Si ça marche chez vous mais pas chez votre collègue :

1. **Comparer les fichiers `.env.local`**
2. **Comparer les versions PHP** : `php -v`
3. **Comparer les versions Composer** : `composer --version`
4. **Vérifier que la BDD est identique** : même structure et données

---

## 🆘 Support

En cas de problème persistant :

1. **Vérifier les logs** : `var/log/dev-YYYY-MM-DD.log`
2. **Vider le cache** : `php bin/console cache:clear`
3. **Vérifier la configuration BDD** dans `.env.local`
4. **Suivre la checklist de dépannage** ci-dessus
5. **Consulter la documentation Symfony** : https://symfony.com/doc
