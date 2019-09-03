<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use AppBundle\Service\Business\UserBusiness;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DataUserFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    private $userBusiness;

    public function __construct(UserBusiness $business)
    {
        $this->userBusiness = $business;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setPhoneNumber('0635967455')
            ->setFirstName('Jean')
            ->setLastName('Marius')
            ->setEmail('jean.marius@supinfo.com')
            ->setRoles(array(
                'ROLE_ADMIN'
            ))
            ;
        $this->userBusiness->generatePasswordToken($user, false);
        $this->userBusiness->generatePhoneToken($user, false);

        $manager->persist($user);
        $manager->flush();
    }

    public function getOrder()
    {
        return 100;
    }
}
