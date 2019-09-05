<?php


namespace App\Panier;

use App\Entity\User;
use App\Entity\Orders;
use App\Entity\OrderLine;
use App\Repository\OrdersRepository;
use App\Repository\ParfumRepository;
use App\Repository\OrderLineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;




class PanierMaker
{
    public function makePanier(OrdersRepository $orderRequest,ParfumRepository $parfum,OrderLineRepository $orderLineRepo)
    {
       
        if(empty($orderListe))
        {
             $order = new Orders;
            $order->setUser($user)
                  ->setOrderDate(new \dateTime())
                  ->setStatus('En cour');
    
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


    public function newPanier(User $user,EntityManagerInterface $entityManager,ParfumRepository $parfum , Int $idParfum, Int $quantity)
    {
        $order = new Orders;
        $order->setUser($user)
              ->setOrderDate(new \dateTime())
              ->setStatus('En cour');


       
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
        
     
    }

    public function isProductInOrders(Int $idParfum,ParfumRepository $parfum,OrdersRepository $orderRequest,OrderLineRepository $orderLineRepo, Int $user_id)
    {
        $result = $parfum->find($idParfum)->getId();
        var_dump($result);

        $parfumObject = $parfum->find($idParfum);

        $showOrder = $orderRequest->findOneBy(['status'=>'En cour', 'user'=>$user_id]);
        $orderId = $showOrder->getId();

       


    $showOrderLine = $orderLineRepo->findBy(['orders'=> $orderId]);
    
    
    $filtered = array_filter($showOrderLine, function ($item) use ($result) {
        
        return $item->getParfum()->getId() == $result; 

    });

    return $filtered;
    }

    public function newOrderLine(Orders $orderListe,Int $quantity,ParfumRepository $parfum,EntityManagerInterface $entityManager)
    {
        $orderLine = new OrderLine;
              
        $parfumObject = $parfum->find($idParfum);
                

        $orderLine->setOrders($orderListe[0])
                  ->setQuantity($quantity)
                  ->setParfum($parfumObject);
                

                  $entityManager->persist($orderLine);
             $entityManager->flush();  
           
    }

    public function addQuantityProduct(EntityManagerInterface $entityManager,OrderLineRepository $orderLineRepo,OrdersRepository $orderRequest,Int $user_id,Int $quantity)
    {
        $showOrder = $orderRequest->findOneBy(['status'=>'En cour', 'user'=>$user_id]);
        $orderId = $showOrder->getId();
        $orderLineQuant = $entityManager->getRepository(OrderLine::class)->find($orderId);

                $quantityProduct = 0;

                $showOrderLine = $orderLineRepo->findBy(['orders'=> $orderId]);
                for($i = 0; $i<count($showOrderLine); $i++){
                    $orderItem = $showOrderLine[$i];
                    
                    $quantityProduct += $orderItem->getQuantity();
                }
                
                

        

                $totalQuantity = $quantity + $quantityProduct;

                


                $orderLineQuant->setQuantity($totalQuantity);
                $entityManager->flush(); 

                
    }
}