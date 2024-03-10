<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('admin');
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setPassword('$2y$13$lzvwprj1sqWZvLwAtv2nzO78vFj6i9fOhKaBoOOgW.JY3pDLi3cWi');
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('utilisateur');
        $user2->setRoles(['ROLE_USER']);
        $user2->setPassword('$2y$13$zrJn4VRC27Qyt7AJNItlJ.GssJKijaBJDf5XU8YvZ9SVhQAOZklKK');

        $manager->persist($user2);

        $manager->flush();
    }
}
