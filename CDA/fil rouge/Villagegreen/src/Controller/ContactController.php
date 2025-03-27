<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Manager\ContactManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request,  ContactManager $ContactManager): Response
    {
        $contact = new Contact();
        $utilisateur = $this->getUser();

        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setUtilisateur($utilisateur);
            $ContactManager->setContact($contact);


            $this->addFlash('success', 'Vous allez être contacté sous peu');
            return $this->redirectToRoute('app_index');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/politique_de_confidentialite', name: 'app_pdf')]
    public function politiqueconf(): Response
    {
        // Rendu de la vue de politique de confidentialité
        return $this->render('contact/politique_de_confidentialite.html.twig');
    }

    // Définition de la route pour la page de mention légale
    #[Route('/mention_legale', name: 'app_mention_legale')]
    public function mention_legale(): Response
    {
        // Rendu de la vue de mention légale
        return $this->render('contact/mention_legale.html.twig');
    }


    #[Route('/qui_sommes_nous', name: 'app_qui_sommes_nous')]
    public function qui_sommes_nous(): Response
    {
        // Rendu de la vue de mention légale
        return $this->render('contact/qui_sommes_nous.html.twig');
    }





}
