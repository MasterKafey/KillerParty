<?php

namespace AppBundle\Form\Type\KillerCard\Creation;


use AppBundle\Entity\CardType;
use AppBundle\Entity\KillerCard;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateKillerCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('place', TextType::class)
            ->add('weapon', TextType::class)
            ->add('objective', TextType::class)
            ->add('type', EntityType::class, array(
                'class' => CardType::class,
                'choice_label' => 'name',
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => KillerCard::class,
        ));
    }
}
