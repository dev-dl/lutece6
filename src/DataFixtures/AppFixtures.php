<?php

namespace App\DataFixtures;

use App\Entity\Developer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $lin_guo = new Developer();
        $lin_guo -> setDeveloperName('Lin GUO');
        $lin_guo -> setEmail('lin@mail.com');
        $lin_guo -> setSocialNetwork('twitter, github');
        $manager->persist($lin_guo);

        $manager->flush();
    }
}
