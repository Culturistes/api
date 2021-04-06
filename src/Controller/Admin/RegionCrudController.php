<?php

namespace App\Controller\Admin;

use App\Entity\Region;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use Symfony\Component\Security\Core\Security;

class RegionCrudController extends AbstractCrudController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getEntityFqcn(): string
    {
        return Region::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
                ->setDefaultSort(['name' => 'ASC'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $configureFileds = [];
        $configureFileds[] = TextField::new('name')->setLabel('Nom');
        if ($this->isGranted('ROLE_DEV')) {
            $configureFileds[] = TextField::new('tag')->setHelp('Pour les dév seulement : un identifiant de trois lettres unique par rapport aux autres sans accent ni caractères spéciaux ni majuscules..');
        }
        //$configureFileds[] = AssociationField::new('questions')->hideOnForm();
        $configureFileds[] = Field::new('nbrQuiz')->setLabel('Quiz')->hideOnForm();
        $configureFileds[] = Field::new('nbrLml')->setLabel('La majorité l\'emporte')->hideOnForm();

        return $configureFileds;
    }
}
