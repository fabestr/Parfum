<?php

namespace App\Controller;

use App\Repository\ParfumRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
    /**
     * Undocumented function
     *@Route("/", name="home")
     * @return void
     */
    public function index(ParfumRepository $parfum)
    {
       
       return $this->render('home/index.html.twig',[
            
        ]);
    }

    /**
     * Undocumented function
     *@Route("/man", name="index_man")
     * @return void
     */
    public function index_man(ParfumRepository $parfum)
    {
        $menSelection = $parfum->allMenParfum();
        //var_dump(count($menSelection));
        //die;
       return $this->render('home/index_homme.html.twig',[
            'mens' => $menSelection
        ]);
    }

    /**
     * Undocumented function
     *@Route("/woman", name="index_woman")
     * @return void
     */
    public function index_woman(ParfumRepository $parfum)
    {
        $womenSelection = $parfum->allWomanParfum();
        //var_dump(count($menSelection));
        //die;
       return $this->render('home/index_woman.html.twig',[
            'women' => $womenSelection
        ]);
    }


}