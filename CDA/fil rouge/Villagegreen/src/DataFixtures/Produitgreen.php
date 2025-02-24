<?php

namespace App\DataFixtures;


use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Produitgreen extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
       $sous_categorie= [
        ['SC1', 'Trombones.webp', 'Trombone'],
        ['SC2', 'syntétiseur.webp', 'Syntetiseur'],
        ['SC3', 'Saxophones.webp', 'Saxophones'],
        ['SC4', 'Piano_a_queue.webp', 'Piano_a_queue'],
        ['SC5', 'Intrument_folkore.webp', 'Intrument_folkore'],
        ['SC6', 'guitare_electrique.webp', 'Guitare_electrique'],
        ['SC7', 'guitare_acoutisque.webp', 'Guitare_acoutisque'],
        ['SC8', 'Cordes_frotées.webp', 'Cordes_frotées'],
        ['SC9', 'batterie_electroniques.webp', 'Batterie_electroniques'],
        ['SC10', 'Batterie_acoustiques.webp', 'Batterie_acoustiques']

       ];
      

      $categorie = [
        ['C1', 'Guitares', 'Guitare.webp', 'SC6','SC7'],
        ['C2', 'Violon', 'Violon.webp','SC8','SC5'],
        ['C3', 'Piano', 'Piano.webp','SC2','SC4'],
        ['C4', 'Intrument_a_vent', 'Intrument_a_vent.webp','SC1','SC2'],
        ['C5', 'Batterie', 'Batterie.webp','SC9','SC10'],



      ];


      $produit = [
        []






      ];


































        $manager->flush();
    }
}
