<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Parfum;
use App\Entity\NewsLetter;
use App\Form\NewsLetterType;
use App\Event\NewsletterEvent;
use App\Form\NewsLetterFormType;
use App\Repository\UserRepository;
use App\Repository\ParfumRepository;
use App\Repository\NewsLetterRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
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
    public function showAdminNewsletter(NewsLetterRepository $newsletter)
    {
        $allNewsletter = $newsletter->findAll();

        return $this->render('admin/newsletter.html.twig', [
            'allNewsletter' => $allNewsletter
        ]);
    }

     /**
     * @Route("/newsletter/{id}", name="admin_newsletter_show", methods={"GET"} , requirements={"id"="\d+"})
     */
    public function show(NewsLetter $newsLetter): Response
    {
        return $this->render('admin/show_newsletter.html.twig', [
            'news_letter' => $newsLetter,
        ]);
    }

    /**
     * @Route("/newsletter//{id}/edit", name="admin_newsletter_edit", methods={"GET","POST"})
     * 
     */
    public function edit(Request $request, NewsLetter $newsLetter): Response
    {
        $form = $this->createForm(NewsLetterType::class, $newsLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_newsletter_index');
        }

        return $this->render('admin/edit_newsletter.html.twig', [
            'news_letter' => $newsLetter,
            'form' => $form->createView(),
        ]);
    }

    
    /**
     * @Route("/newsletter/add", name="admin_newsletter_add", methods={"GET","POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request, EventDispatcherInterface $dispatcher): Response
    {
        $newsLetter = new NewsLetter();
        $form = $this->createForm(NewsLetterType::class, $newsLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsLetter);
            $entityManager->flush();

            //event pour envoi de la newsletter
            $e = new NewsletterEvent($newsLetter);
            $dispatcher->dispatch($e, NewsletterEvent::SENDER);

            return $this->redirectToRoute('admin_newsletter_index');
        }

        return $this->render('admin/newsletter_add.html.twig', [
            'news_letter' => $newsLetter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("newsletter/{id}", name="admin_newsletter_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NewsLetter $newsLetter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsLetter->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newsLetter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_newsletter_index');
    }
    
}