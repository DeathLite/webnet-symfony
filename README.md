## 🚀 Stack Technique

Ce projet utilise une architecture moderne découplée :

* **Backend :** Symfony 7.0 + PHP 8.2 (Utilisation massive des Enums, Services et Doctrine ORM).
* **Frontend :** Nuxt 3 (Vue.js) + Tailwind CSS + GSAP pour les animations.
* **Base de données :** PostgreSQL.
* **Conteneurisation :** Docker & Docker Compose.

## ✨ Fonctionnalités réalisées

- [x] **Génération aléatoire** d'une main de $X$ cartes (paramétrable).
- [x] **Algorithme de tri personnalisé** : Le tri s'effectue selon une priorité de couleurs et de valeurs.
- [x] **Bonus - Interface Drag & Drop** : L'utilisateur peut modifier l'ordre des règles en temps réel via une interface intuitive.
- [x] **Bonus - Persistance** : Chaque tirage et sa configuration associée sont enregistrés en base de données via une entité `CardGameResult`.
- [x] **Animations** : Intégration de GSAP pour une entrée fluide des cartes.

## 🛠️ Installation et Lancement

Le projet est entièrement dockerisé. Pour le lancer :

1.  **Cloner le dépôt**
2.  **Lancer les conteneurs :**
    ```bash
    docker compose up --build -d
    ```
3.  **Installer les dépendances PHP :**
    ```bash
    docker compose exec php composer install
    ```
4.  **Exécuter les migrations :**
    ```bash
    docker compose exec php bin/console doctrine:migrations:migrate --no-interaction
    ```

L'application est alors accessible sur :
* **Frontend :** `http://localhost:3000`
* **Backend API :** `http://localhost:8000`
