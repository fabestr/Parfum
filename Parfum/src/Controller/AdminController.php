<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Parfum;
use App\Entity\NewsLetter;
use App\Form\NewsLetterType;
use App\Form\NewsLetterFormType;
use App\Repository\UserRepository;
use App\Repository\ParfumRepository;
use App\Repository\NewsLetterRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{

    /**
     * @Route("/", name="admin_index")
     */
    public function index():Response
    {

        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/parfum_homme" ,name="admin_parfum_man")
     *
     */
    public function showAdminParfumMan(ParfumRepository $parfum)
    {
        $list = $parfum->allMenParfum();

        return $this->render('admin/parfum_man.html.twig', [
            'listOfParfum' => $list
        ]);
    }

    /**
     * @Route("/parfum_femme",name="admin_parfum_woman")
     *
     * @return void
     */
    public function showAdminParfumWoman(ParfumRepository $parfum)
    {
        $list = $parfum->allWomanParfum();

        return $this->render('admin/parfum_woman.html.twig', [
            'listOfParfum' => $list
        ]);
    }

    /**
     * @Route("/newsletter", name="admin_newsletter_index")
     *
     * @param NewsLetterRepository $newsletter
     * @return void
     */
    public function showAdminNewletter(NewsLetterRepository $newsletter)
    {
        $allNewsletter = $newsletter->findAll();

        return $this->render('admin/newsletter.html.twig', [
            'allNewsletter' => $allNewsletter
        ]);
    }

    
    /* public function addNewsLetter(Request $request) : Response
    {
        $newsletter = new NewsLetter();
        $form = $this->createForm(NewsLetterFormType::class, $newsletter);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            var_dump('coucou');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsletter);
            $entityManager->flush();

            return $this->redirectToRoute('admin_newsletter');
        }

        return $this->render('admin/newsletter_add.html.twig', [
            'newsletter' => $newsletter,
            'newsLetterFormType' => $form->createView(),
        ]);
    } */

    /**
     * @Route("/newsletter/add", name="admin_newsletter_add", methods={"GET","POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $newsLetter = new NewsLetter();
        $form = $this->createForm(NewsLetterType::class, $newsLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsLetter);
            $entityManager->flush();

            return $this->redirectToRoute('admin_newsletter');
        }

        return $this->render('admin/newsletter_add.html.twig', [
            'news_letter' => $newsLetter,
            'form' => $form->createView(),
        ]);
    }
    
}