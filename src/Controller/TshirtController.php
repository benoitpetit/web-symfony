<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Service\TshirtService;

class TshirtController extends AbstractController
{


    /**
     * Gallerie homme
     * 
     * @Route("/gallerie/homme", name="mengallery")
     * 
     * @return render
     * 
     */
    public function menGallery()
    {
        return $this->render('tshirt/men_gallery.html.twig', [
            'controller_name' => 'homme',
        ]);
    }

    /**
     * Gallerie femme
     * 
     * @Route("/gallerie/femme", name="womengallery")
     * 
     * @return render
     * 
     */
    public function womenGallery()
    {
        return $this->render('tshirt/women_gallery.html.twig', [
            'controller_name' => 'femme',
        ]);
    }

    /**
     * Affichage detail d'un tshirt homme
     * 
     * [todo] la route sera modifier en ("gallery/homme/detail/{id}" quand la BDD sera creer)
     * @Route("gallerie/homme/detail", name="mensingle")
     *
     * @return render
     */
    public function menSingle()
    {
        return $this->render('tshirt/men_single_tshirt.html.twig', [
            // a modifier avec le nom du model quand il seront creer sur la BDD
            'controller_name' => 'Tshirt',
        ]);
    }

    
    /**
     * @Route("gallerie/homme/visuel", name="menvisuel")
     */
    public function menVisuel( TshirtService $tshirtService, $color='#5ea822' )
    {
        return new Response( $tshirtService->menTshirt($color), 200, array( 'Content-Type' => 'image/jpeg' ) );
    }

    /**
     * @Route("gallerie/femme/visuel", name="womenvisuel")
     */
    public function womenVisuel( TshirtService $tshirtService, $color='#e52424' )
    {
        return new Response( $tshirtService->womenTshirt($color), 200, array( 'Content-Type' => 'image/jpeg' ) );
    }


    /**
     * Affichage detail d'un tshirt femme
     * 
     * [todo] la route sera modifier en ("gallery/femme/detail/{id}" quand la BDD sera creer)
     * @Route("gallerie/femme/detail", name="womensingle")
     *
     * @return render
     */
    public function womenSingle()
    {
        return $this->render('tshirt/women_single_tshirt.html.twig', [
            // a modifier avec le nom du model quand il seront creer sur la BDD
            'controller_name' => 'Tshirt',
        ]);
    }

    /**
     * Promo
     * 
     * @Route("/gallerie/promo", name="promos")
     * 
     * @return render
     * 
     */
    public function promos()
    {
        return $this->render('tshirt/promos.html.twig', [
            'controller_name' => 'Promos',
            'evenement' => 'Noël',
        ]);
    }
}
