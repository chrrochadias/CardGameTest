<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\CardFamily;
use App\Entity\HandFamilyOrder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HandFamilyOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardFamily', TextType::class, [
                'data_class' => CardFamily::class,
                'disabled' => true,
            ])
            ->add('position', ChoiceType::class, [
                'choices' => [
                    'First' => 1,
                    'Second' => 2,
                    'Third' => 3,
                    'Fourth' => 4,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HandFamilyOrder::class,
        ]);
    }
}
