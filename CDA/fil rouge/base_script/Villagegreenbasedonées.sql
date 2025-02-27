USE Villagegreen;



-- Insérer des utilisateurs
INSERT INTO utilisateur (Id_utili, nom_cli, email, cate_cli, coeff_cli, num_telephone, mot_de_passe) VALUES
('U1', 'Alice Dupont', 'alice.dupont@example.com', 1, 1, '0612345678', 'password123'),
('U2', 'Jean Martin', 'jean.martin@example.com', 0, 2, '0623456789', 'password456'),
('U3', 'Claire Leroy', 'claire.leroy@example.com', 1, 1, '0634567890', 'password789'),
('U4', 'Paul Durand', 'paul.durand@example.com', 0, 2, '0645678901', 'password012'),
('U5', 'Sophie Lambert', 'sophie.lambert@example.com', 1, 1, '0656789012', 'password345'),
('U6', 'Lucas Dupont', 'lucas.dupont@example.com', 1, 3, '0654321987', 'pass6'),
('U7', 'Amélie Bernard', 'amelie.bernard@example.com', 0, 2, '0765432109', 'pass7'),
('U8', 'Julien Lefebvre', 'julien.lefebvre@example.com', 1, 1, '0789123456', 'pass8'),
('U9', 'Emma Martin', 'emma.martin@example.com', 0, 3, '0612347890', 'pass9'),
('U10', 'Thomas Durand', 'thomas.durand@example.com', 1, 2, '0623456789', 'pass10');


-- Insérer des bons de livraison
INSERT INTO Bon_de_livraison (Id_Bon_de_livraison, num_livrais, logo_entreprise, date_liv_com) VALUES
('BL1', 'LIV001', 'Logo1', '2025-01-01'),
('BL2', 'LIV002', 'Logo2', '2025-01-02'),
('BL3', 'LIV003', 'Logo3', '2025-01-03'),
('BL4', 'LIV004', 'Logo4', '2025-01-04'),
('BL5', 'LIV005', 'Logo5', '2025-01-05');

-- Insérer des sous-catégories
INSERT INTO Sous_categorie (Id_Sous_categorie, image_sous_categorie, nom_sous_categorie) VALUES
('SC1', 'image1.jpg', 'Cordes'),
('SC2', 'image2.jpg', 'Percussions'),
('SC3', 'image3.jpg', 'Claviers'),
('SC4', 'image4.jpg', 'Vent');

-- Insérer des catégories
INSERT INTO Categorie (Id_Categorie, nom_categorie, image_categorie, Id_Sous_categorie) VALUES
('C1', 'Guitares', 'guitares.jpg', 'SC1'),
('C2', 'Batteries', 'batteries.jpg', 'SC2'),
('C3', 'Pianos', 'pianos.jpg', 'SC3'),
('C4', 'Instruments à vent', 'vent.jpg', 'SC4');

INSERT INTO Commande (Id_prod, prix_achat_com, prix_vente_com, condtion_reg, date_fact, num_fact, reduction, com_exp, num_com, nom_com, date_com, total_ttc, taux_tva, adresse_livrai, prix_htva, indic_reduc, total_htva, adresse_factu, Id_Bon_de_livraison, Id_utili) VALUES
('COM001', 150.00, 200.00, TRUE, '2025-01-01', 'F001', 10.00, TRUE, 'COM001', 'Guitare acoustique Yamaha', '2025-02-16', 220, 20.00, 'Paris', 180, TRUE, 180, 'Paris', 'BL1', 'U1'),
('COM002', 300.00, 400.00, FALSE, '2025-01-02', 'F002', 5.00, FALSE, 'COM002', 'Batterie Pearl Export', '2025-01-15', 420, 20.00, 'Lyon', 350, FALSE, 350, 'Lyon', 'BL2', 'U2'),
('COM003', 500.00, 600.00, TRUE, '2025-01-03', 'F003', 15.00, TRUE, 'COM003', 'Piano numérique Roland', '2025-09-27', 690, 20.00, 'Marseille', 580, TRUE, 580, 'Marseille', 'BL3', 'U3'),
('COM004', 100.00, 120.00, TRUE, '2025-01-04', 'F004', 0.00, FALSE, 'COM004', 'Flûte traversière Yamaha', '2025-12-04', 144, 20.00, 'Paris', 120, TRUE, 120, 'Paris', 'BL4', 'U4'),
('COM005', 200.00, 250.00, TRUE, '2025-01-05', 'F005', 10.00, TRUE, 'COM005', 'Guitare électrique Fender', '2025-08-05', 300, 20.00, 'Nice', 250, TRUE, 250, 'Nice', 'BL5', 'U5');

