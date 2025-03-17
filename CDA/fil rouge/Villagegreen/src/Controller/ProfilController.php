<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use App\Entity\Utilisateur;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfilController extends AbstractController
{

   private $commanderepo;

   public function __construct(CommandeRepository $commanderepo)
   {
       $this->commanderepo = $commanderepo;
       
   }


    #[Route('/profil', name: 'app_utilisateur')]
    public function DetailsUtilisateur(): Response
    {

        $utilisateur = $this->getUser();
       



        return $this->render('profil/index.html.twig', [
            'utilisateur'=> $utilisateur,
           
        ]);
    }
}
