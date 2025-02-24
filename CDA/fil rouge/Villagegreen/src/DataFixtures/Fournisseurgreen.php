<?php

namespace App\DataFixtures;

use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Fournisseurgreen extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fournisseur = [
            ['F1', 'Yamaha Music', '12 Rue de la Musique, Paris','0123456789', 'contact@yamaha.fr'],
            ['F2', 'Fender Instruments', '34 Avenue des Guitares, Lyon','0234567890', 'info@fender.com'],
            ['F3', 'Pearl Drums', '56 Boulevard des Rythmes, Marseille','0345678901', 'support@pearldrums.com'],
            ['F4', 'Roland Digital', '78 Allée des Claviers, Toulouse','0456789012', 'sales@roland.com'],
            ['F5', 'Gibson Europe', '90 Chemin des Cordes, Nice','0567890123', 'service@gibson.com'],
            ['F6', 'Ibanez France', '21 Impasse des Sons, Bordeaux','0678901234', 'contact@ibanez.fr'],
            ['F7', 'Boss Amps', '43 Route des Ampli, Lille','0789012345', 'info@boss.com'],
            ['F8', 'Korg Electronics', '65 Place des Synthés, Nantes','0890123456', 'support@korg.com'],
            ['F9', 'Shure Audio', '87 Quai des Micros, Strasbourg','0912345678', 'help@shure.com'],
            ['F10', 'Zoom Corp', '109 Rue des Effets, Rennes','0123987654', 'zoom@zoomcorp.com']



        ];

        foreach ($fournisseur as [$id,$nom,$adresse, $numerodetelephone, $email]) {
            $fournisseur = new Fournisseur();
            $fournisseur->setNomFournisseur($nom);
            $fournisseur->setContactFournisseur($email);
            $fournisseur->setAdresseFournisseur($adresse);
            $fournisseur->setTelephoneFournisseur($numerodetelephone);;


            $manager->persist($fournisseur);
        }





        $manager->flush();
    }
}
