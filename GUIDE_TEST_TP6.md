# Guide de Test - TP6 Collections

## 🧪 Comment tester l'application

### 1. Accéder à l'application

Ouvrez votre navigateur et allez sur : **http://127.0.0.1:8000**

### 2. Tester la liste des collections

1. Cliquez sur **"Collections"** dans la navbar
2. Vous devriez voir 6 utilisateurs affichés en cards
3. Vérifiez que :
    - Les avatars s'affichent correctement
    - Le nombre de jeux est correct pour chaque utilisateur
    - Emma ROBERT a "Aucun jeu dans la collection"

### 3. Tester le détail d'une collection

1. Cliquez sur **"Voir la collection"** de Denis DUPONT
2. Vérifiez que :
    - Le tableau affiche 8 jeux
    - Les badges de statut sont colorés (EN_COURS, TERMINE, POSSEDE, etc.)
    - Les prix sont affichés avec le symbole €
    - Les dates sont au format français (dd/mm/yyyy)
    - Les commentaires s'affichent
    - Les boutons ✏️ et 🗑️ sont présents

### 4. Tester l'ajout d'un jeu à une collection

1. Depuis la collection de Denis, cliquez sur **"Ajouter un jeu"**
2. Remplissez le formulaire :
    - Sélectionnez un utilisateur
    - Sélectionnez un jeu
    - Choisissez un statut
    - Ajoutez un prix (optionnel)
    - Ajoutez une date d'achat (optionnel)
    - Ajoutez un commentaire (optionnel)
3. Cliquez sur **"Enregistrer"**
4. Vérifiez que vous êtes redirigé vers la collection de l'utilisateur
5. Vérifiez que le nouveau jeu apparaît dans la liste

### 5. Tester la modification d'un item

1. Dans une collection, cliquez sur le bouton **✏️** d'un jeu
2. Modifiez le statut ou le commentaire
3. Cliquez sur **"Enregistrer les modifications"**
4. Vérifiez que les changements sont bien pris en compte

### 6. Tester la suppression d'un item

1. Dans une collection, cliquez sur le bouton **🗑️** d'un jeu
2. Confirmez la suppression dans la popup
3. Vérifiez que le jeu a bien été supprimé de la collection

### 7. Tester l'affichage des utilisateurs dans les jeux

1. Allez sur **"Jeux Vidéo"** dans la navbar
2. Regardez les cards des jeux
3. Vérifiez que :
    - La section "👥 Possédé par :" s'affiche pour certains jeux
    - Les pseudos sont affichés en badges verts
    - Les badges sont cliquables et mènent à la collection de l'utilisateur
    - Si plus de 3 utilisateurs, le message "+X autres" s'affiche

### 8. Tester la navigation

1. Depuis la liste des jeux, cliquez sur un badge utilisateur
2. Vous devriez arriver sur la collection de cet utilisateur
3. Cliquez sur le titre d'un jeu dans la collection
4. Vous devriez arriver sur la fiche détaillée du jeu
5. Utilisez le breadcrumb pour naviguer

## ✅ Points à vérifier

### Design et CSS

-   [ ] Le thème sombre est cohérent partout
-   [ ] Les badges de statut ont des couleurs différentes
-   [ ] Les hover effects fonctionnent sur les cards
-   [ ] Les tableaux sont bien stylisés
-   [ ] Les boutons ont un style cohérent

### Fonctionnalités

-   [ ] Toutes les routes fonctionnent
-   [ ] Les formulaires se soumettent correctement
-   [ ] Les redirections sont appropriées
-   [ ] Les messages de confirmation s'affichent
-   [ ] Les relations entre entités fonctionnent

### Données

-   [ ] Les fixtures sont chargées (6 utilisateurs, 36 items)
-   [ ] Tous les statuts sont représentés
-   [ ] Les dates sont au format français
-   [ ] Les prix sont affichés avec €
-   [ ] Les commentaires s'affichent correctement

## 🐛 En cas de problème

Si vous rencontrez des erreurs :

1. Vérifiez que le serveur Symfony tourne : `symfony server:status`
2. Vérifiez les logs : `symfony server:log`
3. Videz le cache : `php bin/console cache:clear`
4. Rechargez les fixtures : `php bin/console doctrine:fixtures:load --no-interaction`

## 📸 Captures d'écran recommandées

Pour votre rapport, prenez des captures d'écran de :

1. La liste des collections (index)
2. Le détail d'une collection avec plusieurs jeux
3. Le formulaire d'ajout d'un jeu
4. La liste des jeux vidéo avec les utilisateurs
5. Les différents badges de statut (tous les 8 si possible)
