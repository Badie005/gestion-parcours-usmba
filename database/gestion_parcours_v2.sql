-- =====================================================================
-- Schéma MySQL généré à partir des migrations Laravel (mai 2025)
-- Projet : Gestion Parcours Étudiants – FP Taza / USMBA
-- Contenu : toutes les tables principales + index + clés étrangères
-- =====================================================================

-- 0) Base de données ---------------------------------------------------
CREATE DATABASE IF NOT EXISTS parcours
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE parcours;

-- 1) Table « filieres » (DEUG) -----------------------------------------
CREATE TABLE IF NOT EXISTS filieres (
    code_deug              CHAR(10)     NOT NULL PRIMARY KEY,
    deug_intitule_fr       VARCHAR(255) NOT NULL,
    deug_intitule_ar       VARCHAR(255) DEFAULT NULL,
    description            TEXT         DEFAULT NULL,
    choix_parcour_autorise BOOLEAN      NOT NULL DEFAULT FALSE,
    created_at             TIMESTAMP    NULL DEFAULT NULL,
    updated_at             TIMESTAMP    NULL DEFAULT NULL
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2) Table « parcours » (Licence) --------------------------------------
CREATE TABLE IF NOT EXISTS parcours (
    code_licence       CHAR(10)     NOT NULL PRIMARY KEY,
    licence_intitule_fr VARCHAR(255) NOT NULL,
    licence_intitule_ar VARCHAR(255) DEFAULT NULL,
    description         TEXT         DEFAULT NULL,
    id_filiere          CHAR(10)     NOT NULL,
    est_parcour_defaut  BOOLEAN      NOT NULL DEFAULT FALSE,
    created_at          TIMESTAMP    NULL DEFAULT NULL,
    updated_at          TIMESTAMP    NULL DEFAULT NULL,
    CONSTRAINT fk_parcours_filieres FOREIGN KEY (id_filiere)
        REFERENCES filieres(code_deug)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE INDEX idx_parcours_filiere ON parcours(id_filiere);

-- 3) Table « etudiants » ----------------------------------------------
CREATE TABLE IF NOT EXISTS etudiants (
    num_inscription    VARCHAR(20)  NOT NULL PRIMARY KEY,
    nom_fr             VARCHAR(100) NOT NULL,
    prenom_fr          VARCHAR(100) NOT NULL,
    nom_ar             VARCHAR(100) DEFAULT NULL,
    prenom_ar          VARCHAR(100) DEFAULT NULL,
    email_academique   VARCHAR(255) NOT NULL UNIQUE,
    password           VARCHAR(255) NOT NULL,
    password_changed   BOOLEAN      NOT NULL DEFAULT FALSE,
    date_naissance     DATE         DEFAULT NULL,
    lieu_naissance_fr  VARCHAR(100) DEFAULT NULL,
    lieu_naissance_ar  VARCHAR(100) DEFAULT NULL,
    sexe               ENUM('M','F') DEFAULT NULL,
    pays_naissance     VARCHAR(100) DEFAULT NULL,
    nationalite        VARCHAR(100) DEFAULT NULL,
    adresse            TEXT         DEFAULT NULL,
    telephone          VARCHAR(20)  DEFAULT NULL,
    filiere_id         CHAR(10)     NOT NULL,
    parcour_id         CHAR(10)     DEFAULT NULL,
    choix_confirme     BOOLEAN      NOT NULL DEFAULT FALSE,
    date_choix         DATETIME     DEFAULT NULL,
    last_login_at      DATETIME     DEFAULT NULL,
    annee              YEAR         DEFAULT NULL,
    aux                TINYINT      DEFAULT NULL,
    nb_val_ac_s1       TINYINT      DEFAULT NULL,
    nb_val_ac_s2       TINYINT      DEFAULT NULL,
    nb_val_ac_s3       TINYINT      DEFAULT NULL,
    nb_val_ac_s4       TINYINT      DEFAULT NULL,
    serie_bac          VARCHAR(50)  DEFAULT NULL,
    lieu_bac           VARCHAR(100) DEFAULT NULL,
    annee_bac          YEAR         DEFAULT NULL,
    lycee              VARCHAR(255) DEFAULT NULL,
    handicap           BOOLEAN      NOT NULL DEFAULT FALSE,
    region             VARCHAR(100) DEFAULT NULL,
    fonctionnaire      BOOLEAN      NOT NULL DEFAULT FALSE,
    impression_carte   BOOLEAN      NOT NULL DEFAULT FALSE,
    duplicata_carte    BOOLEAN      NOT NULL DEFAULT FALSE,
    impression_deug    BOOLEAN      NOT NULL DEFAULT FALSE,
    la_poutre          BOOLEAN      NOT NULL DEFAULT FALSE,
    admission_deug     BOOLEAN      NOT NULL DEFAULT FALSE,
    exclu              BOOLEAN      NOT NULL DEFAULT FALSE,
    rd                 BOOLEAN      NOT NULL DEFAULT FALSE,
    reinscription      BOOLEAN      NOT NULL DEFAULT FALSE,
    role               VARCHAR(20)  NOT NULL DEFAULT 'etudiant',
    created_at         TIMESTAMP    NULL DEFAULT NULL,
    updated_at         TIMESTAMP    NULL DEFAULT NULL,
    CONSTRAINT fk_etudiants_filieres FOREIGN KEY (filiere_id)
        REFERENCES filieres(code_deug)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    CONSTRAINT fk_etudiants_parcours FOREIGN KEY (parcour_id)
        REFERENCES parcours(code_licence)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- Indexes rapides
CREATE INDEX idx_etudiants_filiere  ON etudiants(filiere_id);
CREATE INDEX idx_etudiants_parcour  ON etudiants(parcour_id);
CREATE INDEX idx_etu_fil_annee      ON etudiants(filiere_id, annee);
CREATE INDEX idx_etu_parc_annee     ON etudiants(parcour_id, annee);
CREATE FULLTEXT INDEX idx_etu_search ON etudiants(nom_fr, prenom_fr, email_academique);

-- 4) Table « action_historiques » -------------------------------------
CREATE TABLE IF NOT EXISTS action_historiques (
    id                     BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    etudiant_id            VARCHAR(20) NOT NULL,
    type_action            VARCHAR(50) NOT NULL,
    description            TEXT NOT NULL,
    donnees_additionnelles JSON DEFAULT NULL,
    created_at             TIMESTAMP NULL DEFAULT NULL,
    updated_at             TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_hist_etudiant FOREIGN KEY (etudiant_id)
        REFERENCES etudiants(num_inscription)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE INDEX idx_hist_etudiant ON action_historiques(etudiant_id);
CREATE INDEX idx_hist_type     ON action_historiques(type_action);

-- 5) Table « resultats_academiques » ----------------------------------
CREATE TABLE IF NOT EXISTS resultats_academiques (
    id              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    num_inscription VARCHAR(20)  NOT NULL,
    semestre        ENUM('S1','S2','S3','S4') NOT NULL,
    code_module     VARCHAR(10)  NOT NULL,
    titre_module    VARCHAR(255) NOT NULL,
    note            DECIMAL(4,2) DEFAULT NULL,
    coefficient     DECIMAL(3,2) NOT NULL DEFAULT 1.00,
    statut          ENUM('validé','non_validé','rattrapage') DEFAULT NULL,
    created_at      TIMESTAMP NULL DEFAULT NULL,
    updated_at      TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_res_etu FOREIGN KEY (num_inscription)
        REFERENCES etudiants(num_inscription)
        ON DELETE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE INDEX idx_res_etu_sem ON resultats_academiques(num_inscription, semestre);
CREATE UNIQUE INDEX uq_res ON resultats_academiques (num_inscription, semestre, code_module);

-- 6) Table « users » (admins) -----------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(255) NOT NULL,
    email           VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL DEFAULT NULL,
    password        VARCHAR(255) NOT NULL,
    remember_token  VARCHAR(100) DEFAULT NULL,
    created_at      TIMESTAMP NULL DEFAULT NULL,
    updated_at      TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7) Table « personal_access_tokens » (Laravel Sanctum) ----------------
CREATE TABLE IF NOT EXISTS personal_access_tokens (
    id              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tokenable_type  VARCHAR(255) NOT NULL,
    tokenable_id    BIGINT UNSIGNED NOT NULL,
    name            VARCHAR(255) NOT NULL,
    token           VARCHAR(64)  NOT NULL UNIQUE,
    abilities       TEXT         DEFAULT NULL,
    last_used_at    DATETIME     DEFAULT NULL,
    expires_at      DATETIME     DEFAULT NULL,
    created_at      DATETIME     DEFAULT NULL,
    updated_at      DATETIME     DEFAULT NULL
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE INDEX idx_pat_tokenable ON personal_access_tokens(tokenable_type, tokenable_id);

-- 8) Cache / locks (optionnel pour Laravel) ---------------------------
CREATE TABLE IF NOT EXISTS cache (
    `key`       VARCHAR(255) NOT NULL PRIMARY KEY,
    `value`     MEDIUMTEXT NOT NULL,
    expiration  INT NOT NULL
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS cache_locks (
    `key`       VARCHAR(255) NOT NULL PRIMARY KEY,
    owner       VARCHAR(255) NOT NULL,
    expiration  INT NOT NULL
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================================
-- FIN DU SCRIPT
-- =====================================================================
