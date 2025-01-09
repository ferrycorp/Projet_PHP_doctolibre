
INSERT INTO specialite (nom_specialite) VALUES
('Cardiologie'),
('Dermatologie'),
('Pédiatrie'),
('Gynécologie'),
('Orthopédie');

INSERT INTO lieu (code_postal, ville) VALUES
('75001', 'Paris'),
('69001', 'Lyon'),
('13001', 'Marseille'),
('33000', 'Bordeaux'),
('31000', 'Toulouse');

INSERT INTO horraire (heure_debut) VALUES
('08:00'),
('09:00'),
('10:00'),
('11:00'),
('14:00'),
('15:00'),
('16:00');

INSERT INTO patients (nom_patients, prenom_patients, telephone_patients, email_patients, mot_de_passe, date_naissance, sexe, code_postal, adresse) VALUES
('Dupont', 'Jean', '0601020304', 'jean.dupont@exemple.com', 'pass123', '1980-05-15', 'Masculin', '75001', '12 Rue de Paris, 75001 Paris'),
('Martin', 'Sophie', '0602030405', 'sophie.martin@exemple.com', 'pass123', '1990-07-22', 'Féminin', '69001', '34 Boulevard des Alpes, 69001 Lyon'),
('Bernard', 'Luc', '0603040506', 'luc.bernard@exemple.com', 'pass123', '1985-03-10', 'Masculin', '13001', '56 Avenue du Prado, 13001 Marseille'),
('Durand', 'Emma', '0604050607', 'emma.durant@exemple.com', 'pass123', '1992-11-30', 'Féminin', '33000', '78 Rue Sainte-Catherine, 33000 Bordeaux'),
('Lemoine', 'Paul', '0605060708', 'paul.lemoine@exemple.com', 'pass123', '1978-09-14', 'Masculin', '31000', '90 Rue de la République, 31000 Toulouse');

INSERT INTO medecins (nom_medecins, prenom_medecins, telephone_medecins, email_medecins, mot_de_passe, lieu, specialite_id, horraire) VALUES
('Lemoine', 'Alice', '0610101010', 'alice.lemoine@exemple.com', 'pass123', '75001', 1, 1),
('Carpentier', 'Marc', '0620202020', 'marc.carpentier@exemple.com', 'pass123', '69001', 2, 2),
('Dubois', 'Claire', '0630303030', 'claire.dubois@exemple.com', 'pass123', '13001', 3, 3),
('Morel', 'Antoine', '0640404040', 'antoine.morel@exemple.com', 'pass123', '33000', 4, 4),
('Blanc', 'Julie', '0650505050', 'julie.blanc@exemple.com', 'pass123', '31000', 5, 5);

INSERT INTO rendezvous (commentaire, patients_id, medecin_id, code_postal, horraire, date_rendezvous) VALUES
('Consultation de suivi', 1, 1, '75001', 1, '2024-04-01'),
('Première consultation', 2, 2, '69001', 2, '2024-04-05'),
('Bilan de santé', 3, 3, '13001', 3, '2024-03-28'),
('Suivi post-opératoire', 4, 4, '33000', 4, '2024-03-22'),
('Contrôle annuel', 5, 5, '31000', 5, '2024-03-18');
