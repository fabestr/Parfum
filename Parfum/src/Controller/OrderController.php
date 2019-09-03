<?php

namespace App\Controller;

use App\Repository\ParfumRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class OrderController extends AbstractController
{
    /**
     * Undocumented function
     *@Route("/order",name="order")
     * @return void
     */
    public function index(Request $request)
    {
        $idParfum = $request->request->get('idParfum');
       
        return $this->render('order/index.html.twig', [

        ]);
    }

        /**
     * Undocumented function
     *@Route("/add-to-cart",name="addToCart")
     * @return void
     */
    public function addToCart(Request $request)
    {
        $idParfum = $request->request->get('idParfum');
  
        $payload = ["id" => $idParfum];

        return new JsonResponse($payload);
    }

}