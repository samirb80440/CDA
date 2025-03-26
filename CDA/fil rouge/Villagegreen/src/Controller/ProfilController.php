<?php

namespace App\Controller;

use App\Form\ModifAdressesFormType;
use App\Form\ModifmotdepassType;
use App\Repository\CommandeRepository;
use App\Entity\Utilisateur;
use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
            'utilisateur' => $utilisateur,
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
            'form' => $form->createView(), // Passer le formulaire à la vue
        ]);
    }

    #[Route('/profil/modifier-password', name: 'app_modifier_password')]
    public function modifierPassword(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    
        /** @var Utilisateur $utilisateur */
        $utilisateur = $this->getUser();
    
        if (!$utilisateur instanceof Utilisateur) {
            throw $this->createAccessDeniedException("Vous devez être connecté pour modifier votre mot de passe.");
        }
    
        $form = $this->createForm(ModifmotdepassType::class);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $ancienMotDePasse = $form->get('passwordActuel')->getData();
            $nouveauMotDePasse = $form->get('passwordActuelNew1')->getData();
            $confirmationMotDePasse = $form->get('passwordActuelNew2')->getData();
    
            if (!$userPasswordHasher->isPasswordValid($utilisateur, $ancienMotDePasse)) {
                $this->addFlash('danger', 'Votre mot de passe actuel est incorrect.');
                return $this->redirectToRoute('app_modifier_password');
            }
    
            if ($nouveauMotDePasse !== $confirmationMotDePasse) {
                $this->addFlash('danger', 'Les nouveaux mots de passe ne correspondent pas.');
                return $this->redirectToRoute('app_modifier_password');
            }
    
            // Hachage et enregistrement du nouveau mot de passe
            $utilisateur->setPassword($userPasswordHasher->hashPassword($utilisateur, $nouveauMotDePasse));
            $em->persist($utilisateur);
            $em->flush();
    
            $this->addFlash('success', 'Votre mot de passe a été modifié avec succès.');
            return $this->redirectToRoute('app_utilisateur');
        }
    
        return $this->render('profil/modifPassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}
