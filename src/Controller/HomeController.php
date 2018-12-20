<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Model\EmailType;


use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Newsletter;

use Symfony\Component\HttpFoundation\Request;

use App\Service\TshirtService;
use App\Service\TranslateService;
use App\Service\UserAddressService;
use App\Service\BasketService;


class HomeController extends AbstractController
{
    /**
     * Page d'accueil du site
     * 
     * @Route("/", name="home")
     * 
     * @return render
     */
    public function index(SessionInterface $session, AuthenticationUtils $authenticationUtils, TshirtService $products, BasketService $basketService)
    {  
        $error = $authenticationUtils->getLastAuthenticationError();
        $auth_checker = $this->get('security.authorization_checker');
        if ($auth_checker->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin');
        }

        // Promos
        $promo = 20/100;

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Accueil',
            'product_type' => TshirtService::_PRODUCT,
            'productsRand' => $products->getRandomTshirtGender( 'All', 4 )->getRecords(),
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
            // Promos
            'promo' => $promo,
        ]);
    }

    /**
     * Page a propos de nous & nos designers
     *
     * @Route("/about", name="about")
     * 
     * @return render
     */
    public function about(BasketService $basketService) {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'Designers',
            'aboutNav' => true,
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);
    }

    /**
     * Page 404
     *
     * @Route("/404", name="errorpage")
     * 
     * @return render
     */
    public function errorPage(BasketService $basketService) {
        return $this->render('404/404.html.twig', [
            'controller_name' => '404',
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);
    }

}
