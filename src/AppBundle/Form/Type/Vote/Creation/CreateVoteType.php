<?php

namespace AppBundle\Form\Type\Vote\Creation;


use AppBundle\Entity\Player;
use AppBundle\Entity\Vote;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateVoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('target', EntityType::class, array(
            'class' => Player::class,
            'choices' => $options['players'],
            'choice_label' => function(Player $player) {
                $user = $player->getUser();
                return $user->getFirstName() . ' ' . $user->getLastName();
            },
        ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Vote::class,
            'players' => array(),
        ));
    }
}
