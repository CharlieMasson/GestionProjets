<?php

namespace App\DataFixtures;

use App\Entity\Technology;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TechnologyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $technologies = [
            'PHP',
            'JavaScript',
            'C++',
        ];

        foreach ($technologies as $technologyLabel) {
            $technology = new Technology();
            $technology->setTechnologyLabel($technologyLabel);
            $manager->persist($technology);

            $this->addReference('technology_' . strtolower($technologyLabel), $technology);
        }

        $manager->flush();
    }
}
