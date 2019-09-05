<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\NewsLetter;
use App\Form\NewsLetterType;
use App\Repository\NewsLetterRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/newsletter")
 */
class NewsLetterController extends AbstractController
{
    /**
     * @Route("/", name="newsletter_index", methods={"GET"})
     */
    public function index(NewsLetterRepository $newsLetterRepository): Response
    {
        return $this->render('news_letter/index.html.twig', [
            'news_letters' => $newsLetterRepository->findAll(),
        ]);
    }

     /**
     * @Route("/subscribe", name="newsletter_subscribe", methods={"GET","POST"})
     */
    public function subscribe()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        //var_dump($user->getEmail());die;
        if($user instanceof User)
        {
            
            $user->setNewsletter(true);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'vous êtes maintenant abonné à notre newsletter!'
            );
            return $this->redirectToRoute('home');
           
        }else 

       return $this->redirectToRoute('app_login');
        
         
    }

    /**
     * @Route("/{id}", name="newsletter_show", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show(NewsLetter $newsLetter): Response
    {
        return $this->render('news_letter/show.html.twig', [
            'news_letter' => $newsLetter,
        ]);
    }


   
   

    

    
}
