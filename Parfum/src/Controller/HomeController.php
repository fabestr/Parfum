<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    /**
     * Undocumented function
     *@Route("/", name="home")
     * @return void
     */
    public function index()
    {
        $this->render('home/index.html.twig',[

        ]);
    }

}