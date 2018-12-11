<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TshirtController extends AbstractController
{


    /**
     * Gallerie des Tshirt
     * 
     * @Route("/tshirts", name="tshirts")
     * 
     * @return render
     * 
     */
    public function index()
    {
        return $this->render('tshirt/index.html.twig', [
            'controller_name' => 'Nos tshirt',
        ]);
    }


    /**
     * Affichage detail d'un tshirt
     * 
     * [todo] la route sera modifier en ("/single/{id}" quand la BDD sera creer)
     * @Route("/single", name="single")
     *
     * @return render
     */
    public function singleTshirt()
    {
        return $this->render('tshirt/single_tshirt.html.twig', [
            // a modifier avec le nom du model quand il seront creer sur la BDD
            'controller_name' => 'Exemple de nom de model',
        ]);
    }
}
