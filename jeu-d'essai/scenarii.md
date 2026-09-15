# Dossier de Jeu d'Essai - Projet Klaxon v2

Ce document présente les différents scénarios de test fonctionnel réalisés pour valider le bon fonctionnement de l'application Klaxon v2.

## 1. Tableau récapitulatif des tests fonctionnels

| ID | Cas testé | Données d'entrée | Résultat attendu | Résultat obtenu | Statut |
|---|---|---|---|---|---|
| **TF01** | Création valide d'un trajet | Départ: Angoulême, Arrivée: Bordeaux, Places: 3, Prix: 10€ | Le trajet est enregistré en base de données et affiché sur la liste. | Le trajet s'affiche correctement avec les bonnes informations. | **OK** |
| **TF02** | Gestion des places disponibles | Tenter de réserver 4 places sur un trajet qui n'en a que 3. | Message d'erreur bloquant l'action (places insuffisantes). | L'application bloque la réservation et affiche l'alerte. | **OK** |
| **TF03** | Validation des champs obligatoires | Soumission d'un formulaire de trajet avec des champs vides. | Refus de l'enregistrement et indication des champs manquants. | Erreurs affichées, insertion bloquée. | **OK** |

## 2. Tests Unitaires Automatisés (PHPUnit)
En complément des tests fonctionnels ci-dessus, des tests automatisés ont été développés dans le dossier `tests/` :
* **`RideTest.php`** : Vérifie la structure des données et les règles de gestion des trajets (assertions validées avec succès).