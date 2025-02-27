DROP DATABASE IF EXISTS Villagegreen;
CREATE DATABASE Villagegreen;
USE Villagegreen;


CREATE TABLE utilisateur(
   Id_utili VARCHAR(50) ,
   nom_cli VARCHAR(50) ,
   cate_cli BOOLEAN,
   coeff_cli INT,
   email VARCHAR(255),
   num_telephone VARCHAR(50) ,
   mot_de_passe VARCHAR(50) ,
   PRIMARY KEY(Id_utili)
);

CREATE TABLE Bon_de_livraison(
   Id_Bon_de_livraison VARCHAR(50) ,
   num_livrais VARCHAR(50) ,
   logo_entreprise VARCHAR(10) ,
   date_liv_com DATE,
   PRIMARY KEY(Id_Bon_de_livraison)
);

CREATE TABLE Commande(
   Id_prod VARCHAR(50),
   prix_achat_com DECIMAL(7,2),
   prix_vente_com DECIMAL(7,2),
   condtion_reg BOOLEAN,
   date_fact DATE,
   num_fact VARCHAR(50),
   reduction DECIMAL(5,2),
   com_exp BOOLEAN,
   num_com VARCHAR(50),
   nom_com VARCHAR(50),
   date_com DATE,
   total_ttc INT,
   taux_tva DECIMAL(5,2),
   adresse_livrai VARCHAR(50),
   prix_htva INT,
   indic_reduc BOOLEAN,
   total_htva INT,
   adresse_factu VARCHAR(50),
   Id_Bon_de_livraison VARCHAR(50) NOT NULL,
   Id_utili VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_prod),
   FOREIGN KEY(Id_Bon_de_livraison) REFERENCES Bon_de_livraison(Id_Bon_de_livraison),
   FOREIGN KEY(Id_utili) REFERENCES utilisateur(Id_utili)
);

CREATE TABLE Fournisseur(
   Id_Fournisseur VARCHAR(50) ,
   nom_fournisseur VARCHAR(100) ,
   contact_fournisseur_ VARCHAR(100) ,
   adresse_fournisseur VARCHAR(50) ,
   telephone_fournisseur_ VARCHAR(50) ,
   PRIMARY KEY(Id_Fournisseur)
);

CREATE TABLE Sous_categorie(
   Id_Sous_categorie VARCHAR(50) ,
   image_sous_categorie VARCHAR(50) ,
   nom_sous_categorie VARCHAR(50) ,
   PRIMARY KEY(Id_Sous_categorie)
);

CREATE TABLE Categorie(
   Id_Categorie VARCHAR(50) ,
   nom_categorie VARCHAR(50) ,
   image_categorie VARCHAR(50) ,
   Id_Sous_categorie VARCHAR(50)  NOT NULL,
   PRIMARY KEY(Id_Categorie),
   FOREIGN KEY(Id_Sous_categorie) REFERENCES Sous_categorie(Id_Sous_categorie)
);




CREATE TABLE Produit(
   Id_Produit VARCHAR(50) ,
   prix_achat VARCHAR(20) ,
   nom_prod VARCHAR(50) ,
   stock_prod INT,
   photo_produit VARCHAR(60) ,
   lib_court_prod VARCHAR(50) ,
   lib_long_prod VARCHAR(200) ,
   Id_fournisseur VARCHAR(50)  NOT NULL,
   Id_Categorie VARCHAR(50)  NOT NULL,
   PRIMARY KEY(Id_Produit),
   FOREIGN KEY(Id_fournisseur) REFERENCES Fournisseur(Id_fournisseur),
   FOREIGN KEY(Id_Categorie) REFERENCES Categorie(Id_Categorie)
);


CREATE TABLE contient (
   Id_prod VARCHAR(50),                        
   Id_Produit VARCHAR(50),                    
   quantite INT,                              
   FOREIGN KEY(Id_prod) REFERENCES Commande(Id_prod),
   FOREIGN KEY(Id_Produit) REFERENCES Produit(Id_Produit)
);


CREATE TABLE quantiter(
   Id_Bon_de_livraison VARCHAR(50) ,
   Id_Produit VARCHAR(50) ,
   quantite INT ,
   PRIMARY KEY(Id_Bon_de_livraison, Id_Produit),
   FOREIGN KEY(Id_Bon_de_livraison) REFERENCES Bon_de_livraison(Id_Bon_de_livraison),
   FOREIGN KEY(Id_Produit) REFERENCES Produit(Id_Produit)
);






