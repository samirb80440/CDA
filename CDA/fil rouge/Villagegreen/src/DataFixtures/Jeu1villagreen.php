<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Utilisateur;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class Jeu1villagreen extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $utilisateursData = [
            ['Alice','Dupont','alice.dupont@gmail.com', true, 50, '0612345678', 'password123','ROLE_ADMIN',1],
            ['Jean','Martin','jean.martin@yagoo.com',false, 70, '0623456789', 'password456','ROLE_USER',2],
            ['Claire','Leroy','claire.leroy@fake.com',true, 50, '0634567890', 'password789','ROLE_USER',3],
            ['Paul','Durand','paul.durand@random.com',false, 70, '0645678901', 'password012','ROLE_USER',4],
            ['Sophie','Lambert','sophie.lambert@outlook.com',true, 50, '0656789012', 'password345','ROLE_USER',5]
        ];

        foreach ($utilisateursData as [$nom, $prenom, $email, $cate, $coeff, $tel, $mdp, $role]) {
            $user = new Utilisateur();
            $user->setNomCli($nom)
                 ->setPrenomcli($prenom)
                 ->setemail($email)
                 ->setCateCli($cate)
                 ->setCoeffCli($coeff)
                 ->setRoles([$role])
                 ->setNumTelephone($tel)
                 ->setPassword($this->passwordHasher->hashPassword($user, $mdp));
            
            $manager->persist($user);
        }

        $manager->flush();
    }
}
