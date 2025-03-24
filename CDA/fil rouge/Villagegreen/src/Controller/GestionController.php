<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\Fournisseur;
use App\Entity\SousCategorie;
use Symfony\Bundle\SecurityBundle\Attribute\IsGranted;
use App\Form\AjoutProduitType;
use App\Repository\UtilisateurRepository;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use App\Repository\FournisseurRepository;
use App\Repository\SousCategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

final class GestionController extends AbstractController
{
    private UtilisateurRepository $utilisateurRepo;
    private CategorieRepository $categorieRepo;
    private ProduitRepository $produitRepo;
    private FournisseurRepository $fournisseurRepo;
    private SousCategorieRepository $sousCategorieRepo;
    private EntityManagerInterface $entityManager;

    public function __construct(
        UtilisateurRepository $utilisateurRepo,
        CategorieRepository $categorieRepo,
        ProduitRepository $produitRepo,
        FournisseurRepository $fournisseurRepo,
        SousCategorieRepository $sousCategorieRepo,
        EntityManagerInterface $entityManager
    ) {
        $this->utilisateurRepo = $utilisateurRepo;
        $this->categorieRepo = $categorieRepo;
        $this->produitRepo = $produitRepo;
        $this->fournisseurRepo = $fournisseurRepo;
        $this->sousCategorieRepo = $sousCategorieRepo;
        $this->entityManager = $entityManager;
    }

    #[Route('/gestion', name: 'app_gestion')]
    public function gestion(): Response
    {
        $produits = $this->produitRepo->findAll();
        $souscategories = $this->sousCategorieRepo->findAll();
        $categories = $this->categorieRepo->findAll();
        $utilisateurs = $this->utilisateurRepo->findAll();

        return $this->render('gestion/index.html.twig', [
            'produits' => $produits,
            'categories' => $categories,
            'souscategories' => $souscategories,
            'utilisateurs' => $utilisateurs,
        ]);
    }

    #[Route('/gestion/produit/new', name: 'app_gestion_produit_ajout')]
    public function gestionProduitAjout(Request $request): Response
    {
        // Créer une nouvelle instance de l'entité Produit
        $produit = new Produit();
        
        // Créer le formulaire avec le type AjoutProduitType
        $form = $this->createForm(AjoutProduitType::class, $produit);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gérer l'upload de l'image
            $photoProduit = $form->get('photoProduit')->getData();
            if ($photoProduit) {
                $originalFilename = pathinfo($photoProduit->getClientOriginalName(), PATHINFO_FILENAME);
                // Générer un nom unique pour le fichier
                $newFilename = uniqid().'.'.$photoProduit->guessExtension();

                try {
                    // Déplacer le fichier téléchargé dans le répertoire voulu
                    $photoProduit->move(
                        $this->getParameter('photo_directory'), // Chemin vers le répertoire des images
                        $newFilename
                    );
                    // Sauvegarder le nom du fichier dans l'entité Produit
                    $produit->setPhotoProduit($newFilename);
                } catch (FileException $e) {
                    // Gérer les erreurs d'upload
                    $this->addFlash('error', 'Erreur lors du téléchargement de l\'image.');
                }
            }

            // Sauvegarder le produit dans la base de données
            $this->entityManager->persist($produit);
            $this->entityManager->flush();

            // Afficher un message de succès et rediriger vers la liste des produits
            $this->addFlash('success', 'Produit ajouté avec succès!');
            return $this->redirectToRoute('app_gestion');
        }

        // Afficher le formulaire de création de produit
        return $this->render('gestion/formProduit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}