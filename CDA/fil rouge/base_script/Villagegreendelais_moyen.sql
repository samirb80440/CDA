DELIMITER $$

CREATE PROCEDURE CalculerDelaiMoyen()
BEGIN
    SELECT 
        AVG(DATEDIFF(date_fact, date_com)) AS DelaiMoyen
    FROM 
        Commande
    WHERE 
        date_fact IS NOT NULL AND date_com IS NOT NULL;
END $$

DELIMITER ;

CALL CalculerDelaiMoyen();