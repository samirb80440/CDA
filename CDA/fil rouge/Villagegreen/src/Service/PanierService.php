<?php


namespace App\Service;

use App\Entity\Utilisateur;
use App\Entity\Commande;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\SecurityBundle\Security;



class PanierService
{  
    private $produitrepo;
    private $requestStack;
    private $security;


    public function __construct(RequestStack $requestStack, ProduitRepository $produitrepo, Security $security)
    {
        $this->requestStack = $requestStack;
        $this->produitrepo = $produitrepo;
        $this->security = $security;

    }


    public function getUser(): ?Utilisateur
    {
        return $this->security->getUser();
    }

    public function ShowPanier(): array 
    {
        $session=$this->requestStack->getSession();

        return $session->get('panier',[]);
    }

    

    public function ShowDataPanier()
    {
        $panier =$this->ShowPanier();

        $dataPanier = [];

        foreach ($panier as $id => $quantite) {
            $produit = $this->produitrepo->find($id);
            $dataPanier[] = [
                'produit' => $produit,
                'quantite' => $quantite,
                ];
                }
                return $dataPanier;
    }

    
    public function getTotal(): float
    {

        $panier = $this->ShowPanier();
        $total = 0;
        $user = $this->getUser();
       
    foreach ($panier as $id => $quantite) {
        $produit = $this->produitrepo->find($id);
        if ($user != null && $user->getCoeffcli() !== null){
            $coefficientvente = $user->getCoeffcli() / 100; // Convertit en % correctement
        } else {
            $coefficientvente = 0.20; // Coefficient par défaut
        }
        
        $prixProduit = round($produit->getPrixAchat() * (1 + $coefficientvente), 2);
        $total += round($prixProduit * $quantite, 2);
    }
    
        return $total;


    }

    public Function getQuantite(): int 
    {

        $panier = $this-> ShowPanier();
        $nombrearticle = 0;


         foreach ($panier as $id => $quantite) {
            $nombrearticle += $quantite;
         }

         return $nombrearticle;


    }


    public function AddOneQuantity(produit $produit): void{

     $session = $this->requestStack->getSession();
     $panier = $session->get('panier',[]);
     $id = $produit->getId();

     if (!empty($panier[$id])){
        $panier[$id]++;
     } else {
        $panier[$id] = 1;
     }

     $session->set('panier',$panier);

    }


    public function RemoveOneQuantity(produit $produit): void
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier',[]);
        $id = $produit->getId();


        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
        } else{
            unset($panier[$id]);
        }

        }

        $session->set('panier', $panier);

    }
     
    public function DeleteOneProduit(produit $produit): void 
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier',[]);
        $id = $produit->getId();

        if (!empty($panier[$id])){
            unset($panier[$id]);
        }
        $session->set('panier',$panier);

    }


    public function DeleteAllproduit(): void
    {

     $session = $this->requestStack->getSession();
     $session->set('panier',[]);



    }



}