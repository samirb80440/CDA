<?php

namespace App\DataFixtures;

use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Jeu2villagreen extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fournisseur = [
            ['Yamaha Music', '12 Rue de la Musique, Paris', '0123456789', 'contact@yamaha.fr',1],
            ['Fender Instruments', '34 Avenue des Guitares, Lyon', '0234567890', 'info@fender.com',2],
            ['Pearl Drums', '56 Boulevard des Rythmes, Marseille', '0345678901', 'support@pearldrums.com',3],
            ['Roland Digital', '78 Allée des Claviers, Toulouse', '0456789012', 'sales@roland.com',4]
        ];

        foreach ($fournisseur as [$nom, $adresse, $numerodetelephone, $email]) {
            $fournisseur = new Fournisseur();
            $fournisseur->setNomFournisseur($nom);
            $fournisseur->setContactFournisseur($email);
            $fournisseur->setAdresseFournisseur($adresse);
            $fournisseur->setTelephoneFournisseur($numerodetelephone);
        
            $manager->persist($fournisseur);
        
            
        }
        $manager->flush();
        
    }
}
