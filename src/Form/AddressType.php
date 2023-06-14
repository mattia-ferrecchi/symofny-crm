<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('road', TextType::class, array(
                'attr'=>['class'=>'block w-full shadow-sm border-gray-300 dark:border-transparent dark:text-gray-800 rounded-md border p2 mt-1 bm-2'],
                'label'=>'Road',
                'label_attr'=>['class'=>'block text-sm text-grey-700 dark:text-grey-300 font-medium'],
                'required'=>true
            ))
            ->add('house_number', IntegerType::class, array(
                'attr'=>['class'=>'block w-full shadow-sm border-gray-300 dark:border-transparent dark:text-gray-800 rounded-md border p2 mt-1 bm-2'],
                'label'=>'House number',
                'label_attr'=>['class'=>'block text-sm text-grey-700 dark:text-grey-300 font-medium'],
                'required'=>true
            ))
            ->add('city', TextType::class, array(
                'attr'=>['class'=>'block w-full shadow-sm border-gray-300 dark:border-transparent dark:text-gray-800 rounded-md border p2 mt-1 bm-2'],
                'label'=>'City',
                'label_attr'=>['class'=>'block text-sm text-grey-700 dark:text-grey-300 font-medium'],
                'required'=>true
            ))
            ->add('postal_code', TextType::class, array(
                'attr'=>['class'=>'block w-full shadow-sm border-gray-300 dark:border-transparent dark:text-gray-800 rounded-md border p2 mt-1 bm-2'],
                'label'=>'Postal code',
                'label_attr'=>['class'=>'block text-sm text-grey-700 dark:text-grey-300 font-medium'],
                'required'=>true
            ))
            ->add('country', TextType::class, array(
                'attr'=>['class'=>'block w-full shadow-sm border-gray-300 dark:border-transparent dark:text-gray-800 rounded-md border p2 mt-1 bm-2'],
                'label'=>'Country',
                'label_attr'=>['class'=>'block text-sm text-grey-700 dark:text-grey-300 font-medium'],
                'required'=>true
            ))
            ->add('is_legal', CheckboxType::class, array(
                'attr'=>['class'=>'h-4 w-4 rounded border-gray border text-indigo-300'],
                'label'=>'Is legal',
                'label_attr'=>['class'=>'text-sm text-grey-700 dark:text-grey-300 font-medium mr-2']
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
