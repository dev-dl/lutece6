<?php

namespace App\Controller\Admin;

use App\Entity\DeveloperAuths;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DeveloperAuthsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DeveloperAuths::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
