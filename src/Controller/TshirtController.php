<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
            'controller_name' => 'Gallerie homme',
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
            'controller_name' => 'Gallerie femme',
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
            'controller_name' => 'Tshirt homme',
        ]);
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
            'controller_name' => 'Tshirt femme',
        ]);
    }
}
