<?php

namespace AppBundle\Form\Type\Contract\Edition;


use AppBundle\Entity\Contract;
use AppBundle\Entity\KillerCard;
use AppBundle\Entity\Player;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditContractType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('target', EntityType::class, array(
            'class' => Player::class,
            'choices' => $options['players'],
            'choice_label' => function (Player $player) {
                return $player->getUser()->getFirstName() . ' ' . $player->getUser()->getLastName();
            },
        ))
        ->add('killerCard', EntityType::class, array(
            'class' => KillerCard::class,
            'choice_label' => 'title',
            'query_builder' => function(EntityRepository $repository) use ($options) {
                $query = $repository->createQueryBuilder('killer_card');
                $query->where($query->expr()->in('killer_card.type', ':types'))
                    ->setParameter('types', $options['party']->getCardTypes())
                ;
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Contract::class,
            'party' => null,
            'players' => array(),
        ));
    }
}
