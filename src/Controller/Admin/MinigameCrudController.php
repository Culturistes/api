<?php

namespace App\Controller\Admin;

use App\Entity\Minigame;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use Symfony\Component\Security\Core\Security;

class MinigameCrudController extends AbstractCrudController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getEntityFqcn(): string
    {
        return Minigame::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $configureFileds = [];
        $configureFileds[] = TextField::new('title')->setLabel('Nom');
        if ($this->isGranted('ROLE_DEV')) {
            $configureFileds[] = TextField::new('tag');
        }
        $configureFileds[] = AssociationField::new('questions')->hideOnForm();
        $configureFileds[] = Field::new('active');

        return $configureFileds;
    }
}
