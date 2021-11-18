<?php

namespace App\Controller\Admin;

use App\Entity\Office;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OfficeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Office::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $field = [
            TextField::new('name'),
            AssociationField::new('role')->formatValue(function ($value, $entity) {
                $str = $entity->getRole()[0];
                for ($i = 1; $i < $entity->getRole()->count(); $i++) {
                    $str = $str . ", " . $entity->getRole()[$i];
                }
                return $str;
            })
        ];
        return $field;
    }

    /**
     * @param Actions $actions
     * @return Actions
     */
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
            ;
    }
}
