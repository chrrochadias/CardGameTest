<?php

declare(strict_types=1);

namespace App\Form;

use App\DTO\HandOrderFamilyDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HandFamilyOrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('handFamilyOrders', CollectionType::class, [
                'entry_type' => HandFamilyOrderType::class,
                'allow_add' => true,
                'prototype' => true,
                'by_reference' => false,
            ])
            ->add('submit', SubmitType::class, ['label' => 'Order cards family'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HandOrderFamilyDto::class,
        ]);
    }

}
