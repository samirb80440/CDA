<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeFormType;
use App\Repository\CommandeRepository;
use App\Service\PanierService;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CommandeController extends AbstractController
{
    private PanierService $panierService;
    private ProduitRepository $produitRepo;
    private CommandeRepository $commandeRepo;
    private EntityManagerInterface $entityManager;

    public function __construct(
        PanierService $panierService,
        ProduitRepository $produitRepo,
        CommandeRepository $commandeRepo,
        EntityManagerInterface $entityManager
    ) {
        $this->panierService = $panierService;
        $this->produitRepo = $produitRepo;
        $this->commandeRepo = $commandeRepo;
        $this->entityManager = $entityManager;
    }

    #[Route('/commande', name: 'app_commande')]
    public function new(Request $request): Response
    {
        $panier = $this->panierService->ShowPanier();

        if (empty($panier)) {
            return $this->redirectToRoute('app_panier');
        }

        $commande = new Commande();
        $commande->setUtilisateur($this->getUser());
        $commande->setDateCom(new \DateTime());
        $commande->setNumCom(uniqid());

        $form = $this->createForm(CommandeFormType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($commande);
            $this->entityManager->flush();

            $this->panierService->DeleteAllproduit();
            $this->addFlash('success', 'Vous allez être livré sous peu');

            return $this->redirectToRoute('app_index');
        }

        return $this->render('commande/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
