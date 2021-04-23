<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Entity\Developer;
use App\Entity\Activity;
use App\Entity\SkillSet;
use App\Entity\DeveloperAuths;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        $url = $routeBuilder->setController(ProjectCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mon Site');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'homepage');
        yield MenuItem::linkToCrud('Project', 'fa fa-folder', Project::class);
        yield MenuItem::linkToCrud('Developer', 'fa fa-user-circle', Developer::class);
        yield MenuItem::linkToCrud('Activity', 'fa fa-hourglass-end', Activity::class);
        yield MenuItem::linkToCrud('SkillSet', 'fa fa-motorcycle', SkillSet::class);
        yield MenuItem::linkToCrud('SkillSet', 'fa fa-key', DeveloperAuths::class);
    }

    

}
