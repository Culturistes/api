<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Region;
use App\Entity\Minigame;
use App\Entity\Question;

use App\Service\DateService;

use App\Controller\Admin\RegionCrudController;

use Symfony\Component\Security\Core\Security;

class DashboardController extends AbstractDashboardController
{
    private $security;
    private $dateService;

    public function __construct(Security $security, DateService $dateService)
    {
        $this->security = $security;
        $this->dateService = $dateService;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {

        return $this->render('admin/dashboard.html.twig', [
            'user' => $this->getUser(),
            'dates' => $this->dateService->getDates(),

        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('#Culturistes');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Infos générales du jeu');
        yield MenuItem::linkToCrud('Region', 'fas fa-atlas', Region::class);
        yield MenuItem::linkToCrud('Epreuve', 'fas fa-gamepad', Minigame::class);

        yield MenuItem::section('Type de jeu');
        yield MenuItem::linkToCrud('Question', 'fas fa-question', Question::class);

        yield MenuItem::section('Pour ne plus demander ;)');
        yield MenuItem::linkToUrl('BB Collab', 'fas fa-school', 'https://dmii.link/bb');
        yield MenuItem::linkToUrl('Figma', 'fab fa-figma', 'https://www.figma.com/file/htz8pSKy3D4ZJrlM00XYOO/Untitled?node-id=0%3A1');

        yield MenuItem::section('Oim');
        if ($this->isGranted('ROLE_REMI')) {
            yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', User::class);
        }
        yield MenuItem::linkToRoute('Changer mot de passe', 'fas fa-user', 'admin_me_password');
        yield MenuItem::linkToLogout('Se déconnecter', 'fas fa-sign-out-alt');
    }
}
