<?php 

namespace App\Service;

use App\Repository\ProduitRepository;
use App\Repository\SousCategorieRepository;


class BarreSearchService
{


    private $produitRepo;
    private $sousCategorieRepo;



    public function __construct(ProduitRepository $produitRepo,SousCategorieRepository $sousCategorieRepo)
    {
        // Initialisation des repositories
        $this->produitRepo = $produitRepo;
        $this->sousCategorieRepo = $sousCategorieRepo;
    }


    public function search($recherche): array
    {
        // Recherche dans les produits d'abord
        if ($this->SearchProduit($recherche) != null) {
            $result = $this->SearchProduit($recherche);  // Si un plat est trouvé, on retourne ce résultat
        } 
        // Si aucun produit n'est trouvé, on recherche dans les sousRubriques
        elseif ($this->SearchSouscategorie($recherche) != null) {
            $result = $this->SearchSouscategorie($recherche);  // Si une sousRubrique est trouvée, on retourne ce résultat
        } 
        // Si rien n'est trouvé dans les produits ni les sousRubriques, on retourne un tableau vide
        else {
            $result = [];
        }

        return $result;
    }

    public function SearchProduit($recherche): array
    {
        // Récupère tous les produits
        $produits = $this->produitRepo->findAll();
        $produitrecherche = [];  // Tableau pour stocker les résultats

        // Parcourt chaque produit pour vérifier s'il contient le terme de recherche
        foreach ($produits as $produit) {
            if (str_contains(strtolower($produit->getNomProd()), $recherche) or str_contains(strtolower($produit->getLibLongProd()), $recherche) or str_contains(strtolower($produit->getLibCourtProd()), $recherche)) {
                // Ajoute le produit dans le tableau des résultats si le terme de recherche est trouvé
                array_push($produitrecherche, $produit);
            }
        }
        return $produitrecherche;  // Retourne les produits correspondants
    }



    public function SearchSousCategorie($recherche): array
    {
        // Récupère toutes les sousRubriques
        $sousCategories = $this->sousCategorieRepo->findAll();
        $sousCategorierecherche = [];  // Tableau pour stocker les résultats

        // Parcourt chaque sousRubrique pour vérifier si elle contient le terme de recherche
        foreach ($sousCategories as $sousCategorie) {
            if (str_contains(strtolower($sousCategorie->getNomSousCategorie()), $recherche) or str_contains(strtolower($sousCategorie->getCategorie()->getNomCategorie()), $recherche)) {
                // Ajoute la sousRubrique dans le tableau des résultats si le terme de recherche est trouvé
                array_push($sousCategorierecherche, $sousCategorie);
            }
        }

        return $sousCategorierecherche ;  // Retourne les sousRubriques correspondantes
    }
}

