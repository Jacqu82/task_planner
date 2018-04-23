<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use AppBundle\Entity\Task;
use AppBundle\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];
//        dump($options); die;

        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'Kategoria',
                'placeholder' => 'Dodaj kategorię',
                'query_builder' => function(CategoryRepository $repo) use ($user) {
                return $repo->findCategoryByUser($user);
                }
            ])
            ->add('name', null, [
                'label' => 'Zadanie',
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
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'user' => false
        ]);
    }
}
