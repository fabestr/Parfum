<?php

namespace App\Controller;

use App\Repository\ParfumRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class OrderController extends AbstractController
{
    /**
     * Undocumented function
     *@Route("/order",name="order")
     * @return void
     */
    public function index()
    {
        
        return $this->render('order/index.html.twig', [

        ]);
    }
}