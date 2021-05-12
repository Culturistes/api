<?php

namespace App\Controller\Admin;

use App\Entity\FunCityName;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;

class FunCityNameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FunCityName::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...

            // don't forget to add EasyAdmin's form theme at the end of the list
            // (otherwise you'll lose all the styles for the rest of form fields)
            ->setFormThemes(['admin/funCityName/form.html.twig', '@EasyAdmin/crud/form_theme.html.twig'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('name')->setLabel('Nom du patelin'),
            Field::new('latitude')->setLabel('Latitude'),
            Field::new('longitude')->setLabel('Longitude')->setFormTypeOptions([
                'block_name' => 'custom',
            ]),
            Field::new('gentile')->setLabel('Gentilé')->hideOnIndex(),
            AssociationField::new('regions')->setLabel('Region associée')->onlyOnForms(),
            Field::new('RegionName')->setLabel('Region associée')->hideOnForm(),
            Field::new('active')->setHelp('Permet de désactiver une question, décocher pour l\'empêcher d\'apparaitre dans le jeu sans la supprimer'),
            AssociationField::new('creator')->hideOnForm()->hideOnIndex(),
            Field::new('createdAt')->hideOnForm()->hideOnIndex(),
            AssociationField::new('lastUpdater')->hideOnForm()->hideOnIndex(),
            Field::new('updatedAt')->hideOnForm()->hideOnIndex(),
        ];
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ->addHtmlContentToHead('<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
            integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
            crossorigin=""/>')
            ->addHtmlContentToHead('<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>')
            ->addHtmlContentToHead('<link
            rel="stylesheet"
            href="https://unpkg.com/leaflet-geosearch@3.2.1/dist/geosearch.css"
          />')
          ->addHtmlContentToHead('<script src="https://unpkg.com/leaflet-geosearch@3.2.1/dist/geosearch.umd.js"></script>')
            ->addHtmlContentToBody('<script src="js/map.js"></script>')
        ;
    }
}
