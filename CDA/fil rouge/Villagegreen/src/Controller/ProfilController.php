<?php

namespace App\Controller;

use App\Form\ModifAdressesFormType;
use App\Repository\CommandeRepository;
use App\Entity\Utilisateur;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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


    #[Route('/modifadresse', name: 'app_modif_adresse')]
    public function Modifadresse(Request $request, EntityManagerInterface $em): Response
    {
        // Récupérer l'utilisateur connecté
        $utilisateur = $this->getUser();
    
        // Vérifier que l'utilisateur est bien connecté
        if (!$utilisateur) {
            throw $this->createAccessDeniedException("Vous devez être connecté pour modifier votre adresse.");
        }
    
        // Créer le formulaire avec l'entité utilisateur
        $form = $this->createForm(ModifAdressesFormType::class, $utilisateur);
        $form->handleRequest($request);
    
        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($utilisateur);
            $em->flush();
    
            // Rediriger après modification
            $this->addFlash('success', 'Adresse mise à jour avec succès.');
            return $this->redirectToRoute('app_utilisateur'); // Remplace par ta route cible
        }
    
        return $this->render('profil/Modifadresse.html.twig', [
            'form' => $form, // Passer le formulaire à la vue
        ]);
    }













}



