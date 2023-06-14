<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Operator;
use App\Entity\Plant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start_date', DateType::class)
            ->add('end_date', DateType::class)
            ->add('operator', EntityType::class, [
                'class'=>Operator::class,
                'choice_label'=>function($operator) {
                    return $operator->getId() . ' ' . $operator->getName() . ' ' . $operator->getLastName();
                }
            ])
            ->add('plant', EntityType::class, [
                'class'=>Plant::class,
                'choice_label' => 'plant_name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}
