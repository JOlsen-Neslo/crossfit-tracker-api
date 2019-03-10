<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\Coach;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $coach = new Coach();
        $coach->setName("Coach");
        $coach->setPassword("12345");
        $manager->persist($coach);
        
        $coach = new Coach();
        $coach->setName("Coach" . rand(1, 100));
        $coach->setPassword("12345");

        $token = new ApiToken($coach);
        $manager->persist($token);

        $manager->persist($coach);
        $manager->flush();
    }

}
