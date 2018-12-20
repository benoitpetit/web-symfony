<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use App\Service\TshirtService;
use App\Entity\BasketProduct;

class BasketProductType extends AbstractType
{
    private $products;

    public function __construct( TshirtService $tshirtService ) {
        $this->products = $tshirtService->getAllTshirtSize()->getRecords();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Génération d'une table sur les tailles de Tshirt
        $sizes = [];
        foreach( $this->products as $keyProduct => $valueProduct ) {
            foreach( $valueProduct as $keyWording => $valueWording ) {
                if ( $keyWording == 'id' )
                    $id = $valueWording;
                if ( $keyWording == 'wording' )
                    $wording = $valueWording;
            }
            $sizes[ $wording ] = $id;
        }

        $builder
            ->add('product_type', HiddenType::class)
            ->add('gender_id', HiddenType::class )
            ->add('color_id', HiddenType::class)
            ->add('logo_id', HiddenType::class)
            ->add('size_id', ChoiceType::class, [ 'label' => 'Tailles', 'choices' => $sizes ] )
            ->add('quantity', ChoiceType::class, [ 'label' => 'Quantité', 'choices' => [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, ] ])
            ->add('price_unit_ttc', HiddenType::class)
            ->add('price_unit_ht', HiddenType::class)
            ->add('promo_unit_ht', HiddenType::class)

            // SUBMIT //
            // ->add('submit', SubmitType::class, ['label'=>'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BasketProduct::class,
        ]);
    }
}
