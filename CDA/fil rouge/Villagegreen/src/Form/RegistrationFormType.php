<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Event\PostSubmitEvent;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'label' => 'Mot de passe',
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'col-3 form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères.',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('nomcli', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('coeffcli', IntegerType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('numtelephone', TextType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('prenomcli', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('catecli', ChoiceType::class, [
                'choices' => [
                    'Particulier' => 'Particulier',
                    'Professionel' => 'Professionel',
                ],
                'expanded' => false, // false => menu déroulant, true => boutons radio
                'required' => true,
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos termes.',
                    ]),
                ],
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, [$this, 'setRole'])
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

    public function setRole(PostSubmitEvent $event): void
    {
        $data = $event->getData();
        if ($data instanceof Utilisateur) {
            $data->setRoles(['ROLE_USER']);
        }
    }
}
