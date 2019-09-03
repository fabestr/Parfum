<?php

namespace App\Controller;

use App\Entity\Parfum;
use App\Repository\ParfumRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ParfumController extends AbstractController
{
    /**
     * Undocumented function
     *@Route("/parfum/{id}", name="show_parfum")
     * @return void
     */
    public function show(Parfum $parfum)
    {

        return $this->render('parfum/showParfum.html.twig', [
                'parfum' => $parfum
            ]);
    }

}