<?php

namespace App\Security;

use App\Entity\Game;
use App\Event\AppEvent;
use App\Security\AppAccess;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class GameVoter extends Voter
{
    private $securityChecker;

    public function __construct(AuthorizationCheckerInterface $securityChecker)
    {
        $this->securityChecker = $securityChecker;
    }

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [AppAccess::gameShow, AppAccess::gameEdit, AppAccess::gameDelete, AppAccess::gameNew])
            && $subject instanceof Game;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        if ($subject->getUserCharacters()->getUser() === $user) {
            return true;
        }
        if ($this->securityChecker->isGranted('ROLE_ADMIN') === true) {
            return true;
        }
        return false;
    }
}