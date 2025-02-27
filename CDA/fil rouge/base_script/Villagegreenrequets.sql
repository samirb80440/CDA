SELECT 
    MONTH(date_com) AS Mois,
    YEAR(date_com) AS Annee,
    SUM(total_ttc) AS ChiffreAffaires
FROM 
    Commande
WHERE 
    YEAR(date_com) = 2025  
GROUP BY 
    YEAR(date_com), MONTH(date_com)
ORDER BY 
    MONTH(date_com);




SELECT 
    f.nom_fournisseur,
    SUM(c.total_ttc) AS ChiffreAffaires
FROM 
    Commande c
INNER JOIN 
    contient ct ON c.id_prod = ct.id_prod
INNER JOIN 
    Produit p ON ct.Id_Produit = p.Id_Produit
INNER JOIN 
    Fournisseur f ON p.Id_Fournisseur = f.Id_Fournisseur
WHERE 
    f.Id_Fournisseur = 'F1' 
GROUP BY 
    f.nom_fournisseur;


SELECT 
    p.Id_Produit,
    p.nom_prod,
    SUM(CAST(ct.quantite AS INT)) AS QuantiteCommandee,
    f.nom_fournisseur
FROM 
    Commande c
INNER JOIN 
    contient ct ON c.id_prod = ct.id_prod
INNER JOIN 
    Produit p ON ct.Id_Produit = p.Id_Produit
INNER JOIN 
    Fournisseur f ON p.Id_Fournisseur = f.Id_Fournisseur
WHERE 
    YEAR(c.date_com) = 2025 
GROUP BY 
    p.Id_Produit, p.nom_prod, f.nom_fournisseur
ORDER BY 
    QuantiteCommandee DESC
LIMIT 10;


SELECT 
    p.Id_Produit,
    p.nom_prod,
    SUM((c.prix_vente_com - c.prix_achat_com) * CAST(ct.quantite AS INT)) AS MargeTotale,
    f.nom_fournisseur
FROM 
    Commande c
INNER JOIN 
    contient ct ON c.id_prod = ct.id_prod
INNER JOIN 
    Produit p ON ct.Id_Produit = p.Id_Produit
INNER JOIN 
    Fournisseur f ON p.Id_Fournisseur  = f.Id_Fournisseur
WHERE 
    YEAR(c.date_com) = 2025  
GROUP BY 
    p.Id_Produit, p.nom_prod, f.nom_fournisseur
ORDER BY 
    MargeTotale DESC
LIMIT 10;





SELECT 
    u.nom_cli,
    SUM(c.total_ttc) AS ChiffreAffaires
FROM 
    Commande c
INNER JOIN 
    utilisateur u ON c.Id_utili = u.Id_utili
WHERE 
    YEAR(c.date_com) = 2025  
GROUP BY 
    u.nom_cli
ORDER BY 
    ChiffreAffaires DESC
LIMIT 10;




SELECT 
    CASE
        WHEN u.cate_cli = TRUE THEN 'Client Professionnel'
        ELSE 'Client Particulier'
    END AS TypeClient,
    SUM(c.total_ttc) AS ChiffreAffaires
FROM 
    Commande c
INNER JOIN 
    utilisateur u ON c.Id_utili = u.Id_utili
WHERE 
    YEAR(c.date_com) = 2025  
GROUP BY 
    TypeClient
ORDER BY 
    ChiffreAffaires DESC;

SELECT 
    COUNT(c.num_com) AS NombreCommandesEnCours
FROM 
    Commande c
INNER JOIN 
    Bon_de_livraison b ON c.Id_Bon_de_livraison = b.Id_Bon_de_livraison
WHERE 
    c.com_exp = FALSE  -- Commandes non réglées
    AND b.date_liv_com > NOW()  -- Commandes dont la date de livraison est dans le futur
    AND YEAR(c.date_com) = 2025  -- Remplacez 2025 par l'année souhaitée
;





