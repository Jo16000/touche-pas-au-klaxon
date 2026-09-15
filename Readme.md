# 🚗 Touche pas au klaxon !

Application web de covoiturage inter-sites développée pour fluidifier les déplacements professionnels des collaborateurs entre les différentes agences de l'entreprise.

---

## 🚀 Fonctionnalités principales

- **Page d'accueil publique** : Liste des trajets disponibles à venir (filtrage automatique des trajets passés et complets, tri chronologique).
- **Espace Membre** :
  - Publication d'un nouveau trajet.
  - Affichage des coordonnées du conducteur via une fenêtre modale sécurisée.
  - Gestion (modification et suppression) de ses propres trajets avec vérification des droits.
- **Tableau de bord Administrateur** :
  - Gestion complète (CRUD) des agences.
  - Vue d'ensemble de tous les utilisateurs et de l'intégralité des trajets.
  - Droits de suppression élargis sur tous les trajets du site.

---

## ⚙️ Stack technique

- **PHP 8+** (orienté objet, strict types, architecture MVC avec autoloader Composer PSR-4)
- **MySQL / MariaDB** (avec gestion des contraintes d'intégrité et clés étrangères en cascade)
- **Bootstrap & SASS** (charte graphique personnalisée)
- **PHPUnit** (tests unitaires de la logique d'écriture)
- **PHPStan** (analyse statique de niveau 6)

---

## 🛠️ Installation et Lancement

1. **Cloner ou placer le dépôt** dans le répertoire de votre serveur local (ex: `htdocs` ou `www` de WampServer) :
   ```bash
   git clone <url-du-depot> klaxon-v2