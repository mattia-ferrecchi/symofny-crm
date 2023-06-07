<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('road')
            ->add('house_number')
            ->add('city')
            ->add('postal_code')
            ->add('country')
            ->add('is_legal')
            ->add('company', EntityType::class, [
                'class'=>Company::class,
                'choice_label'=>'legal_name',
                'empty_data' => null
            ])
            ->add('site')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
