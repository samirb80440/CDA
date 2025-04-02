<?php

namespace App\Controller;

use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Produit;

final class PanierController extends AbstractController
{
   
    private $panierService;

    public function __construct(PanierService $panierService)
    {
        $this->panierService = $panierService;
    }



    #[Route('/panier', name: 'app_panier')]
    public function index(): Response
    {
     $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
     $panier = $this->panierService->ShowPanier();
     
     $dataPanier = $this->panierService->ShowDataPanier();
     $total = $this->panierService->getTotal();

     count($dataPanier);

        return $this->render('panier/index.html.twig', compact(
            "dataPanier",
            "total",
        ));
    }
    


    #[Route('/panier/ajout/{id}', name: 'app_ajout_panier', requirements: ['id' => '\d+'])]
    public function ajoutPanier(Produit $produit): Response
    {
        $this->panierService->AddOneQuantity($produit);
        return $this->redirectToRoute('app_panier');
    }


    #[Route('/panier/enlever/{id}', name:'app_enlever_panier',requirements: ['id' => '\d+'])]
    public function enleverPanier(Produit $produit): Response
    {
      $this->panierService->RemoveOneQuantity($produit);
      return $this->redirectToRoute('app_panier');
    }


    #[Route('/panier/supprimer/{id}', name:'app_supprimer_panier',requirements: ['id' => '\d+'])]
    public function supprimerPanier(Produit $produit): Response
    {
        $this->panierService->DeleteOneProduit($produit);
        return $this->redirectToRoute('app_panier');
    }

    #[Route('/panier/supprimer/all',name:'app_supprimer_panier_all',requirements: ['id' => '\d+'])]
    public function supprimerPanierAll(): Response
    {
        $this->panierService->DeleteAllProduit();
        $this->addFlash('succes','Votre panier a été vidées');
        return $this->redirectToRoute('app_panier');
    }

    



}

