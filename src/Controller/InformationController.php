<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InformationController extends AbstractController
{
    /**
     * Page CGV & Mentions legales
     * 
     * @Route("/cgv", name="cgv")
     * 
     * @return render
     * 
     */
    public function index()
    {
        return $this->render('information/cgv.html.twig', [
            'controller_name' => 'CGV / Mentions legales',
        ]);
    }



    /**
     * Page mode de livraison & Mode de paiement & Garantie Satisfaction
     *
     * @Route("/info-paiement-livraison", name="infopl")
     * 
     * @return render
     */
    public function informationPayment()
    {
        return $this->render('information/info_payment.html.twig', [
            'controller_name' => 'Info paiement / livraison',
        ]);
    }


    /**
     * Page Protection des données RGPD
     * 
     * @Route("/rgpd", name="rgpd")
     *
     * @return render
     */
    public function rgpd()
    {
        return $this->render('information/rgpd.html.twig', [
            'controller_name' => 'Protection des données / RGPD',
        ]);
    }

    /**
     * Page Faq
     * 
     * @Route("/faq", name="faq")
     *
     * @return render
     */
    public function faq(){
        return $this->render('information/faq.html.twig', [
            'controller_name' => 'FAQ',
        ]);
    }
}
