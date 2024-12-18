-- Insertion des données pour la table specialite
INSERT INTO specialite (nom_specialite) VALUES
('Cardiologie'),
('Dermatologie'),
('Pédiatrie'),
('Gynécologie'),
('Orthopédie');

-- Insertion des données pour la table lieu
INSERT INTO lieu (code_postal, ville) VALUES
('75001', 'Paris'),
('69001', 'Lyon'),
('13001', 'Marseille'),
('33000', 'Bordeaux'),
('31000', 'Toulouse');

-- Insertion des données pour la table horraire
INSERT INTO horraire (heure_debut) VALUES
('08:00'),
('09:00'),
('10:00'),
('11:00'),
('14:00'),
('15:00'),
('16:00');

-- Insertion des données pour la table patients
INSERT INTO patients (nom_patients, prenom_patients, telephone_patiens, email_patiens, mot_de_passe) VALUES
('Dupont', 'Jean', '0601020304', 'jean.dupont@exemple.com', 'pass123'),
('Martin', 'Sophie', '0602030405', 'sophie.martin@exemple.com', 'pass123'),
('Bernard', 'Luc', '0603040506', 'luc.bernard@exemple.com', 'pass123'),
('Durand', 'Emma', '0604050607', 'emma.durant@exemple.com', 'pass123'),
('Lemoine', 'Paul', '0605060708', 'paul.lemoine@exemple.com', 'pass123');

-- Insertion des données pour la table medecins
INSERT INTO medecins (nom_medecins, prenom_medecins, telephone_medecins, email_medecins, mot_de_passe, lieu, specialite_id, horraire) VALUES
('Lemoine', 'Alice', '0610101010', 'alice.lemoine@exemple.com', 'pass123', '75001', 1, 1),
('Carpentier', 'Marc', '0620202020', 'marc.carpentier@exemple.com', 'pass123', '69001', 2, 2),
('Dubois', 'Claire', '0630303030', 'claire.dubois@exemple.com', 'pass123', '13001', 3, 3),
('Morel', 'Antoine', '0640404040', 'antoine.morel@exemple.com', 'pass123', '33000', 4, 4),
('Blanc', 'Julie', '0650505050', 'julie.blanc@exemple.com', 'pass123', '31000', 5, 5);

-- Insertion des données pour la table rendezvous
INSERT INTO rendezvous (commentaire, patients_id, medecin_id, code_postal, horraire) VALUES
('Consultation de suivi', 1, 1, '75001', 1),
('Première consultation', 2, 2, '69001', 2),
('Bilan de santé', 3, 3, '13001', 3),
('Suivi post-opératoire', 4, 4, '33000', 4),
('Contrôle annuel', 5, 5, '31000', 5);