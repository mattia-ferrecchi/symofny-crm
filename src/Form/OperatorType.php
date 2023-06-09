<?php

namespace App\Form;

use App\Entity\Operator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class OperatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('last_name')
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Male' => 'M',
                    'Female' => 'F',
                    'Null' => 'N'
                ],
            ])
            ->add('contact', CollectionType::class, [
                'entry_type'=>ContactType::class,
                'entry_options'=>[],
                'allow_add'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Operator::class,
        ]);
    }
}
