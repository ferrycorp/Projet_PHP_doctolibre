-- Création de la base de données
-- CREATE DATABASE doctolibre;

-- Connexion à la base de données
-- \c doctolibre;

CREATE TABLE specialite (
    id_specialite SERIAL PRIMARY KEY,
    nom_specialite VARCHAR(50) NOT NULL
);

CREATE TABLE lieu (
    code_postal VARCHAR(5) PRIMARY KEY,
    ville VARCHAR(50) NOT NULL
);

CREATE TABLE horraire (
    id_horraire SERIAL PRIMARY KEY,
    heure_debut VARCHAR(10) NOT NULL
);

CREATE TABLE medecins (
    id_medecins SERIAL PRIMARY KEY,
    nom_medecins VARCHAR(50) NOT NULL,
    prenom_medecins VARCHAR(50) NOT NULL,
    telephone_medecins VARCHAR(15) NOT NULL,
    email_medecins VARCHAR(128) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    lieu VARCHAR(5) REFERENCES lieu(code_postal) ON DELETE CASCADE,
    specialite_id INT REFERENCES specialite(id_specialite) ON DELETE CASCADE,
    horraire INT REFERENCES horraire(id_horraire) ON DELETE CASCADE
);

CREATE TABLE patients (
    id_patients SERIAL PRIMARY KEY,
    nom_patients VARCHAR(50) NOT NULL,
    prenom_patients VARCHAR(50) NOT NULL,
    telephone_patients VARCHAR(15) NOT NULL,
    email_patients VARCHAR(128) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    date_naissance DATE NOT NULL,          
    sexe VARCHAR(10) NOT NULL,                  
    code_postal VARCHAR(5) REFERENCES lieu(code_postal) ON DELETE CASCADE,  
    adresse VARCHAR(255) NULL               
);


CREATE TABLE rendezvous (
    id_rendezvous SERIAL PRIMARY KEY,
    commentaire VARCHAR(255),
    patients_id INT REFERENCES patients(id_patients) ON DELETE CASCADE,
    medecin_id INT REFERENCES medecins(id_medecins) ON DELETE CASCADE,
    code_postal VARCHAR(5) REFERENCES lieu(code_postal) ON DELETE CASCADE,
    horraire INT REFERENCES horraire(id_horraire) ON DELETE CASCADE,
    date_rendezvous DATE NOT NULL 
);
