<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use App\Model\Followup;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MovieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Movie::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $list = Action::new('seeList')
            ->linkToRoute('movies_list')
            ->createAsGlobalAction();
        return $actions->add(Crud::PAGE_INDEX, $list);
    }


    public function configureFields(string $pageName): iterable
    {
        
        yield TextField::new('title');
        yield TextField::new('director');
        yield TextEditorField::new('plot');
        yield AssociationField::new('books');
        yield DateField::new('year');
        yield ChoiceField::new('followup')->setChoices(
            Followup::cases()
        );
    }

}
