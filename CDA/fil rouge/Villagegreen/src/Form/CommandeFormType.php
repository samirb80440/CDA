<?php
namespace App\Form;

use App\Entity\Bondelivraison;
use App\Entity\Commande;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numCom', TextType::class, [
                'label' => 'Numéro de commande',
                'attr' => ['placeholder' => 'Entrez le numéro de commande']
            ])
            ->add('nomCom', TextType::class, [
                'label' => 'Nom de la commande',
                'attr' => ['placeholder' => 'Nom de la commande']
            ])
            ->add('dateCom', DateType::class, [
                'label' => 'Date de commande',
                'widget' => 'single_text',
            ])
         
            ->add('prixVenteCom', MoneyType::class, [
                'label' => 'Prix de vente',
                'currency' => 'EUR',
                'disabled' => true, // 🔒 champ non modifiable
            ])
            ->add('conditionReg', ChoiceType::class, [
                'label' => 'Condition de règlement',
                'choices' => [
                    'Comptant' => 'comptant',
                    'À crédit' => 'credit',
                    'Autre' => 'autre',
                ],
                'placeholder' => 'Sélectionnez une condition',
            ])
            ->add('dateFact', DateType::class, [
                'label' => 'Date de facturation',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('numFact', TextType::class, [
                'label' => 'Numéro de facture',
                'required' => false,
            ])
            
            ->add('comExp', CheckboxType::class, [
                'label' => 'Commande expédiée',
                'required' => false,
            ])
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'nomcli', // Affiche le nom de l'utilisateur au lieu de l'ID
                'label' => 'Utilisateur',
                'placeholder' => 'Sélectionnez un utilisateur',
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
