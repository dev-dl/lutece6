<?php

namespace App\Controller\Admin;

use App\Entity\SkillSet;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class SkillSetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SkillSet::class;
    }


    public function configureCrud(Crud $crud): Crud 
    {
        return $crud
            ->setSearchFields(['skill','developer.developerName'])
            ->setDefaultSort(['percentage' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters 
    {
        return $filters
            ->add(EntityFilter::new('developer'))
            ;
    } 


    
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('developer');
        yield TextField::new('skill');
        yield IntegerField::new('percentage');
    }
    
}

