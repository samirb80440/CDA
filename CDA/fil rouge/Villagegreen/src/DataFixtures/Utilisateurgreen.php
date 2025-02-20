<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Utilisateur;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class Utilisateurgreen extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $utilisateursData = [
            ['U1', 'Alice Dupont', true, 1, '0612345678', 'password123'],
            ['U2', 'Jean Martin', false, 2, '0623456789', 'password456'],
            ['U3', 'Claire Leroy', true, 1, '0634567890', 'password789'],
            ['U4', 'Paul Durand', false, 2, '0645678901', 'password012'],
            ['U5', 'Sophie Lambert', true, 1, '0656789012', 'password345']
        ];

        foreach ($utilisateursData as [$id, $nom, $cate, $coeff, $tel, $mdp]) {
            $user = new Utilisateur();
            $user->setNomCli($nom)
                 ->setCateCli($cate)
                 ->setCoeffCli($coeff)
                 ->setNumTelephone($tel)
                 ->setPassword($this->passwordHasher->hashPassword($user, $mdp));
            
            $manager->persist($user);
        }

        $manager->flush();
    }
}
