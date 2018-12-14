<?php

namespace App\Controller;

use App\Form\Model;
use App\Form\Model\Contact;
use App\Form\ContactType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{


/////////////////////////////////////////////////////////////////////////////////////////


    /**
     * Page de contact
     * 
     * Permet a l'utilisateur de contacter l'entreprise
     * 
     * @Route("/contact", name="contact")
     * 
     * @return response
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        // gére les envois de formulaire
        $form->handleRequest($request);

        // condition isset détermine si une variable est définie
        if ($form->isSubmitted() && $form->isValid()) {

            if (isset($form)) {
                $lastname = $form['lastName']->getData();
            } else {
                $lastname = 'undefined';
            }
            if (isset($form)) {
                $firstname = $form['firstName']->getData();
            } else {
                $firstname = 'undefined';
            }
            if (isset($form)) {
                $email = $form['email']->getData();
            } else {
                $email = 'undefined';
            }
            if (isset($form)) {
                $phone = $form['phone']->getData();
            } else {
                $phone = 'undefined';
            }
            if (isset($form)) {
                $topic = $form['topic']->getData();
            } else {
                $topic = 'undefined';
            }
            if (isset($form)) {
                $message = $form['message']->getData();
            } else {
                $message = 'undefined';
            }
            
            // creation, configuration, envoi de de l'objet Swift_Message
            $message = (new \Swift_Message('Nouveau message sur le formulaire de contact !'))
                ->setFrom($email)
                ->setTo('wf3tshirt@gmail.com')
                ->setBody(
                    $this->renderView(

                        'emails/email.html.twig',
                        array(
                            'lastName' => $lastname,
                            'firstName' => $firstname,
                            'email' => $email,
                            'phone' => $phone,
                            'topic' => $topic,
                            'message' => $message
                            )
                    ),
                    'text/html'
                );

            // message flash
            $this->addFlash(
                'success',
                'Votre message a bien été envoyé'
            );

            // envoi du mail
            $mailer->send($message);

            // redirection sur la page home
            return $this->redirectToRoute('home');
        }

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'Contact',
            'form' => $form->createView(),
            'contactNav' => true,
        ]);
    }

}
