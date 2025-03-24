<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use App\Repository\SousCategorieRepository;
use App\Service\BarreSearchService;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $categorieRepo;
    private $produitRepo;
    private $sousCategorieRepo;

    public function __construct(CategorieRepository $categorieRepo, ProduitRepository $produitRepo, SousCategorieRepository $sousCategorieRepo)
    {
        $this->categorieRepo = $categorieRepo;
        $this->produitRepo = $produitRepo;
        $this->sousCategorieRepo = $sousCategorieRepo;
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $categories = $this->categorieRepo->findAll();
        $produits = $this->produitRepo->findBy([], null, 3);

        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
            'categories' => $categories,
            'produits' => $produits,
        ]);
    }


    #[Route('/sous-categorie', name: 'app_sousCategorie')]
    public function SousCategorie(): Response
    {
        $sous_categories = $this->sousCategorieRepo->findAll();

        return $this->render('catalogue/sousCategories.html.twig', [
            'sous_categories' => $sous_categories,
        ]);
    }

    #[Route('/sous-categorie-{id}', name: 'app_selectSousCategorie', requirements: ['id' => '\d+'])]
    public function SelectSousCategorie(int $id): Response
    {
            $categories = $this->categorieRepo->find($id);
           


            $sous_categories = $categories->getSousCategories();

            return $this->render('catalogue/sousCategories.html.twig',[
                'sous_categories' => $sous_categories,

            ]);
    }

    #[Route('/produits', name:'app_produits')]
    public function Produit(): Response
    {
        $produits = $this->produitRepo->findAll();

        return $this->render('catalogue/produits.html.twig', [
            'produits' => $produits,
        
    ]);
     

    }
   
   


    #[Route('/produits-{id}', name:'app_selectproduit', requirements: ['id' => '\d+'])]
    public function SelectProduit(int $id ): Response
    {
        $souscategories = $this->sousCategorieRepo->find($id);

        // Vérifier si la sous-catégorie existe
        if (!$souscategories) {
            // Si la sous-catégorie n'existe pas, afficher un message d'erreur ou rediriger
            $this->addFlash('danger', 'Sous-catégorie introuvable.');
            return $this->redirectToRoute('app_index');
        }

        $souscategories = $this->sousCategorieRepo->find($id);
        $produits = $souscategories->getProduits();
       

        return $this->render('catalogue/produits.html.twig', [
            'produits' => $produits,
        
    ]);
    
    }

    #[Route('/produits/{id}', name:'app_detailproduit', requirements: ['id' => '\d+'])]
    public function DetailProduit(Produit $produit ): Response
    {
        

        return $this->render('catalogue/detailproduits.html.twig', [
            'produit' => $produit
        
    ]);

    }

    #[Route('/recherche', name: 'app_recherche')]
    public function ShowRecherche(BarreSearchService $searchService): Response
    {
        // Récupère la recherche depuis les paramètres GET
        $recherche = $_GET['recherche'];

        // Si la recherche correspond à un plat, on affiche les plats
        if ($searchService->SearchProduit($recherche) != null) {
            $produit = $searchService->SearchProduit($recherche);
            $this->addFlash('success', count($produit).' produit(s) trouvé pour votre recherche');
            return $this->render('catalogue/produits.html.twig', [
                'produits' => $produit,
            ]);
        }

        elseif ($searchService->SearchSouscategorie($recherche) != null) {
            $sousCategorie = $searchService->SearchSouscategorie($recherche);
            $this->addFlash('success', count($sousCategorie).' sous-categorie(s) trouvé pour votre recherche');
            return $this->render('catalogue/sousCategories.html.twig', [
                'sousCategories' => $sousCategorie ,
            ]);
        }
        
        // Si rien n'est trouvé, on redirige vers la page d'accueil
        else {
            $this->addFlash('danger', 'aucun resultat trouvé pour votre recherche');
            return $this->redirectToRoute('app_index');
        }
    }
}
