INSERT INTO Fournisseur (Id_fournisseur, nom_fournisseur, adresse_fournisseur, telephone_fournisseur_,contact_fournisseur_) VALUES
('F1', 'Yamaha Music', '12 Rue de la Musique, Paris', '0123456789', 'contact@yamaha.fr'),
('F2', 'Fender Instruments', '34 Avenue des Guitares, Lyon', '0234567890', 'info@fender.com'),
('F3', 'Pearl Drums', '56 Boulevard des Rythmes, Marseille', '0345678901', 'support@pearldrums.com'),
('F4', 'Roland Digital', '78 Allée des Claviers, Toulouse', '0456789012', 'sales@roland.com'),
('F5', 'Gibson Europe', '90 Chemin des Cordes, Nice', '0567890123', 'service@gibson.com'),
('F6', 'Ibanez France', '21 Impasse des Sons, Bordeaux', '0678901234', 'contact@ibanez.fr'),
('F7', 'Boss Amps', '43 Route des Ampli, Lille', '0789012345', 'info@boss.com'),
('F8', 'Korg Electronics', '65 Place des Synthés, Nantes', '0890123456', 'support@korg.com'),
('F9', 'Shure Audio', '87 Quai des Micros, Strasbourg', '0912345678', 'help@shure.com'),
('F10', 'Zoom Corp', '109 Rue des Effets, Rennes', '0123987654', 'zoom@zoomcorp.com');




INSERT INTO Produit (Id_Produit, prix_achat, nom_prod, stock_prod, photo_produit, lib_court_prod, lib_long_prod, Id_fournisseur, Id_Categorie)
VALUES
('P1', 15.50, 'Guitare Electrique', 50, 'guitare_electrique.jpg', 'Guitare Electrique', 'Une guitare électrique','F1', 'C1'),
('P2', 25.00, 'Piano a queue', 200, 'piano_numerique.jpg', 'Produit B', 'Description détaillée du produit B', 'F2', 'C2'),
('P3', 12.75, 'Batterie electriue', 150, 'photoC.jpg','Produit C', 'Description détaillée du produit C', 'F3', 'C3'),
('P4', 18.00, 'Violoncelle', 20, 'violoncelle.jpg', 'Violoncelle', 'Violoncelle professionnel avec un son riche .', 'F4', 'C4'),
('P5', 22.50, 'Microphone Condensateur', 60, 'photoE.jpg', 'Produit E', 'Description détaillée du produit E', 'F5', 'C1'),
('P6', 50.00, 'Casque Audio Hi-Fi', 100, 'photoE.jpg', 'Produit E', 'Description détaillée du produit E', 'F5', 'C3'),
('P7', 30.00, 'Synthétiseur Analogique', 25, 'photoE.jpg', 'Produit E', 'Description détaillée du produit E', 'F5', 'C3'),
('P8', 25.75, 'Guitare Acoustique', 75, 'photoE.jpg', 'Produit E', 'Description détaillée du produit E', 'F5', 'C2'),
('P9', 35.00, 'Table de Mixage', 40, 'photoE.jpg', 'Produit E', 'Description détaillée du produit E', 'F5', 'C1'),
('P10', 28.50, 'Amplificateur de Guitare', 35, 'photoE.jpg', 'Produit E', 'Description détaillée du produit E', 'F5', 'C4');


INSERT INTO contient (Id_prod, Id_Produit, quantite) VALUES
('COM001', 'P1', '1'),
('COM002', 'P2', '1'),
('COM003', 'P3', '1'),
('COM004', 'P4', '1'),
('COM005', 'P5', '1');


INSERT INTO quantiter (Id_Bon_de_livraison, Id_Produit, quantite) VALUES
('BL1', 'P1', '1'),
('BL2', 'P2', '1'),
('BL3', 'P3', '1'),
('BL4', 'P4', '1'),
('BL5', 'P5', '1');