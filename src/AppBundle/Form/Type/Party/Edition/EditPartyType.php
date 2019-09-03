<?php

namespace AppBundle\Form\Type\Party\Edition;

use AppBundle\Entity\CardType;
use AppBundle\Entity\Party;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPartyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('cardTypes', EntityType::class, array(
                'class' => CardType::class,
                'choice_label' => 'name',
                'multiple' => true,
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Party::class,
        ));
    }
}