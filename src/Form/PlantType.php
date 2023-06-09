<?php

namespace App\Form;

use App\Entity\Site;
use App\Entity\Plant;
use App\Entity\Operator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PlantType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plant_name')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Production' => 'production',
                    'Storage' => 'storage',
                    'Control' => 'control', 
                    'Logistic' => 'logistic',
                    'Receipt' => 'receipt',
                    'Virtual' => 'virtual'
                ],
            ])
            ->add('site', EntityType::class, [
                'class'=>Site::class,
                'choice_label'=>'legal_name'
            ])
            ->add('supervisor', EntityType::class, [
                'class'=>Operator::class,
                'choice_label'=> function($operator) {
                    return $operator->getId() . ' ' . $operator->getName() . ' ' . $operator->getLastName();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plant::class,
        ]);
    }
}
