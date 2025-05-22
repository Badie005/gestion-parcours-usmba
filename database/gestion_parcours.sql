-- Création de la base de données
CREATE DATABASE IF NOT EXISTS parcours
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE parcours;

-- 1. Table des filières (DEUG)
CREATE TABLE IF NOT EXISTS filiere (
    Code_DEUG CHAR(10) NOT NULL PRIMARY KEY COLLATE utf8mb4_bin,
    DEUG_Intitule_Fr VARCHAR(255) NOT NULL,
    DEUG_Intitule_Ar VARCHAR(255) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    choix_parcour_autorise BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- 2. Table des parcours (Licence)
CREATE TABLE IF NOT EXISTS parcour (
    Code_Licence CHAR(10) NOT NULL PRIMARY KEY COLLATE utf8mb4_bin,
    Licence_Intitule_Fr VARCHAR(255) NOT NULL,
    Licence_Intitule_Ar VARCHAR(255) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    id_filiere CHAR(10) NOT NULL COLLATE utf8mb4_bin,
    est_parcour_defaut BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_parcour_filiere
      FOREIGN KEY (id_filiere)
      REFERENCES filiere(Code_DEUG)
      ON UPDATE CASCADE
      ON DELETE RESTRICT
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- 3. Table des étudiants
CREATE TABLE IF NOT EXISTS etudiant (
    Num_Inscription VARCHAR(20) NOT NULL PRIMARY KEY COLLATE utf8mb4_bin,
    nom_fr VARCHAR(100) NOT NULL,
    prenom_fr VARCHAR(100) NOT NULL,
    nom_ar VARCHAR(100) DEFAULT NULL,
    prenom_ar VARCHAR(100) DEFAULT NULL,
    email_academique VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    Date_Naissance DATE DEFAULT NULL,
    lieu_naissance_fr VARCHAR(100) DEFAULT NULL,
    lieu_naissance_ar VARCHAR(100) DEFAULT NULL,
    sexe ENUM('M','F') DEFAULT NULL,
    pays_naissance VARCHAR(100) DEFAULT NULL,
    nationalite VARCHAR(100) DEFAULT NULL,
    adresse TEXT DEFAULT NULL,
    telephone VARCHAR(20) DEFAULT NULL,
    id_filiere CHAR(10) NOT NULL COLLATE utf8mb4_bin,
    id_parcour CHAR(10) DEFAULT NULL COLLATE utf8mb4_bin,
    choix_confirme BOOLEAN NOT NULL DEFAULT FALSE,
    date_choix DATETIME DEFAULT NULL,
    last_login_at DATETIME DEFAULT NULL,
    annee YEAR DEFAULT NULL,
    aux TINYINT DEFAULT NULL,
    nb_val_ac_s1 TINYINT DEFAULT NULL,
    nb_val_ac_s2 TINYINT DEFAULT NULL,
    nb_val_ac_s3 TINYINT DEFAULT NULL,
    nb_val_ac_s4 TINYINT DEFAULT NULL,
    serie_bac VARCHAR(50) DEFAULT NULL,
    lieu_bac VARCHAR(100) DEFAULT NULL,
    annee_bac YEAR DEFAULT NULL,
    lycee VARCHAR(255) DEFAULT NULL,
    handicap BOOLEAN NOT NULL DEFAULT FALSE,
    region VARCHAR(100) DEFAULT NULL,
    fonctionnaire BOOLEAN NOT NULL DEFAULT FALSE,
    impression_carte BOOLEAN NOT NULL DEFAULT FALSE,
    duplicata_carte BOOLEAN NOT NULL DEFAULT FALSE,
    impression_deug BOOLEAN NOT NULL DEFAULT FALSE,
    la_poutre BOOLEAN NOT NULL DEFAULT FALSE,
    admission_deug BOOLEAN NOT NULL DEFAULT FALSE,
    exclu BOOLEAN NOT NULL DEFAULT FALSE,
    rd BOOLEAN NOT NULL DEFAULT FALSE,
    reinscription BOOLEAN NOT NULL DEFAULT FALSE,
    role VARCHAR(20) NOT NULL DEFAULT 'etudiant',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_etudiant_filiere
      FOREIGN KEY (id_filiere)
      REFERENCES filiere(Code_DEUG)
      ON UPDATE CASCADE
      ON DELETE RESTRICT,
    CONSTRAINT fk_etudiant_parcour
      FOREIGN KEY (id_parcour)
      REFERENCES parcour(Code_Licence)
      ON UPDATE CASCADE
      ON DELETE RESTRICT
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Indexes pour optimiser les recherches sur les étudiants
CREATE INDEX idx_etudiant_filiere       ON etudiant(id_filiere);
CREATE INDEX idx_etudiant_parcour       ON etudiant(id_parcour);
CREATE INDEX idx_etudiant_filiere_annee ON etudiant(id_filiere, annee);
CREATE INDEX idx_etudiant_parcour_annee ON etudiant(id_parcour, annee);
CREATE FULLTEXT INDEX idx_etudiant_search
    ON etudiant(nom_fr, prenom_fr, email_academique);

-- 4. Table de l’historique des actions
CREATE TABLE IF NOT EXISTS action_historique (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_etudiant VARCHAR(20) NOT NULL COLLATE utf8mb4_bin,
    type_action VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    donnees_additionnelles JSON DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_histo_etudiant
      FOREIGN KEY (id_etudiant)
      REFERENCES etudiant(Num_Inscription)
      ON UPDATE CASCADE
      ON DELETE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Indexes pour l’historique
CREATE INDEX idx_historique_etudiant ON action_historique(id_etudiant);
CREATE INDEX idx_historique_type     ON action_historique(type_action);

-- 5. Table des administrateurs
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- 6. Table pour les tokens API (Laravel Sanctum)
CREATE TABLE IF NOT EXISTS personal_access_tokens (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tokenable_type VARCHAR(255) NOT NULL,
    tokenable_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    token VARCHAR(64) NOT NULL UNIQUE,
    abilities TEXT DEFAULT NULL,
    last_used_at DATETIME DEFAULT NULL,
    expires_at    DATETIME DEFAULT NULL,
    created_at    DATETIME DEFAULT NULL,
    updated_at    DATETIME DEFAULT NULL
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- Index pour les tokens
CREATE INDEX idx_personal_access_tokens_tokenable
    ON personal_access_tokens(tokenable_type, tokenable_id);
