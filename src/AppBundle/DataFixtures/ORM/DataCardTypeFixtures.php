<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\CardType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DataCardTypeFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $short = $this->saveCardType('Durée courte', $manager);
        $medium = $this->saveCardType('Durée moyenne', $manager);
        $long = $this->saveCardType('Durée longue', $manager);
        $manager->flush();
        $this->addReference("card-type-short", $short);
        $this->addReference("card-type-medium", $medium);
        $this->addReference("card-type-long", $long);
    }

    protected function saveCardType($name, ObjectManager $manager)
    {
        $cardType = (new CardType())->setName($name);
        $manager->persist(
            $cardType
        );

        return $cardType;
    }

    public function getOrder()
    {
        return 100;
    }
}
