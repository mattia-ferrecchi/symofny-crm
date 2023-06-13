<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Contact;
use App\Entity\Operator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, array(
                'attr'=>['class'=>'block w-full shadow-sm border-gray-300 dark:border-transparent dark:text-gray-800 rounded-md border p2 mt-1 bm-2'],
                'label'=>'Enter the contact email',
                'label_attr'=>['class'=>'block text-sm text-grey-700 dark:text-grey-300 font-medium']
            ))
            ->add('phone_number', IntegerType::class, array(
                'attr'=>['class'=>'block w-full shadow-sm border-gray-300 dark:border-transparent dark:text-gray-800 rounded-md border p2 mt-1 bm-2'],
                'label'=>'Enter the contact phone number',
                'label_attr'=>['class'=>'block text-sm text-grey-700 dark:text-grey-300 font-medium']
            ))
            ->add('name', TextType::class, array(
                'attr'=>['class'=>'block w-full shadow-sm border-gray-300 dark:border-transparent dark:text-gray-800 rounded-md border p2 mt-1 bm-2'],
                'label'=>'Enter the contact name',
                'label_attr'=>['class'=>'block text-sm text-grey-700 dark:text-grey-300 font-medium']
            ))
            ->add('last_name', TextType::class, array(
                'attr'=>['class'=>'block w-full shadow-sm border-gray-300 dark:border-transparent dark:text-gray-800 rounded-md border p2 mt-1 bm-2'],
                'label'=>'Enter the contact last name',
                'label_attr'=>['class'=>'block text-sm text-grey-700 dark:text-grey-300 font-medium']
            ))
            ->add('is_main', CheckboxType::class, array(
                'attr'=>['class'=>'h-4 w-4 rounded border-gray border text-indigo-300'],
                'label'=>'Is main',
                'label_attr'=>['class'=>'text-sm text-grey-700 dark:text-grey-300 font-medium mr-2']
            ))
            // ->add('company', EntityType::class, [
            //     'class'=>Company::class,
            //     'choice_label'=>'legal_name'
            // ])
            // ->add('operator', EntityType::class, [
            //     'class'=>Operator::class,
            //     'choice_label'=> function($operator) {
            //         return $operator->getId() . ' ' . $operator->getName() . ' ' . $operator->getLastName();
            //     }
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
