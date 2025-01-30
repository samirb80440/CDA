/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Villagegreen
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Bon_de_livraison`
--

DROP TABLE IF EXISTS `Bon_de_livraison`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Bon_de_livraison` (
  `Id_Bon_de_livraison` varchar(50) NOT NULL,
  `num_livrais` varchar(50) DEFAULT NULL,
  `logo_entreprise` varchar(10) DEFAULT NULL,
  `date_liv_com` date DEFAULT NULL,
  PRIMARY KEY (`Id_Bon_de_livraison`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bon_de_livraison`
--

LOCK TABLES `Bon_de_livraison` WRITE;
/*!40000 ALTER TABLE `Bon_de_livraison` DISABLE KEYS */;
INSERT INTO `Bon_de_livraison` VALUES
('BL1','LIV001','Logo1','2025-01-01'),
('BL2','LIV002','Logo2','2025-01-02'),
('BL3','LIV003','Logo3','2025-01-03'),
('BL4','LIV004','Logo4','2025-01-04'),
('BL5','LIV005','Logo5','2025-01-05');
/*!40000 ALTER TABLE `Bon_de_livraison` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Categorie`
--

DROP TABLE IF EXISTS `Categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categorie` (
  `Id_Categorie` varchar(50) NOT NULL,
  `nom_categorie` varchar(50) DEFAULT NULL,
  `image_categorie` varchar(50) DEFAULT NULL,
  `Id_Sous_categorie` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_Categorie`),
  KEY `Id_Sous_categorie` (`Id_Sous_categorie`),
  CONSTRAINT `Categorie_ibfk_1` FOREIGN KEY (`Id_Sous_categorie`) REFERENCES `Sous_categorie` (`Id_Sous_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categorie`
--

LOCK TABLES `Categorie` WRITE;
/*!40000 ALTER TABLE `Categorie` DISABLE KEYS */;
INSERT INTO `Categorie` VALUES
('C1','Guitares','guitares.jpg','SC1'),
('C2','Batteries','batteries.jpg','SC2'),
('C3','Pianos','pianos.jpg','SC3'),
('C4','Instruments à vent','vent.jpg','SC4');
/*!40000 ALTER TABLE `Categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Commande`
--

DROP TABLE IF EXISTS `Commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Commande` (
  `Id_prod` varchar(50) NOT NULL,
  `prix_achat_com` decimal(7,2) DEFAULT NULL,
  `prix_vente_com` decimal(7,2) DEFAULT NULL,
  `condtion_reg` tinyint(1) DEFAULT NULL,
  `date_fact` date DEFAULT NULL,
  `num_fact` varchar(50) DEFAULT NULL,
  `reduction` decimal(5,2) DEFAULT NULL,
  `com_exp` tinyint(1) DEFAULT NULL,
  `num_com` varchar(50) DEFAULT NULL,
  `nom_com` varchar(50) DEFAULT NULL,
  `date_com` date DEFAULT NULL,
  `total_ttc` int(11) DEFAULT NULL,
  `taux_tva` decimal(5,2) DEFAULT NULL,
  `adresse_livrai` varchar(50) DEFAULT NULL,
  `prix_htva` int(11) DEFAULT NULL,
  `indic_reduc` tinyint(1) DEFAULT NULL,
  `total_htva` int(11) DEFAULT NULL,
  `adresse_factu` varchar(50) DEFAULT NULL,
  `Id_Bon_de_livraison` varchar(50) NOT NULL,
  `Id_utili` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_prod`),
  KEY `Id_Bon_de_livraison` (`Id_Bon_de_livraison`),
  KEY `Id_utili` (`Id_utili`),
  CONSTRAINT `Commande_ibfk_1` FOREIGN KEY (`Id_Bon_de_livraison`) REFERENCES `Bon_de_livraison` (`Id_Bon_de_livraison`),
  CONSTRAINT `Commande_ibfk_2` FOREIGN KEY (`Id_utili`) REFERENCES `utilisateur` (`Id_utili`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Commande`
--

LOCK TABLES `Commande` WRITE;
/*!40000 ALTER TABLE `Commande` DISABLE KEYS */;
INSERT INTO `Commande` VALUES
('COM001',150.00,200.00,1,'2025-01-01','F001',10.00,1,'COM001','Guitare acoustique Yamaha','2025-01-01',220,20.00,'Paris',180,1,180,'Paris','BL1','U1'),
('COM002',300.00,400.00,0,'2025-01-02','F002',5.00,0,'COM002','Batterie Pearl Export','2025-01-02',420,20.00,'Lyon',350,0,350,'Lyon','BL2','U2'),
('COM003',500.00,600.00,1,'2025-01-03','F003',15.00,1,'COM003','Piano numérique Roland','2025-01-03',690,20.00,'Marseille',580,1,580,'Marseille','BL3','U3'),
('COM004',100.00,120.00,1,'2025-01-04','F004',0.00,0,'COM004','Flûte traversière Yamaha','2025-01-04',144,20.00,'Paris',120,1,120,'Paris','BL4','U4'),
('COM005',200.00,250.00,1,'2025-01-05','F005',10.00,1,'COM005','Guitare électrique Fender','2025-01-05',300,20.00,'Nice',250,1,250,'Nice','BL5','U5');
/*!40000 ALTER TABLE `Commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Fournisseur`
--

DROP TABLE IF EXISTS `Fournisseur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Fournisseur` (
  `Id_Fournisseur` varchar(50) NOT NULL,
  `nom_fournisseur` varchar(100) DEFAULT NULL,
  `contact_fournisseur_` varchar(100) DEFAULT NULL,
  `adresse_fournisseur` varchar(50) DEFAULT NULL,
  `telephone_fournisseur_` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Fournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Fournisseur`
--

LOCK TABLES `Fournisseur` WRITE;
/*!40000 ALTER TABLE `Fournisseur` DISABLE KEYS */;
INSERT INTO `Fournisseur` VALUES
('F1','Yamaha Music','contact@yamaha.fr','12 Rue de la Musique, Paris','0123456789'),
('F10','Zoom Corp','zoom@zoomcorp.com','109 Rue des Effets, Rennes','0123987654'),
('F2','Fender Instruments','info@fender.com','34 Avenue des Guitares, Lyon','0234567890'),
('F3','Pearl Drums','support@pearldrums.com','56 Boulevard des Rythmes, Marseille','0345678901'),
('F4','Roland Digital','sales@roland.com','78 Allée des Claviers, Toulouse','0456789012'),
('F5','Gibson Europe','service@gibson.com','90 Chemin des Cordes, Nice','0567890123'),
('F6','Ibanez France','contact@ibanez.fr','21 Impasse des Sons, Bordeaux','0678901234'),
('F7','Boss Amps','info@boss.com','43 Route des Ampli, Lille','0789012345'),
('F8','Korg Electronics','support@korg.com','65 Place des Synthés, Nantes','0890123456'),
('F9','Shure Audio','help@shure.com','87 Quai des Micros, Strasbourg','0912345678');
/*!40000 ALTER TABLE `Fournisseur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Produit`
--

DROP TABLE IF EXISTS `Produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Produit` (
  `Id_Produit` varchar(50) NOT NULL,
  `prix_achat` varchar(20) DEFAULT NULL,
  `nom_prod` varchar(50) DEFAULT NULL,
  `stock_prod` int(11) DEFAULT NULL,
  `photo_produit` varchar(20) DEFAULT NULL,
  `lib_court_prod` varchar(50) DEFAULT NULL,
  `lib_long_prod` varchar(200) DEFAULT NULL,
  `Id_fournisseur` varchar(50) NOT NULL,
  `Id_Categorie` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_Produit`),
  KEY `Id_fournisseur` (`Id_fournisseur`),
  KEY `Id_Categorie` (`Id_Categorie`),
  CONSTRAINT `Produit_ibfk_1` FOREIGN KEY (`Id_fournisseur`) REFERENCES `Fournisseur` (`Id_Fournisseur`),
  CONSTRAINT `Produit_ibfk_2` FOREIGN KEY (`Id_Categorie`) REFERENCES `Categorie` (`Id_Categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Produit`
--

LOCK TABLES `Produit` WRITE;
/*!40000 ALTER TABLE `Produit` DISABLE KEYS */;
INSERT INTO `Produit` VALUES
('P1','15.50','guitare électrique',50,'photoA.jpg','Produit A','Description détaillée du produit A','F1','C1'),
('P10','45.25','Amplificateur de Guitare',35,'photoE.jpg','Produit E','Description détaillée du produit E','F5','C4'),
('P2','25.00','Piano a queue',200,'photoB.jpg','Produit B','Description détaillée du produit B','F2','C2'),
('P3','10.75','Batterie electriue',150,'photoC.jpg','Produit C','Description détaillée du produit C','F3','C3'),
('P4','35.00','Violoncelle',80,'photoD.jpg','Produit D','Description détaillée du produit D','F4','C4'),
('P5','45.25','Microphone Condensateur',60,'photoE.jpg','Produit E','Description détaillée du produit E','F5','C1'),
('P6','45.25','Casque Audio Hi-Fi',100,'photoE.jpg','Produit E','Description détaillée du produit E','F5','C3'),
('P7','45.25','Synthétiseur Analogique',25,'photoE.jpg','Produit E','Description détaillée du produit E','F5','C3'),
('P8','45.25','Guitare Acoustique',75,'photoE.jpg','Produit E','Description détaillée du produit E','F5','C2'),
('P9','45.25','Table de Mixage',40,'photoE.jpg','Produit E','Description détaillée du produit E','F5','C1');
/*!40000 ALTER TABLE `Produit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sous_categorie`
--

DROP TABLE IF EXISTS `Sous_categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sous_categorie` (
  `Id_Sous_categorie` varchar(50) NOT NULL,
  `image_sous_categorie` varchar(50) DEFAULT NULL,
  `nom_sous_categorie` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Sous_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sous_categorie`
--

LOCK TABLES `Sous_categorie` WRITE;
/*!40000 ALTER TABLE `Sous_categorie` DISABLE KEYS */;
INSERT INTO `Sous_categorie` VALUES
('SC1','image1.jpg','Cordes'),
('SC2','image2.jpg','Percussions'),
('SC3','image3.jpg','Claviers'),
('SC4','image4.jpg','Vent');
/*!40000 ALTER TABLE `Sous_categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `Vue_Produits_Categorie_SousCategorie`
--

DROP TABLE IF EXISTS `Vue_Produits_Categorie_SousCategorie`;
/*!50001 DROP VIEW IF EXISTS `Vue_Produits_Categorie_SousCategorie`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `Vue_Produits_Categorie_SousCategorie` AS SELECT
 1 AS `Id_Produit`,
  1 AS `nom_prod`,
  1 AS `prix_achat`,
  1 AS `stock_prod`,
  1 AS `photo_produit`,
  1 AS `lib_court_prod`,
  1 AS `lib_long_prod`,
  1 AS `nom_categorie`,
  1 AS `image_categorie`,
  1 AS `nom_sous_categorie`,
  1 AS `image_sous_categorie` */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `Vue_Produits_Fournisseurs`
--

DROP TABLE IF EXISTS `Vue_Produits_Fournisseurs`;
/*!50001 DROP VIEW IF EXISTS `Vue_Produits_Fournisseurs`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `Vue_Produits_Fournisseurs` AS SELECT
 1 AS `Id_Produit`,
  1 AS `nom_prod`,
  1 AS `prix_achat`,
  1 AS `stock_prod`,
  1 AS `photo_produit`,
  1 AS `lib_court_prod`,
  1 AS `lib_long_prod`,
  1 AS `Id_Fournisseur`,
  1 AS `nom_fournisseur`,
  1 AS `contact_fournisseur_`,
  1 AS `adresse_fournisseur`,
  1 AS `telephone_fournisseur_` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `contient`
--

DROP TABLE IF EXISTS `contient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contient` (
  `Id_prod` varchar(50) DEFAULT NULL,
  `Id_Produit` varchar(50) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  KEY `Id_prod` (`Id_prod`),
  KEY `Id_Produit` (`Id_Produit`),
  CONSTRAINT `contient_ibfk_1` FOREIGN KEY (`Id_prod`) REFERENCES `Commande` (`Id_prod`),
  CONSTRAINT `contient_ibfk_2` FOREIGN KEY (`Id_Produit`) REFERENCES `Produit` (`Id_Produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contient`
--

LOCK TABLES `contient` WRITE;
/*!40000 ALTER TABLE `contient` DISABLE KEYS */;
INSERT INTO `contient` VALUES
('COM001','P1',1),
('COM002','P2',1),
('COM003','P3',1),
('COM004','P4',1),
('COM005','P5',1);
/*!40000 ALTER TABLE `contient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quantiter`
--

DROP TABLE IF EXISTS `quantiter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quantiter` (
  `Id_Bon_de_livraison` varchar(50) NOT NULL,
  `Id_Produit` varchar(50) NOT NULL,
  `quantite` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Bon_de_livraison`,`Id_Produit`),
  KEY `Id_Produit` (`Id_Produit`),
  CONSTRAINT `quantiter_ibfk_1` FOREIGN KEY (`Id_Bon_de_livraison`) REFERENCES `Bon_de_livraison` (`Id_Bon_de_livraison`),
  CONSTRAINT `quantiter_ibfk_2` FOREIGN KEY (`Id_Produit`) REFERENCES `Produit` (`Id_Produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quantiter`
--

LOCK TABLES `quantiter` WRITE;
/*!40000 ALTER TABLE `quantiter` DISABLE KEYS */;
INSERT INTO `quantiter` VALUES
('BL1','P1','1'),
('BL2','P2','1'),
('BL3','P3','1'),
('BL4','P4','1'),
('BL5','P5','1');
/*!40000 ALTER TABLE `quantiter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateur` (
  `Id_utili` varchar(50) NOT NULL,
  `nom_cli` varchar(50) DEFAULT NULL,
  `cate_cli` tinyint(1) DEFAULT NULL,
  `coeff_cli` int(11) DEFAULT NULL,
  `num_telephone` varchar(50) DEFAULT NULL,
  `mot_de_passe` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_utili`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES
('U1','Alice Dupont',1,1,'0612345678','password123'),
('U10','Thomas Durand',1,2,'0623456789','pass10'),
('U2','Jean Martin',0,2,'0623456789','password456'),
('U3','Claire Leroy',1,1,'0634567890','password789'),
('U4','Paul Durand',0,2,'0645678901','password012'),
('U5','Sophie Lambert',1,1,'0656789012','password345'),
('U6','Lucas Dupont',1,3,'0654321987','pass6'),
('U7','Amélie Bernard',0,2,'0765432109','pass7'),
('U8','Julien Lefebvre',1,1,'0789123456','pass8'),
('U9','Emma Martin',0,3,'0612347890','pass9');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `Vue_Produits_Categorie_SousCategorie`
--

/*!50001 DROP VIEW IF EXISTS `Vue_Produits_Categorie_SousCategorie`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`samir`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `Vue_Produits_Categorie_SousCategorie` AS select `p`.`Id_Produit` AS `Id_Produit`,`p`.`nom_prod` AS `nom_prod`,`p`.`prix_achat` AS `prix_achat`,`p`.`stock_prod` AS `stock_prod`,`p`.`photo_produit` AS `photo_produit`,`p`.`lib_court_prod` AS `lib_court_prod`,`p`.`lib_long_prod` AS `lib_long_prod`,`c`.`nom_categorie` AS `nom_categorie`,`c`.`image_categorie` AS `image_categorie`,`sc`.`nom_sous_categorie` AS `nom_sous_categorie`,`sc`.`image_sous_categorie` AS `image_sous_categorie` from ((`Produit` `p` join `Categorie` `c` on(`p`.`Id_Categorie` = `c`.`Id_Categorie`)) join `Sous_categorie` `sc` on(`c`.`Id_Sous_categorie` = `sc`.`Id_Sous_categorie`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `Vue_Produits_Fournisseurs`
--

/*!50001 DROP VIEW IF EXISTS `Vue_Produits_Fournisseurs`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`samir`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `Vue_Produits_Fournisseurs` AS select `p`.`Id_Produit` AS `Id_Produit`,`p`.`nom_prod` AS `nom_prod`,`p`.`prix_achat` AS `prix_achat`,`p`.`stock_prod` AS `stock_prod`,`p`.`photo_produit` AS `photo_produit`,`p`.`lib_court_prod` AS `lib_court_prod`,`p`.`lib_long_prod` AS `lib_long_prod`,`p`.`Id_fournisseur` AS `Id_Fournisseur`,`f`.`nom_fournisseur` AS `nom_fournisseur`,`f`.`contact_fournisseur_` AS `contact_fournisseur_`,`f`.`adresse_fournisseur` AS `adresse_fournisseur`,`f`.`telephone_fournisseur_` AS `telephone_fournisseur_` from (`Produit` `p` join `Fournisseur` `f` on(`p`.`Id_fournisseur` = `f`.`Id_Fournisseur`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-30 10:48:41
