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
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $sent = $form->getData();

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
            
            
            

            $message = (new \Swift_Message('Nouveau message sur le formulaire de contact !'))
                ->setFrom($email)
                ->setTo('tshirtwf3money@mailinator.com')
                ->setBody(
                    $this->renderView(
                // templates/emails/registration.html.twig
                        'emails/email.html.twig',
                        array(
                            'lastName' => $lastname,
                            'fristName' => $firstname,
                            'email' => $email,
                            'phone' => $phone,
                            'topic' => $topic,
                            'message' => $message
                            )
                    ),
                    'text/html'
                );

            $mailer->send($message);
        }

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'Contact',
            'form' => $form->createView()
        ]);
    }

}
