<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Orders;
use App\Entity\OrderLine;
use App\Panier\PanierMaker;
use App\Repository\OrdersRepository;
use App\Repository\ParfumRepository;
use App\Repository\OrderLineRepository;
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
    public function index(Request $request,OrdersRepository $orderRepo,OrderLineRepository $orderLineRepo)
    {
        $user = $this->getUser();
        $user_id = $user->getId();

        $showOrder = $orderRepo->findOneBy(['status'=>'En cour', 'user'=>$user_id]);
        $orderId = $showOrder->getId();

        $showOrderLine = $orderLineRepo->findBy(['orders'=> $orderId]);


        
       
        return $this->render('order/index.html.twig', [
                'products' =>  $showOrderLine
        ]);
    }

    /**
     * Undocumented function
     *@Route("/add-to-cart",name="addToCart")
     * @return void
     */
    public function addToCart(Request $request,OrdersRepository $orderRequest,ParfumRepository $parfum,OrderLineRepository $orderLineRepo,PanierMaker $panierMaker)
    {
        $idParfum = $request->request->get('idParfum');
        $quantity = $request->request->get('quantity');
        $name = $request->request->get('name');

        $user = $this->getUser();
        $user_id = $user->getId();

        $entityManager = $this->getDoctrine()->getManager();
        
       $orderListe = $orderRequest->resumeOrder($user_id);       

        if(empty($orderListe))
        {
            $panierMaker->newPanier( $user, $entityManager, $parfum ,  $idParfum,  $quantity);

        }else{
            
           $filtered = $panierMaker->isProductInOrders( $idParfum, $parfum,$orderRequest, $orderLineRepo);
            

            if(empty($filtered))
            {
                $panierMaker->newOrderLine();
                return new JsonResponse();
            }else
            {
                $panierMaker->addQuantityProduct($entityManager, $orderLineRepo);
            }
               
          
            
        }



        
            
           
        

    
       
        
        
    }

}