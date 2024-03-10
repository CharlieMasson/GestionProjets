<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Project;
use App\Entity\Technology;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProjectFixture extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            CategoryFixture::class,
            TechnologyFixture::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        $category1 = $this->getReference('category_e-commerce');
        $category2 = $this->getReference('category_veille_technique');
        $technology1 = $this->getReference('technology_php');
        $technology2 = $this->getReference('technology_javascript');
        $technology3 = $this->getReference('technology_c++');
        
        // project 1
        $project1 = new Project();
        $project1->setProjectName('Project 1 Name');
        $project1->setProjectThumbnail('project1_thumbnail.jpg');
        $project1->setProjectDescription('Project 1 Description');
        $project1->setProjectLink('https://example.com/project1');
        $project1->setProjectStartDate(new \DateTime('now'));
        $project1->setProjectEndDate(new \DateTime('tomorrow'));
        $project1->setProjectCreationDate(new \DateTime('now'));
        $project1->setProjectModificationDate(new \DateTime('now'));
        $project1->setCategory($category1);
        $project1->addTechnology($technology1);
        $project1->addTechnology($technology2);
        
        $manager->persist($project1);
        
        // project 2
        $project2 = new Project();
        $project2->setProjectName('Project 2 Name');
        $project2->setProjectThumbnail('project2_thumbnail.jpg');
        $project2->setProjectDescription('Project 2 Description');
        $project2->setProjectLink('https://example.com/project2');
        $project2->setProjectStartDate(new \DateTime('now'));
        $project2->setProjectEndDate(new \DateTime('tomorrow'));
        $project2->setProjectCreationDate(new \DateTime('now'));
        $project2->setProjectModificationDate(new \DateTime('now'));
        $project2->setCategory($category2);
        $project2->addTechnology($technology3);
        
        $manager->persist($project2);
        
        $manager->flush();
    }
}