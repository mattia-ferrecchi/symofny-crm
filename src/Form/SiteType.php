<?php

namespace App\Form;

use App\Entity\Site;
use App\Entity\Company;
use App\Entity\Operator;
use App\Form\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('legal_name')
            ->add('company', EntityType::class, [
                'class'=>Company::class,
                'choice_label'=>'legal_name'
                
            ])
            ->add('supervisor', EntityType::class, [
                'class'=>Operator::class,
                'choice_label'=> function($operator) {
                    return $operator->getId() . ' ' . $operator->getName() . ' ' . $operator->getLastName();
                }
            ])
            ->add('address', AddressType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Site::class,
        ]);
    }
}
