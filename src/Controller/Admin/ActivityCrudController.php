<?php

namespace App\Controller\Admin;

use App\Entity\Activity;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class ActivityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Activity::class;
    }


    public function configureCrud(Crud $crud): Crud 
    {
        return $crud
            ->setSearchFields(['skill','developer.developerName','project.projectName'])
            ->setDefaultSort(['time_used' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters 
    {
        return $filters
            ->add(EntityFilter::new('project'))
            ;
    } 


    
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new('project');
        yield AssociationField::new('developer');
        yield TextField::new('skill');
        yield IntegerField::new('time_used');        
        yield DateTimeField::new('createdAt');
    }
    
}
