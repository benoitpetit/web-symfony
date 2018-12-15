<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use App\Entity\Address;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('street', TextType::class, array( 'label' => '* Numéro / Rue',
                                                  'required' => true,
                                                ))
            ->add('zip_code', TextType::class, array( 'label' => '* Code postal',
                                                  'required' => true,
                                                  ))
            ->add('city', TextType::class, array( 'label' => '* Ville',
                                                  'required' => true,
                                                ))
            ->add('country', ChoiceType::class, array(
                                        'label' => '* Pays',
                                        'choices' => array(
                                            'France' => 'France',
                                            'Belgium' => 'Belgium',
                                        ),
                                        'preferred_choices' => array('France')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
