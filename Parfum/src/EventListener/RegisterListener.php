<?php

namespace App\EventListener;

use App\Event\RegisterEvent;


class RegisterListener
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMailToUser(RegisterEvent $e )
    {
        var_dump('coucou');
        //var_dump($e->getUser());die;
        // Create the message
        $message = (new \Swift_Message())
        // Add subject
        ->setSubject('Bienvenue '.strtoupper($e->getUser()->getFirstName()))
        
        //Put the From address 
        ->setFrom(['support@mailtrap.io'=>'Manu de parfum pas cher'])

        // Include several To addresses
        ->setTo(['f.estrabaud@gmail.com' => 'Test'])
        ->setCc([
        'support@mailtrap.io',
        'product@mailtrap.io' => 'Product manager'
        ])
        ->setBody('<h1>Bienvenue sur sens bon pour pas grand chose</h1>
                    <p>Manu de parfum pas cher te souhaite la bienvenue <strong>'.strtoupper($e->getUser()->getFirstName()).'</strong></p>', 'text/html');

        $this->mailer->send($message);
    }
}