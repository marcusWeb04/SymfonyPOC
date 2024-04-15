<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Project;
use App\Entity\ProjectOwner;
use App\Enum\GenderEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectOwnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('city')
            ->add('gender', EnumType::class, [
                'class' => GenderEnum::class,
                'choice_label' => 'value',
            ])
            ->add('email')
            ->add('project', ProjectType::class)
            ->add('employees', EntityType::class, [
                'class' => Employee::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProjectOwner::class,
        ]);
    }
}
