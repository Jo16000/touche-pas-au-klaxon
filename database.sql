-- -----------------------------------------------------------------------------
-- Script de création de la base de données pour Klaxon v2
-- Compatible MySQL / MariaDB (Rejouable grâce aux DROP TABLE)
-- -----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS rides;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS agences;
SET FOREIGN_KEY_CHECKS = 1;

-- Table des agences
CREATE TABLE agences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) DEFAULT NULL,
    role ENUM('USER', 'ADMIN') NOT NULL DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table des trajets
CREATE TABLE rides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    departure_agency_id INT NOT NULL,
    arrival_agency_id INT NOT NULL,
    departure_datetime DATETIME NOT NULL,
    arrival_datetime DATETIME NOT NULL,
    total_seats INT NOT NULL,
    available_seats INT NOT NULL,
    CONSTRAINT fk_ride_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_ride_departure FOREIGN KEY (departure_agency_id) REFERENCES agences(id) ON DELETE CASCADE,
    CONSTRAINT fk_ride_arrival FOREIGN KEY (arrival_agency_id) REFERENCES agences(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -----------------------------------------------------------------------------
-- Jeu d'essai : Agences (Données officielles du centre)[cite: 2]
-- -----------------------------------------------------------------------------
INSERT INTO agences (id, nom) VALUES 
(1, 'Paris'),[cite: 2]
(2, 'Lyon'),[cite: 2]
(3, 'Marseille'),[cite: 2]
(4, 'Toulouse'),[cite: 2]
(5, 'Nice'),[cite: 2]
(6, 'Nantes'),[cite: 2]
(7, 'Strasbourg'),[cite: 2]
(8, 'Montpellier'),[cite: 2]
(9, 'Bordeaux'),[cite: 2]
(10, 'Lille'),[cite: 2]
(11, 'Rennes'),[cite: 2]
(12, 'Reims');[cite: 2]

-- -----------------------------------------------------------------------------
-- Jeu d'essai : Utilisateurs (Données officielles du centre)
-- (Mot de passe haché par défaut : 'admin123' pour l'admin, 'password123' pour les autres)
-- -----------------------------------------------------------------------------
INSERT INTO users (id, nom, prenom, telephone, email, password, role) VALUES 
(1, 'Martin', 'Alexandre', '0612345678', 'alexandre.martin@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'ADMIN'),[cite: 3]
(2, 'Dubois', 'Sophie', '0698765432', 'sophie.dubois@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(3, 'Bernard', 'Julien', '0622446688', 'julien.bernard@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(4, 'Moreau', 'Camille', '0611223344', 'camille.moreau@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(5, 'Lefèvre', 'Lucie', '0777889900', 'lucie.lefevre@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(6, 'Leroy', 'Thomas', '0655443322', 'thomas.leroy@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(7, 'Roux', 'Chloé', '0633221199', 'chloe.roux@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(8, 'Petit', 'Maxime', '0766778899', 'maxime.petit@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(9, 'Garnier', 'Laura', '0688776655', 'laura.garnier@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(10, 'Dupuis', 'Antoine', '0744556677', 'antoine.dupuis@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(11, 'Lefebvre', 'Emma', '0699887766', 'emma.lefebvre@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(12, 'Fontaine', 'Louis', '0655667788', 'louis.fontaine@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(13, 'Chevalier', 'Clara', '0788990011', 'clara.chevalier@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(14, 'Robin', 'Nicolas', '0644332211', 'nicolas.robin@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(15, 'Gauthier', 'Marine', '0677889922', 'marine.gauthier@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(16, 'Fournier', 'Pierre', '0722334455', 'pierre.fournier@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(17, 'Girard', 'Sarah', '0688665544', 'sarah.girard@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(18, 'Lambert', 'Hugo', '0611223366', 'hugo.lambert@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(19, 'Masson', 'Julie', '0733445566', 'julie.masson@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER'),[cite: 3]
(20, 'Henry', 'Arthur', '0666554433', 'arthur.henry@email.fr', '$2y$10$92IXUNpkjO0rO5Q5byMi.Ye4oKea3Ro91lc/at2.uheWG/igi', 'USER');[cite: 3]

-- -----------------------------------------------------------------------------
-- Jeu d'essai : Trajets (dates futures en 2026)
-- -----------------------------------------------------------------------------
INSERT INTO rides (user_id, departure_agency_id, arrival_agency_id, departure_datetime, arrival_datetime, total_seats, available_seats) VALUES 
(2, 9, 2, '2026-09-22 08:30:00', '2026-09-22 11:45:00', 3, 2),
(1, 1, 9, '2026-09-25 14:00:00', '2026-09-25 18:30:00', 4, 4);