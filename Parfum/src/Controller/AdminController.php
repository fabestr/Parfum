<?php

namespace App\Controller;

use App\Repository\ParfumRepository;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\Parfum;
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

        return $this->render('admin/admin_index.html.twig');
    }

    /**
     * @Route("/parfum_homme" ,name="admin_parfum_man")
     *
     */
    public function showAdminParfumMan(ParfumRepository $parfum)
    {
        $list = $parfum->allMenParfum();

        return $this->render('admin/admin_parfum_man.html.twig', [
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

        return $this->render('admin/admin_parfum_woman.html.twig', [
            'listOfParfum' => $list
        ]);
    }
}