<?php

namespace App\Controller\Admin;

use App\Entity\UserAuths;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserAuthsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserAuths::class;
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
