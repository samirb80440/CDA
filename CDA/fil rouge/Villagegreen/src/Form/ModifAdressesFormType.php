<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifAdressesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adresselivrai', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('adressefactu', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('Save', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn color-B09595 rounded-pill'
                ],
                'row_attr' => [
                    'class' => 'd-flex justify-content-end'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
