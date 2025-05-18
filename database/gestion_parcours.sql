-- Création de la base de données
CREATE DATABASE IF NOT EXISTS gestion_parcours;
USE gestion_parcours;

-- Création de la table Filière
CREATE TABLE filiere (
    id_filiere INT AUTO_INCREMENT PRIMARY KEY,
    nom_filiere VARCHAR(100) NOT NULL,
    description TEXT,
    choix_parcour_autorise BOOLEAN DEFAULT FALSE, -- Indique si les étudiants de cette filière peuvent choisir leur parcours
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Création de la table Parcour
CREATE TABLE parcour (
    id_parcour INT AUTO_INCREMENT PRIMARY KEY,
    nom_parcour VARCHAR(100) NOT NULL,
    description TEXT,
    id_filiere INT NOT NULL,
    est_parcour_defaut BOOLEAN DEFAULT FALSE, -- Parcours par défaut pour la filière si choix non autorisé
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_filiere) REFERENCES filiere(id_filiere)
);

-- Création de la table Etudiant
CREATE TABLE etudiant (
    id_etudiant INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    date_naissance DATE,
    adresse TEXT,
    telephone VARCHAR(20),
    id_filiere INT NOT NULL,
    id_parcour INT, -- Peut être NULL si l'étudiant n'a pas encore choisi son parcours
    choix_confirme BOOLEAN DEFAULT FALSE, -- Indique si l'étudiant a confirmé son choix
    date_choix TIMESTAMP NULL, -- Date à laquelle le choix a été confirmé
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_filiere) REFERENCES filiere(id_filiere),
    FOREIGN KEY (id_parcour) REFERENCES parcour(id_parcour)
);

-- Insertion d'exemples dans la table Filière
INSERT INTO filiere (nom_filiere, description, choix_parcour_autorise) VALUES
('Informatique', 'Formation en développement logiciel et systèmes informatiques', TRUE),
('Commerce', 'Formation en gestion commerciale et marketing', TRUE),
('Sciences', 'Formation en sciences fondamentales et appliquées', FALSE); -- Cette filière ne permet pas le choix

-- Insertion d'exemples dans la table Parcour
INSERT INTO parcour (nom_parcour, description, id_filiere, est_parcour_defaut) VALUES
('Développement Web', 'Spécialisation en développement de sites et applications web', 1, FALSE),
('Réseaux', 'Spécialisation en administration réseau et cybersécurité', 1, FALSE),
('Intelligence Artificielle', 'Spécialisation en IA et apprentissage automatique', 1, TRUE), -- Parcours par défaut pour Informatique
('Marketing Digital', 'Spécialisation en stratégies marketing en ligne', 2, TRUE), -- Parcours par défaut pour Commerce
('Gestion des Ventes', 'Spécialisation en techniques de vente et négociation', 2, FALSE),
('Biologie', 'Spécialisation en sciences biologiques', 3, TRUE), -- Parcours par défaut pour Sciences
('Physique', 'Spécialisation en sciences physiques', 3, FALSE);

-- Insertion d'exemples dans la table Etudiant
INSERT INTO etudiant (nom, prenom, email, password, date_naissance, adresse, telephone, id_filiere, id_parcour, choix_confirme) VALUES
('Dupont', 'Jean', 'jean.dupont@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2000-05-15', '123 Rue de Paris, 75001 Paris', '0123456789', 1, 1, TRUE),
('Martin', 'Sophie', 'sophie.martin@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1999-10-22', '456 Avenue des Champs, 75008 Paris', '0123456780', 1, NULL, FALSE), -- N'a pas encore choisi
('Petit', 'Lucas', 'lucas.petit@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2001-03-10', '789 Boulevard Saint-Michel, 75005 Paris', '0123456781', 2, 5, TRUE),
('Leroy', 'Emma', 'emma.leroy@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2002-07-28', '101 Rue de Rivoli, 75001 Paris', '0123456782', 2, NULL, FALSE), -- N'a pas encore choisi
('Moreau', 'Thomas', 'thomas.moreau@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2000-12-05', '202 Rue Saint-Honoré, 75001 Paris', '0123456783', 3, 6, TRUE); -- Filière sans choix, parcours attribué par défaut
