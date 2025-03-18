<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use App\Security\UtilisateurFormAuthenticator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        Security $security,
        EntityManagerInterface $entityManager
    ): Response {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string|null $plainPassword */
            $password = $form->get('password')->getData();

            if ($password) {
                // Encode the plain password
                $user->setPassword($userPasswordHasher->hashPassword($user, $password));
            }

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre compte client a bien été créé');

            return $security->login($user, UtilisateurFormAuthenticator::class, 'main');
        }

        return $this->render('registration/index.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
