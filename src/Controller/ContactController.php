<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * Page de contact
     * 
     * @Route("/contact", name="contact")
     * 
     * @return render 
     */
    public function index()
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'Contactez nous',
        ]);
    }
}
