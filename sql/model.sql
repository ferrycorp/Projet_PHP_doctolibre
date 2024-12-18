-- Création de la base de données
-- CREATE DATABASE doctolibre;

-- -- Connexion à la base de données
-- \c doctolibre;

-- Création de la table specialite
CREATE TABLE specialite (
    id_specialite SERIAL PRIMARY KEY,
    nom_specialite VARCHAR(50) NOT NULL
);

-- Création de la table medecins
CREATE TABLE medecins (
    id_medecins SERIAL PRIMARY KEY,
    nom_medecins VARCHAR(50) NOT NULL,
    prenom_medecins VARCHAR(50) NOT NULL,
    telephone_medecins VARCHAR(15) NOT NULL,
    email_medecins VARCHAR(128) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    lieu VARCHAR(5) REFERENCES lieu(code_postal) ON DELETE CASCADE,
    specialite_id VARCHAR(10) REFERENCES specialite(id_specialite) ON DELETE CASCADE,
    horraire VARCHAR(10) REFERENCES horraire(id_horraire) ON DELETE CASCADE
);

-- Création de la table patients
CREATE TABLE patients (
    id_patients SERIAL PRIMARY KEY,
    nom_patients VARCHAR(50) NOT NULL,
    prenom_patients VARCHAR(50) NOT NULL,
    telephone_patiens VARCHAR(15) NOT NULL,
    email_patiens VARCHAR(128) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
);

-- Création de la table lieu
CREATE TABLE lieu (
    code_postal VARCHAR(5) PRIMARY KEY,
    ville VARCHAR(50) NOT NULL
);

-- Création de la table rendezvous
CREATE TABLE rendezvous (
    id_rendezvous SERIAL PRIMARY KEY,
    commentaire VARCHAR(255),
    patients_id VARCHAR(10) REFERENCES patients(id_patients) ON DELETE CASCADE,
    medecin_id VARCHAR(10) REFERENCES medecins(id_medecins) ON DELETE CASCADE,
    code_postal VARCHAR(5) REFERENCES lieu(code_postal) ON DELETE CASCADE,
    horraire VARCHAR(10) REFERENCES horraire(id_horraire) ON DELETE CASCADE
);

-- Création de la table horraire
CREATE TABLE horraire (
    id_horraire SERIAL PRIMARY KEY,
    heure_debut VARCHAR(10) NOT NULL,
);