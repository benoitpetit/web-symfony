<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TshirtController extends AbstractController
{
    /**
     * @Route("/tshirt", name="tshirt")
     */
    public function index()
    {
        return $this->render('tshirt/index.html.twig', [
            'controller_name' => 'TshirtController',
        ]);
    }
}
