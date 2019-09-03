<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DataUserFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setPhoneNumber('0635967455')
            ->setFirstName('Jean')
            ->setLastName('Marius')
            ->setEmail('jean.marius@supinfo.com')
            ->setPlainPassword('admin')
            ->setRoles(array(
                'ROLE_ADMIN'
            ))
            ;

        $manager->persist($user);
        $manager->flush();
    }

    public function getOrder()
    {
        return 100;
    }
}
