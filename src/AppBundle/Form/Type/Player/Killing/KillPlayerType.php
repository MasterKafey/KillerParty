<?php

namespace AppBundle\Form\Type\Player\Killing;


use AppBundle\Entity\Player;
use AppBundle\Form\Model\Player\Killing\KillPlayerModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KillPlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('player', EntityType::class, array(
            'class' => Player::class,
            'choices' => $options['players'],
            'choice_label' => function (Player $player) {
                return $player->getUser()->getFirstName() . ' ' . $player->getUser()->getLastName();
            },
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => KillPlayerModel::class,
            'party' => null,
            'players' => array(),
        ));
    }
}
