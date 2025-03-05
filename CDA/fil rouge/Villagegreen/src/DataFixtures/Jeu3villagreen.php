<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\Fournisseur;
use App\Entity\SousCategorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Jeu3villagreen extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        // 🔹 Liste des catégories
        $categoriesData = [
            'Guitares' => 'Guitare.webp',
            'Violon' => 'Violon.webp',
            'Piano' => 'Piano.webp',
            'Intrument_a_vent' => 'Intrument_a_vent.webp',
            'Batterie' => 'Batterie.webp'
        ];
    
        // 🔹 Stocker les catégories pour les retrouver facilement
        $categories = [];
        foreach ($categoriesData as $nom => $image) {
            $categorie = new Categorie();
            $categorie->setNomCategorie($nom);
            $categorie->setImageCategorie($image);
            $manager->persist($categorie);
            $categories[$nom] = $categorie; // Associer le nom à l'objet
        }
        $manager->flush();
    
        // 🔹 Liste des sous-catégories avec association aux catégories
        $sousCategoriesData = [
            ['Intrument_folklore.webp', 'Intrument_folklore', 'Violon'],
            ['guitare_electrique.webp', 'Guitare_electrique', 'Guitares'],
            ['guitare_acoustique.webp', 'Guitare_acoustique', 'Guitares'],
            ['Cordes_frotées.webp', 'Cordes_frotées', 'Violon'],
            ['batterie_electroniques.webp', 'Batterie_electroniques', 'Batterie'],
            ['Batterie_acoustiques.webp', 'Batterie_acoustiques', 'Batterie']
        ];
    
        foreach ($sousCategoriesData as [$image, $nom, $nomCategorie]) {
            $sousCategorie = new SousCategorie();
            $sousCategorie->setImageSousCategorie($image);
            $sousCategorie->setNomSousCategorie($nom);
    
            // Vérifier si la catégorie associée existe
            if (isset($categories[$nomCategorie])) {
                $sousCategorie->setCategorie($categories[$nomCategorie]);
            } else {
                echo "⚠ Catégorie non trouvée pour la sous-catégorie $nom\n";
            }
    
            $manager->persist($sousCategorie);
        }
        $manager->flush();
    
        // 🔹 Liste des produits avec association aux catégories et fournisseurs
        $produitsData = [
            [15.50, 'Guitare Electrique', 50, 'Gibson_SG_Standard_64_Maestro_CH_ULA.jpg', 'Guitare Electrique', 'Une guitare électrique', 'Guitares', 1],
            [25.00, 'Piano a queue', 200, 'Kawai_GL_10_Grand_Piano.jpg', 'Produit B', 'Description détaillée du produit', 'Piano', 2],
            [12.75, 'Batterie electronique', 150, "Millenium_MPS-850_E-Drum_Set.jpg", 'Produit C', 'Description détaillée du produit C', 'Batterie', 3],
            [18.00, 'Violoncelle', 20, 'Scala_Vilagio_L.V._Montagnana_Cello.jpg', 'Violoncelle', 'Violoncelle professionnel avec un son riche.', 'Violon', 4]
        ];
    
        foreach ($produitsData as [$prix, $nom, $stock, $image, $libelleCourt, $libelleLong, $nomCategorie, $idFournisseur]) {
            $produit = new Produit();
            $produit->setPrixAchat($prix);
            $produit->setNomProd($nom);
            $produit->setStockprod($stock);
            $produit->setPhotoProduit($image);
            $produit->setLibCourtProd($libelleCourt);
            $produit->setLibLongProd($libelleLong);
         
            $fournisseur =$manager->getRepository(Fournisseur::class)->find($idFournisseur);
            $produit->setFournisseur($fournisseur);

        


            // Vérifier si la catégorie associée existe
            if (isset($categories[$nomCategorie])) {
                $produit->setCategorie($categories[$nomCategorie]);
            } else {
                echo "⚠ Catégorie non trouvée pour le produit $nom\n";
            }
    
            // Récupérer le fournisseur
            $fournisseur = $manager->getRepository(Fournisseur::class)->find($idFournisseur);
            if ($fournisseur) {
                $produit->setFournisseur($fournisseur);
            } else {
                echo "⚠ Fournisseur non trouvé pour le produit $nom\n";
            }
    
            $manager->persist($produit);
        }
        $manager->flush();
    }
}
