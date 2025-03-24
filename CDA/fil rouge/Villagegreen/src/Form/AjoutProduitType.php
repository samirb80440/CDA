<?php
namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Fournisseur;
use App\Entity\Produit;
use App\Entity\SousCategorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Length;

class AjoutProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nomProd', TextType::class, [
            'label' => 'Nom du produit',
            'constraints' => [
                new NotBlank(['message' => 'Le nom est requis.']),
                new Length([
                    'max' => 255,
                    'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.'
                ])
            ],
            'attr' => ['class' => 'form-control'],
        ])
            ->add('prixAchat', MoneyType::class, [
                'currency' => 'EUR',
                'label' => 'Prix d\'achat',
                'constraints' => [
                    new NotBlank(['message' => 'Le prix d\'achat est requis.']),
                    new Positive(['message' => 'Le prix doit être positif.'])
                ],
                'attr' => ['class' => 'col-3 form-control'],
            ])
            ->add('stockprod', IntegerType::class, [
                'label' => 'Stock disponible',
                'constraints' => [
                    new NotBlank(['message' => 'Le stock est requis.']),
                    new Positive(['message' => 'Le stock doit être un nombre positif.'])
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('photoProduit', FileType::class, [
                'label' => 'Photo du produit',
                'mapped' => True,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPEG, PNG, WebP, JPG).',
                    ])
                ],
                'attr' => ['class' => 'form-control-file'],
            ])
            ->add('LibCourtProd', TextType::class, [
                'label' => 'Description courte',
                'constraints' => [
                    new NotBlank(['message' => 'Ce champ est requis.']),
                    new Length(['max' => 100])
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('libLongProd', TextareaType::class, [
                'label' => 'Description longue',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 4
                ],
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nomCategorie',
                'label' => 'Catégorie',
                'placeholder' => 'Sélectionnez une catégorie',
                'attr' => ['class' => 'form-select'],
            ])
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'choice_label' => 'nomFournisseur',
                'label' => 'Fournisseur',
                'placeholder' => 'Sélectionnez un fournisseur',
                'attr' => ['class' => 'form-select'],
            ])
            ->add('souscategorie', EntityType::class, [
                'class' => SousCategorie::class,
                'choice_label' => 'nomSousCategorie',
                'label' => 'Sous-catégorie',
                'placeholder' => 'Sélectionnez une sous-catégorie',
                'attr' => ['class' => 'form-select'],
            ])
            ->add('Save', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => ['class' => 'rounded-pill'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
