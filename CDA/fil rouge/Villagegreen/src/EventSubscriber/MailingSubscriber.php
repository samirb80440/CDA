<?php 

namespace App\EventSubscriber;

use App\Event\CommandeEvent;
use App\Event\ContactEvent;
use App\Service\MailService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
  
class MailingSubscriber implements EventSubscriberInterface
{
    private $mailservice;  

    
     
     
    public function __construct(MailService $mailservice)
    {
        // Initialisation du service de messagerie
        $this->mailservice = $mailservice;
    }

    public function SendMailEventContact(ContactEvent $event)
    {
        dump('Événement contact reçu !'); // Ajout du dump
        // Récupère le contact associé à l'événement
        $contact = $event->getContact();

        // Prépare les paramètres à injecter dans le modèle d'e-mail
        $parameters = [
            "contact" => $contact,
            "Demande" => $contact->getMessage(),
        ];

        // Envoi de l'e-mail pour le contact
        $this->mailservice->sendMailContact(
            'yop@michel.fr',  // Adresse de l'expéditeur
            $contact->getUtilisateur()->getEmail(),  // Destinataire (adresse e-mail du contact)
            $contact->getUtilisateur()->getNomcli(),  // Sujet de l'e-mail (nom du contact)
            ContactEvent::TEMPLATE_Contact,  // Modèle d'e-mail à utiliser
            $parameters  // Paramètres du modèle d'e-mail
        );
    }

    public static function getSubscribedEvents(): array
    {
        return [
            // Associe l'événement CommandeEvent à la méthode SendMailEventCommande
            // CommandeEvent::class => [
            //     ['SendMailEventCommande', 1]  // Priorité 1
            // ],
            // Associe l'événement ContactEvent à la méthode SendMailEventContact
            ContactEvent::class => [
                ['SendMailEventContact', 2]  // Priorité 2
            ]
        ];
    }
}