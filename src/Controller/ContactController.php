<?php

namespace App\Controller;

use App\Entity\Contact;
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
    public function contact(Request $request, ObjectManager $manager)
    {

        // On passe un objet au FormBuilder
        $contact = new Contact();
        // Passe l'identité dans les paramètres du formbuilder
        $form = $this->createForm(ContactType::class, $contact);
        // (handleRequest) parcours la requête et les envoi dans l'entité $contact
        $form->handleRequest($request);

        // condition + envoi dans la base de données 
        if($form->isSubmitted() && $form->isValid()){
        // persiste les données
            $manager->persist($new);
        // envoi les données
            $manager->flush();
        // affiche un message de success si l'envoi est valide
        $this->addFlash(
            'success',
            "Votre message a bien été envoyé"
        );
    }
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'Contact',
            'form' => $form->createView(),
            'contactNav' => true,
        ]);
    }

}
