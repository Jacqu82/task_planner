<?php

namespace AppBundle\Form;

use AppBundle\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nazwa',
                'attr' => [
                    'placeholder' => 'Nazwa'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Opis',
                'attr' => [
                'placeholder' => 'Opis(opcjonalnie)'
            ]])
            ->add('isDone', ChoiceType::class, [
                'label' => 'Wykonany?',
                'choices' => [
                    'Tak' => true,
                    'Nie' => false
                ]
            ])
            ->add('category', null, [
                'label' => 'Kategoria',
                'placeholder' => 'Dodaj kategorię'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Task::class]);
    }
}
