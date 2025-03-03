<?php

namespace App\DataFixtures;

use App\Entity\Contient;
use App\Entity\Quantiter;
use App\Entity\Bondelivraison;
use App\Entity\Commande;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Jeu5villagreen extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $contient=[
            [1,1,1],
            [9,2,2],
            [8,3,3],
            [7,4,4],


        ];

      foreach($contient as[$quantite,$idproduction,$idproduit]){
      $contient = new Contient();
      $contient->setQuantite($quantite);
      
      $commande =$manager->getRepository(Commande::class)->find($idproduction);
      $contient->setCommande($commande);


      $produit =$manager->getRepository(Produit::class)->find($idproduit);
      $contient->setProduit($produit);

      $manager->persist($contient);


      }

      $manager->flush();


      $quantiter=[
        [1,1,2],
        [9,2,3],
        [8,3,4],
        [7,4,1],
      
      ];
 
      foreach($quantiter as[$quantite,$idBonlivraison,$idproduit]){
      $quantiter= new Quantiter();
      $quantiter->setQuantite($quantite);


      $bonDeLivraison =$manager->getRepository(Bondelivraison::class)->find($idBonlivraison);
      $quantiter->setBonDeLivraison($bonDeLivraison);

      $produit =$manager->getRepository(Produit::class)->find($idproduit);
      $quantiter->setProduit($produit);

      $manager->persist($quantiter);
        


      }



        $manager->flush();
    }
}
