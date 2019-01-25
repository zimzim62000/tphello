<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 19/12/2018
 * Time: 11:05
 */

namespace App\Security\Voter;

use App\Entity\Bet;
use App\Entity\Histoire;
use App\Entity\User;
use App\Security\AppAccess;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class BetVoter extends Voter {
    private $security;

    public function __construct(Security $security) {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [AppAccess::BET_ACCESS, AppAccess::BET_EDIT]))
        {
            return false;
        }

        if (!$subject instanceof Bet) {
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


        return $subject->getUser()->getId() === $user->getId();

    }
}