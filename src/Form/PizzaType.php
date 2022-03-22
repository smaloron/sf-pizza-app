<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Pizza;
use App\Entity\PizzaBase;
use App\Entity\PizzaSize;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('size', EntityType::class, [
                'class' => PizzaSize::class,
                'choice_label' => 'name'
            ])
            ->add('base', EntityType::class, [
                'class'=> PizzaBase::class,
                'choice_label' => 'name'
            ])
            ->add('ingredients', EntityType::class, [
                'class'=> Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}
