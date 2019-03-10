<?php

namespace App\DataFixtures;

use App\Entity\Coach;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $coach = new Coach();
        $coach->setName('Coach' . rand(1, 100));
        $coach->setPassword('12345');

        $manager->persist($coach);
        $manager->flush();
    }

}
