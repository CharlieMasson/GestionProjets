<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\EntityType;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;


class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('projectName', 'Nom'),
            ImageField::new('projectThumbnail', 'Vignette')
                ->setUploadDir('public/uploads/images')
                ->setBasePath('uploads/images'),
            TextareaField::new('projectDescription', 'Description'),
            TextField::new('projectLink', 'Lien'),
            DateField::new('projectStartDate', 'Date de début'),
            DateField::new('projectEndDate', 'Date de fin'),
            DateField::new('projectCreationDate', 'Date de création'),
            DateField::new('projectModificationDate', 'Date de modification'),
            AssociationField::new('Category', 'Catégorie'),
            CollectionField::new('technologies', 'Technologies')
                ->setFormTypeOptions([
                    'by_reference' => false,
                    'allow_add' => true,
                    'allow_delete' => true, 
                ])
                ->setEntryType(EntityType::class)
                ->setCustomOptions([
                    'class' => 'App\Entity\Technology',
                    'multiple' => true,
                ]),
        ];
    }
}
