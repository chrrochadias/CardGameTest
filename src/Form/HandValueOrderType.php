<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\CardValue;
use App\Entity\HandValueOrder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HandValueOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardValue', TextType::class, [
                'data_class' => CardValue::class,
                'disabled' => true,
            ])
            ->add('position', ChoiceType::class, [
                'choices' => [
                    'First' => 1,
                    'Second' => 2,
                    'Third' => 3,
                    'Fourth' => 4,
                    'Fifth' => 5,
                    'Sixth' => 6,
                    'Seventh' => 7,
                    'Eighth' => 8,
                    'Ninth' => 9,
                    'Tenth' => 10,
                    'Eleventh' => 11,
                    'Twelfth' => 12,
                    'Thirteenth' => 13,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HandValueOrder::class,
        ]);
    }
}
