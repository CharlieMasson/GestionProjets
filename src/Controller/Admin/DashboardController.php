<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin_dashboard_index')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //$adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        //return $this->redirect($adminUrlGenerator->setController(ProjectController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestionnaire Projets');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Menu', 'fa fa-home');
        yield MenuItem::linkToCrud('Projets', 'fa-solid fa-folder', Project::class);
        yield MenuItem::linkToCrud('Nouveau Projet', 'fa-solid fa-plus', Project::class)->setAction('new');
        yield MenuItem::linkToRoute('Retour à l\'acceuil', 'fa-solid fa-arrow-left', 'app_home');
        yield MenuItem::linkToLogout('Déconnexion', 'fa-solid fa-door-open');
    }

    public function configeCrud(): Crud 
    {
        return parent::configureCrud();
    }
}
