<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Orders;
use App\Entity\OrderLine;
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
    public function addToCart(Request $request,OrdersRepository $orderRequest,ParfumRepository $parfum,OrderLineRepository $orderLineRepo)
    {
        $idParfum = $request->request->get('idParfum');
        $quantity = $request->request->get('quantity');
        $name = $request->request->get('name');

        $user = $this->getUser();
        $user_id = $user->getId();

       
        
       $orderListe = $orderRequest->resumeOrder($user_id);       

        if(empty($orderListe))
        {
             $order = new Orders;
            $order->setUser($user)
                  ->setOrderDate(new \dateTime());
    
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
         
            $entityManager->flush(); 

            $order_id = $order->getId();
          
             $result = $parfum->findParfum($idParfum);

            $orderLine = new OrderLine;
            $orderLine->setOrders($order)
                      ->setQuantity($quantity)
                      ->setParfum($result[0]);

                      $entityManager->persist($orderLine);
            $entityManager->flush();  
            
          return $this->render('home/index.html.twig',[

            ]);
        }else{
            //$filtered_list = array_map(function($item){
                //return [
                    //'idUser' => $item->getUser()->getId(),
                    //'orders'=> $item->getId()
                //];
           // },$orderListe);
                // var_dump($orderListe[0]->getUser()); die;

                $entityManager = $this->getDoctrine()->getManager();
              
                $result = $parfum->find($idParfum)->getId();
                var_dump($result);

                $parfumObject = $parfum->find($idParfum);

                $showOrder = $orderRequest->findOneBy(['status'=>'En cour', 'user'=>$user_id]);
        $orderId = $showOrder->getId();

               


            $showOrderLine = $orderLineRepo->findBy(['orders'=> $orderId]);
            
            
            $filtered = array_filter($showOrderLine, function ($item) use ($result) {
                
                return $item->getParfum()->getId() == $result; 

            });

            if(empty($filtered))
            {
                 $orderLine = new OrderLine;
              

                

            $orderLine->setOrders($orderListe[0])
                      ->setQuantity($quantity)
                      ->setParfum($parfumObject);

                      $entityManager->persist($orderLine);
                 $entityManager->flush();  
                return new JsonResponse();
            }else
            {
                $orderLineQuant = $entityManager->getRepository(OrderLine::class)->find($orderId);

                $quantityProduct = 0;

                for($i = 0; $i<count($showOrderLine); $i++){
                    $test = $showOrderLine[$i];
                    
                    $quantityProduct += $test->getQuantity();
                }
                
                

        

                $totalQuantity = $quantity + $quantityProduct;

                var_dump($totalQuantity);


                $orderLineQuant->setQuantity($totalQuantity);
                $entityManager->flush(); 

                return  new JsonResponse();

            }
               
          
            
        }



        
            
           
        

    
       
        
        
    }

}