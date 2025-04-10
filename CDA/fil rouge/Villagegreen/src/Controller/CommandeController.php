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
        $total = $this->panierService->getTotal();

        if (empty($panier)) {
            return $this->redirectToRoute('app_panier');
        }

        $commande = new Commande();
        $commande->setPrixVenteCom($total);
        $commande->setUtilisateur($this->getUser());
        $commande->setDateCom(new \DateTime());

        // Ajout : date de facturation = 5 jours après dateCom
        $dateFact = (clone $commande->getDateCom())->modify('+5 days');
        $commande->setDateFact($dateFact);

        $lastCommande = $this->commandeRepo->findLast(); // à implémenter
        $nextId = $lastCommande ? $lastCommande->getId() + 1 : 1;
        $year = (new \DateTime())->format('Y');
        $generatedNom = sprintf('COM-%s-%06d', $year, $nextId);

        $prefix = 'FAC';
        $date = (new \DateTime())->format('Ymd'); // ex: 20250410
        $uniqueId = strtoupper(uniqid()); // ou tu peux faire un compteur
        $numFact = $prefix . $date . substr($uniqueId, -5); // ex: FAC20250410A1B2C

        $commande->setNumFact($numFact);

        $commande->setNomCom($generatedNom);
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
            'sous_total' => $total,
        ]);
    }
}
