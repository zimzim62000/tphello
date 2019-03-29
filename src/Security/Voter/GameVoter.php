<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 29/03/2019
 * Time: 14:46
 */

namespace App\Security\Voter;

use App\Entity\Game;
use App\Security\AppAccess;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class GameVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [AppAccess::GAME_METHODS])
            && $subject instanceof Game;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if ($this->security->isGranted('ROLE_ADMIN') === true) {
            return true;
        }

        if ($subject->getUserCharacters()->getUser() === $user) {
            return true;
        }

        return false;
    }
}