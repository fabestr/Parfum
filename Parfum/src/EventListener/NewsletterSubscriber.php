<?php

namespace App\EventListener;


use App\Event\NewsletterEvent;
use App\Repository\UserRepository;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NewsletterSubscriber implements EventSubscriberInterface
{

    private $users;
    private $mailer;

    public function __construct(UserRepository $users,\Swift_Mailer $mailer)
    {
        $this->users = $users;
        $this->mailer = $mailer;
    }

    public function sendNewsletterToSubscriber(NewsletterEvent $e)
    {

        $mailsUser = $this->users->findByNewsletter(true);
        

        for($i=0; $i<count($mailsUser) ; $i++)
            {
                $message = (new \Swift_Message())
                            // Add subject
                    ->setSubject($e->getNews()->getTitle())
                    
                    //Put the From address 
                    ->setFrom(['support@mailtrap.io'=>'Manu de parfum pas cher'])

                    // Include several To addresses
                    ->setTo([
                        $mailsUser[$i]->getEmail() => $mailsUser[$i]->getFirstName()
                    ])
                    ->setCc([
                    'support@mailtrap.io',
                    'product@mailtrap.io' => 'Product manager'
                    ])
                    ->setBody($e->getNews()->getBody());

        $this->mailer->send($message);
            }
       
    }

    public function dumpResponse(KernelEvent $event)
    {
        //var_dump($event->getResponse()->getContent());
    }

    public static function getSubscribedEvents()
    {
        return [
            NewsletterEvent::SENDER => ['sendNewsletterToSubscriber', -10],
        ];
    }
}