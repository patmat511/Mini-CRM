<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\Deal;
use App\Entity\Employee;
use App\Entity\Stage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('employeeId')
            ->add('title')
            ->add('amount')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('closedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'choice_label' => 'id',
            ])
            ->add('stage', EntityType::class, [
                'class' => Stage::class,
                'choice_label' => 'id',
            ])
            ->add('employee', EntityType::class, [
                'class' => Employee::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Deal::class,
        ]);
    }
}
