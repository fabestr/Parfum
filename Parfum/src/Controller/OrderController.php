<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Orders;
use App\Repository\OrdersRepository;
use App\Repository\ParfumRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function addToCart(Request $request,OrdersRepository $orderRequest)
    {
        $idParfum = $request->request->get('idParfum');
        $quantity = $request->request->get('quantity');
        $user = $this->getUser();
        $user_id = $user->getId();
        
       
        if($orderRequest->resumeOrder($user_id)== null)
        {
            
            $order = new Orders;
            $order->setUser($user)
                  ->setOrderDate(new \dateTime());
    
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();



            $order_id = $order->getId();
            
            $payload = [
            "id" => $idParfum,
            "user_id" => $user_id,
            "quantity" => $quantity ,
            "order_id"  => $order_id   
        ];
            return new JsonResponse($payload);
        } 

    
       

        
    }

}