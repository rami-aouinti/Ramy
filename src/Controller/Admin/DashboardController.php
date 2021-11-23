<?php

namespace App\Controller\Admin;

use App\Entity\Conversation;
use App\Entity\Message;
use App\Entity\Office;
use App\Entity\Participant;
use App\Entity\Role;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

/**
 * Class Dashboard Controller
 */
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();
    }

    /**
     * @return Dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ramy World');
    }

    /**
     * @return iterable
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Offices', 'fa fa-user', Office::class);
        yield MenuItem::linkToCrud('Roles', 'fa fa-user', Role::class);
        yield MenuItem::linkToCrud('Participant', 'fa fa-user', Participant::class);
        yield MenuItem::linkToCrud('Message', 'fa fa-user', Message::class);
        yield MenuItem::linkToCrud('Conversation', 'fa fa-user', Conversation::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    /**
     * @return Crud
     */
    public function configureCrud(): Crud
    {
        return Crud::new()
            // this defines the pagination size for all CRUD controllers
            // (each CRUD controller can override this value if needed)
            ->setPaginatorPageSize(10)
            ;
    }
}
