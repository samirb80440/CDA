<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Utilisateur;
use App\Entity\Bondelivraison;
use App\Entity\Commande;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Jeu4villagreen extends Fixture
{
    public function load(ObjectManager $manager): void
    {
          // Liste des bons de livraison
          $bonLivraisonData = [
            ['LIV001', 'icon8_harpe-50.png', new \DateTime('2025-01-01')],
            ['LIV002', 'icon8_harpe-50.png', new \DateTime('2025-01-02')],
            ['LIV003', 'icon8_harpe-50.png', new \DateTime('2025-01-03')],
            ['LIV004', 'icon8_harpe-50.png', new \DateTime('2025-01-04')],
            
        ];
         

        $commandeData = [
            [150.00, 200.00, TRUE, new \DateTime('2025-01-01'), 'F001', 10.00, 0, 'COM001', 'Guitare acoustique Yamaha', new \DateTime('2025-02-16'), 220, 20.00, 'Paris', 180, 0, 180, 'Paris',1,1],
            [300.00, 400.00, FALSE,new \DateTime('2025-01-02'), 'F002', 5.00, 1, 'COM002', 'Batterie Pearl Export', new \DateTime('2025-01-15'), 420, 20.00, 'Lyon', 350, 30, 350, 'Lyon',2,2],
            [500.00, 600.00, TRUE, new \DateTime('2025-01-03'), 'F003', 15.00, 1, 'COM003', 'Piano numérique Roland', new \DateTime('2025-09-27'), 690, 20.00, 'Marseille', 580, 0, 580, 'Marseille',3,3],
            [100.00, 120.00, TRUE, new \DateTime('2025-01-04'), 'F004', 0.00, 0, 'COM004', 'Flûte traversière Yamaha', new \DateTime('2025-12-04'), 144, 20.00, 'Paris', 120, 15, 120, 'Paris',4,4]
        ];


          

        
        foreach ($bonLivraisonData as [ $numLivrais, $logoEntreprise, $dateLivCom]) {
            $bonDeLivraison = new BonDeLivraison();
            $bonDeLivraison->setNumLivrais($numLivrais);
            $bonDeLivraison->setLogoEntreprise($logoEntreprise);
            $bonDeLivraison->setDateLivCom($dateLivCom);

            $manager->persist($bonDeLivraison);
        }

        $manager->flush();


        foreach ($commandeData as[$prixachat,$prixvente,$condtionregle,$datefact,$numfact,$reduction,$comexp,$numcom,$nomcom,$datecom,$totalttc,$tauxtva,$adresselivrais,$prixhtva,$indicereduc,$totalHtva,$adressefactu,$idBonlivraison,$idUtilisateur]){
        $commande = new Commande();
        $commande->setPrixAchatCom($prixachat);
        $commande->setPrixVenteCom($prixvente);
        $commande->setConditionReg($condtionregle);
        $commande->setDateFact($datefact);
        $commande->setNumFact($numfact);
        $commande->setReduction($reduction);
        $commande->setComExp($comexp);
        $commande->setNumCom($numcom);
        $commande->setNomCom($nomcom);
        $commande->setDateCom($datecom);
        $commande->setTotalTtc($totalttc);
        $commande->setTauxTva($tauxtva);
        $commande->setAdresseLivrai($adresselivrais);
        $commande->setPrixHtva($prixhtva);
        $commande->setIndicReduc($indicereduc);
        $commande->setTotalHtva($totalHtva);
        $commande->setAdresseFactu($adressefactu);
        
        $bonDeLivraison =$manager->getRepository(Bondelivraison::class)->find($idBonlivraison);
        $commande->setBondelivraison($bonDeLivraison);
        
        
        
        $utilisateurs=$manager->getRepository(Utilisateur::class)->find($idUtilisateur);
        $commande->setUtilisateur($utilisateurs);
         

        $manager->persist($commande);

        }


    $manager->flush();



        


    }
}
