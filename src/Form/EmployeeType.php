<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Roles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'password',
            ])
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('role', EntityType::class, [
                'class' => Roles::class,
                'choice_label' => 'roleName',
                'choice_value' => 'roleId',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
