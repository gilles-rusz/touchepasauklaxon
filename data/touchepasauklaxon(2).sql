
-- Base de données : touchepasauklaxon
DROP DATABASE IF EXISTS touchepasauklaxon;
CREATE DATABASE touchepasauklaxon CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE touchepasauklaxon;

-- Table des employés
CREATE TABLE employes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    telephone VARCHAR(20),
    role ENUM('admin', 'salarie') NOT NULL DEFAULT 'salarie',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des trajets
CREATE TABLE trajets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    depart VARCHAR(100) NOT NULL,
    arrivee VARCHAR(100) NOT NULL,
    date_trajet DATE NOT NULL,
    heure_depart TIME NOT NULL,
    nb_places INT NOT NULL,
    employe_id INT,
    FOREIGN KEY (employe_id) REFERENCES employes(id) ON DELETE CASCADE
);

-- Insertion des utilisateurs de test
INSERT INTO employes (nom, prenom, email, mot_de_passe, telephone, role) VALUES
('Admin', 'Test', 'admin@demo.fr', SHA2('admin123', 256), '0102030405', 'admin'),
('Dupont', 'Jean', 'salarie@demo.fr', SHA2('azerty', 256), '0601020304', 'salarie');

-- Insertion de trajets de test
INSERT INTO trajets (depart, arrivee, date_trajet, heure_depart, nb_places, employe_id) VALUES
('Lyon', 'Grenoble', '2025-06-09', '08:00:00', 3, 2),
('Clermont-Ferrand', 'Saint-Étienne', '2025-06-09', '09:15:00', 2, 2),
('Annecy', 'Chambéry', '2025-06-09', '07:45:00', 4, 2);
