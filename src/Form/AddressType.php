<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('road')
            // ('road', TextType::class, [
            //     'attr'=>[
            //         'class'=>'block w-full shadow-sm border-gray-300 dark:border-transparent dark:text-gray-800 rounded-md border p2 mt-1 bm-2'
            //     ],
            //     'label_attr'=>[
            //         'class'=>'block text-sm text-grey-700 dark:text-white font-medium'
            //     ],

            // ])
            ->add('house_number')
            ->add('city')
            ->add('postal_code')
            ->add('country')
            ->add('is_legal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
