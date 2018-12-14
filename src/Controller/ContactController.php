<?php

namespace App\Controller;

use App\Form\Model;
use App\Form\Model\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{


/////////////////////////////////////////////////////////////////////////////////////////


    /**
     * Page de contact
     * 
     * Permet a utilisateur de contacter l'entreprise
     * 
     * @Route("/contact", name="contact")
     * 
     * @return response
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        // // On passe un objet au FormBuilder
        // $contact = new Contact();
        // // creer moi un formulaire
        // $form = $this->createForm(ContactType::class, $contact);
        // // gérer les envois de formulaire
        // $form->handleRequest($request);
        // dump($contact);

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
        // $this->addFlash(
        //     'success',
        //     "Votre message a bien été envoyé"
        // );
        $contactFormData = $form->getData();
        dump($contactFormData);
        
        $message = (new \Swift_Message('DevMyShirt Contact'))
        ->setFrom('benoitp62@gmail.com')
        ->setTo('110.benp@gmail.com')
        ->setBody($contactFormData,
        'text/plain');
        $mailer->send($message);
    }
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'Contact',
            'form' => $form->createView()
        ]);
    }

}
