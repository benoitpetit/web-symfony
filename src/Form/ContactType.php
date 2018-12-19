<?php

namespace App\Form;

use App\Form\Model\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class, [
                'label' => '* Nom:'
            ])
            ->add('firstName', TextType::class, [
                'label' => '* Prénom:'
            ])
            ->add('email', EmailType::class, [
                'label' => '* Email:'
            ])
            ->add('phone', TextType::class, [
                'label' => 'Tel:',
                'required' => false
            ])
            ->add('topic', ChoiceType::class, [
                'label' => '* Sujet:',
                'choices' => [
                        'Une idée de motif à soumettre' => 'Une idée de motif à soumettre',
                        'Un simple message' => 'Un simple message'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => '* Message:'
            ])
            // ->add('send', SubmitType::class, [
            //     'label' => 'Envoyer'
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
