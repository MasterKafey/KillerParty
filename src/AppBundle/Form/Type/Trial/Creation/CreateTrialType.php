<?php

namespace AppBundle\Form\Type\Trial\Creation;

use AppBundle\Entity\Contract;
use AppBundle\Entity\Trial;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateTrialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contract', EntityType::class, array(
                'class' => Contract::class,
                'choices' => $options['contracts'],
                'choice_label' => function (Contract $contract) {
                    $murderer = $contract->getOwner()->getUser();
                    $target = $contract->getTarget()->getUser();
                    return $murderer->getFirstName() . ' ' . $murderer->getLastName() . ' a tué ' . $target->getFirstName() . ' ' . $target->getLastName();
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Trial::class,
            'contracts' => array(),
        ));
    }
}
