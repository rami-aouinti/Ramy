<?php

namespace App\Controller\Admin;

use App\Entity\Conversation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ConversationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Conversation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $field = [
            AssociationField::new('participants')->formatValue(function ($value, $entity) {
                $str = $entity->getParticipants()[0];
                for ($i = 1; $i < $entity->getParticipants()->count(); $i++) {
                    $str = $str . ", " . $entity->getParticipants()[$i];
                }
                return $str;
            }),
            AssociationField::new('messages')->formatValue(function ($value, $entity) {
                $str = $entity->getMessages()[0];
                for ($i = 1; $i < $entity->getMessages()->count(); $i++) {
                    $str = $str . ", " . $entity->getMessages()[$i];
                }
                return $str;
            }),
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
