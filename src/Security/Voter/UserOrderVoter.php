<?php

namespace App\Security\Voter;

use App\Entity\UserOrder;
use App\Entity\UserProduct;
use App\Event\AppEvent;
use App\Security\AppAccess;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserOrderVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [AppAccess::USERORDERSHOW, AppAccess::USERORDEREDIT])
            && $subject instanceof UserProduct;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if ($subject->getUser() === $user) {
            return true;
        }

        return false;
    }
}
