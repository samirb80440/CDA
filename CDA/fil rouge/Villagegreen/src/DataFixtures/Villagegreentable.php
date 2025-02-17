<?php

namespace App\DataFixtures;


use App\Entity\Utilisateur;
use App\Entity\BonDeLivraison;
use App\Entity\Commande;
use App\Entity\Fournisseur;
use App\Entity\SousCategorie;
use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\Quantiter;
use App\Entity\Contient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Villagegreentable extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
