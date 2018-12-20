<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;

use App\Service\BasketService;

class NewsletterController extends AbstractController
{

    /**
     * Newsletter
     * 
     * @Route("/newsletter", name="newsletter")
     * 
     * @return render
     * 
     */
    public function souscribe(Request $request, BasketService $basketService)
    {
        //créer une nouvelle souscription
        $email = new Newsletter();

        // récupérer le formulaire et on l'associe au nouvel email
        $form = $this->createForm(NewsletterType::Class, $email); 

        // on recupère ce qui va être envoyer lors de la soumission
        $form->handleRequest($request);

        // si le formulaire est soumis 
        if ($form->isSubmitted() && $form->isValid()) {

            // object manager
            $om = $this->getDoctrine()->getManager();
            // prepare l'envoie
            $om->persist($email);
            // envoi vers la base de données
            $om->flush();

            // Flash
            $this->addFlash('success', 'Ton email a bien été enregistré.');

            return $this->redirect($request->server->get('HTTP_REFERER'));
        }

        // on génére la vue HTML
        $formView = $form->createView();

        // on retourne la vue 
        return $this->render('user/newsletter.html.twig', [
            'controller_name' => 'Newsletter',
            'form' => $formView,
            // Basket
            'basketCountQuantity' => $basketService->countQuantity(),
        ]);
    }

}