DELIMITER $$

CREATE PROCEDURE GetCommandesNonSoldes()
BEGIN
    SELECT 
        c.id_prod AS CommandeID,
        c.num_com AS NumeroCommande,
        c.nom_com AS NomCommande,
        c.date_com AS DateCommande,
        c.total_ttc AS TotalTTC,
        c.adresse_livrai AS AdresseLivraison,
        b.num_livrais AS NumeroLivraison,
        b.date_liv_com AS DateLivraison
    FROM 
        Commande c
    INNER JOIN 
        Bon_de_livraison b ON c.Id_Bon_de_livraison = b.Id_Bon_de_livraison
    WHERE 
        c.com_exp = FALSE;
END $$

DELIMITER ;

CALL GetCommandesNonSoldes();
