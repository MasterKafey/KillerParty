<?php

namespace AppBundle\Form\Type\User\Edition;


use AppBundle\Entity\User;
use AppBundle\Entity\UserModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'disabled' => true,
            ))
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('userModel', EntityType::class, array(
                'class' => UserModel::class,
                'choice_label' => 'name',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
