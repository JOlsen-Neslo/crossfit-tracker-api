<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\Athlete;
use App\Entity\Coach;
use App\Entity\CrossfitClass;
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
        $manager->persist($coach);

        $token = new ApiToken($coach);
        $manager->persist($token);

        $class = new CrossfitClass();
        $class->setCoach($coach);
        $class->setDateTime(new \DateTime());
        $class->setDuration(20);

        $athlete = new Athlete();
        $athlete->setName("Athlete");
        $athlete->setMember(false);

        $class->addAthlete($athlete);
        $athlete->addClass($class);
        $manager->persist($class);

        $manager->flush();
    }

}
