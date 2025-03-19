<?php

namespace App\Service;

// Import des entités et services nécessaires
use App\Entity\Commande;
use App\Entity\Utilisateur;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MailService
{
     // Propriétés pour le mailer et Twig
    private $mailer;

    private $twig;

    // On injecte dans le constructeur le MailerInterface et l'environnement Twig
    public function __construct(MailerInterface $mailer, Environment $twig){
        // Initialisation du service d'envoi d'e-mails
        $this->mailer = $mailer;

        // Initialisation du moteur de templates Twig
        $this->twig = $twig;
    }

    public function sendMailContact(string $emailpros ,string $emailclient, string $Nom,string $template,array $parameters){
        
        // Création d'un nouvel objet Email de Symfony
        $email = (new Email())
        ->from($emailpros)// Définition de l'expéditeur

        ->to($emailclient)// Définition du destinataire
        ->subject($Nom)// Sujet de l'e-mail
        ->html(
            $this->twig->render($template, $parameters)
        );

        // Envoi de l'e-mail via le service mailer
        $this->mailer->send($email);
    }
}