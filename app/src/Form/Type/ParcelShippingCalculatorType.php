<?php


namespace App\Form\Type;

use Sylius\Bundle\MoneyBundle\Form\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ParcelShippingCalculatorType
 * @package App\Form\Type
 */
class ParcelShippingCalculatorType extends \Symfony\Component\Form\AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("size", NumberType::class)
            ->add("price", MoneyType::class, [
                "currency" => "USD" // @TODO Get proper currency code from repository/context/configuration
            ])
        ;
    }
}
