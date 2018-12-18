<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;

class NewsletterController extends AbstractController
{

    /**
     * Newsletter
     * 
     * @Route("/user/newsletter", name="newsletter")
     * 
     * @return render
     * 
     */
    public function souscribe( request $request)
    {
        //créer une nouvelle souscription
        $email = new Newsletter();

        // r&cup&rer le formulaire et on l'associe au nouvel email
        $form = $this->createForm(NewsletterType::Class, $email); 

        // on recupère ce qui va être envoyer lors de la soumission
        $form->handleRequest($request);

        // si le formulaire est soumis 
        if ($form->isSubmitted() && $form->isValid()) {

            // object manager
            $om = $this->getDoctrine()->getManager();
            // prepare l'envoie
            $om->persist($email);
            // envoi vers la bas de donner
            $om->flush();

            return $this->redirectToRoute('newsletter');
            // return new Response ('Votre email est enregistré.');
        }

        // on génére la vue HTML
        $formView = $form->createView();

        // retourner la vue 
        return $this->render('user/newsletter.html.twig', [
            'controller_name' => 'Newsletter',
            'form' => $formView,
        ]);
    }

}