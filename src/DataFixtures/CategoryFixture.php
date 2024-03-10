<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = [
            'Projet personnel',
            'E-Commerce',
            'Application mobile',
            'Veille technique',
        ];

        foreach ($categories as $categoryLabel) {
            $category = new Category();
            $category->setCategoryLabel($categoryLabel);
            $manager->persist($category);

            // Add a reference for each category
            $this->addReference('category_' . strtolower(str_replace(' ', '_', $categoryLabel)), $category);
        }

        $manager->flush();
    }
}
