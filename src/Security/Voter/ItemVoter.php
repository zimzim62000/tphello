<?php

namespace App\Security\Voter;

use App\Security\AppAccess;
use App\Entity\User;
use App\Entity\Item;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

use Symfony\Component\Security\Core\Security;

class ItemVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [AppAccess::ITEM_SHOW, AppAccess::ITEM_EDIT, AppAccess::ITEM_DELETE])){
            return false;
        }
        if (!$subject instanceof Item) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {

            return false;
        }

        if ($this->security->isGranted('ROLE_ADMIN') === true) {
            return true;
        }

        switch ($attribute){
            case AppAccess::ITEM_DELETE:
            case AppAccess::ITEM_EDIT:
            case AppAccess::ITEM_SHOW:
                return $subject->getUser()->getId() === $user->getId();
                break;
        }
    }
}