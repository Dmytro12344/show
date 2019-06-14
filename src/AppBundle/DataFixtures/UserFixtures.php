<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures implements ORMFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setUsername('user');
        $user->setPassword($this->encoder->encodePassword($user, '1234'));
        $user->setEmail('some@gmail.com');
        $user->setRoles('ROLE_ADMIN');
        $manager->persist($user);


        $manager->flush();
    }

}