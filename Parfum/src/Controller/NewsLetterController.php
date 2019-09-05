<?php

namespace App\Controller;

use App\Entity\NewsLetter;
use App\Form\NewsLetterType;
use App\Repository\NewsLetterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/news/letter")
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

    

   

    

    
}
