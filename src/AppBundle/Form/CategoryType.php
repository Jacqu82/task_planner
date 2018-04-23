<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Kategoria'])
//            ->add ('tasks', CollectionType::class, [
//                'label' => false,
//                'entry_type' => TaskType::class,
//                'allow_delete' => true,
//                'allow_add' => true,
//                'by_reference' => false
//            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Category::class]);
    }
}
