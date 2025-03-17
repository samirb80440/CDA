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
            ['Alice','Dupont','alice.dupont@gmail.com', 'Particulier', 50, '0612345678', 'password123','Paris','Paris','ROLE_ADMIN',1],
            ['Jean','Martin','jean.martin@yagoo.com','Professionel', 70, '0623456789', 'password456','Paris','Paris','ROLE_USER',2],
            ['Claire','Leroy','claire.leroy@fake.com','Particulier', 50, '0634567890', 'password789','Paris','Paris','ROLE_USER',3],
            ['Paul','Durand','paul.durand@random.com','Professionel', 70, '0645678901', 'password012','Paris','Paris','ROLE_USER',4],
            ['Sophie','Lambert','sophie.lambert@outlook.com','Particulier', 50, '0656789012', 'password345','Paris','Paris','ROLE_USER',5]
        ];

        foreach ($utilisateursData as [$nom, $prenom, $email, $cate, $coeff, $tel, $mdp,$adress_factu,$adress_livrai, $role]) {
            $user = new Utilisateur();
            $user->setNomCli($nom)
                 ->setPrenomcli($prenom)
                 ->setemail($email)
                 ->setCateCli($cate)
                 ->setCoeffCli($coeff)
                 ->setRoles([$role])
                 ->setNumTelephone($tel)
                 ->setPassword($this->passwordHasher->hashPassword($user, $mdp))
                 ->setAdresseLivrai($adress_livrai)
                 ->setAdresseFactu($adress_factu);

            
            $manager->persist($user);
        }

        $manager->flush();
    }
}
