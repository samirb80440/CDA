<?php

namespace App\DataFixtures;

use App\Entity\Bondelivraison;
use App\Entity\Commande;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Bonlivraisoncommande extends Fixture
{
    public function load(ObjectManager $manager): void
    {
          // Liste des bons de livraison
          $bonLivraisonData = [
            ['LIV001', 'icon8_harpe-50.png', new \DateTime('2025-01-01')],
            ['LIV002', 'icon8_harpe-50.png', new \DateTime('2025-01-02')],
            ['LIV003', 'icon8_harpe-50.png', new \DateTime('2025-01-03')],
            ['LIV004', 'icon8_harpe-50.png', new \DateTime('2025-01-04')],
            ['LIV005', 'icon8_harpe-50.png', new \DateTime('2025-01-05')],
        ];

        foreach ($bonLivraisonData as [ $numLivrais, $logoEntreprise, $dateLivCom]) {
            $bonDeLivraison = new BonDeLivraison();
            $bonDeLivraison->setNumLivrais($numLivrais);
            $bonDeLivraison->setLogoEntreprise($logoEntreprise);
            $bonDeLivraison->setDateLivCom($dateLivCom);

            $manager->persist($bonDeLivraison);
        }

        $manager->flush();
    }
}
