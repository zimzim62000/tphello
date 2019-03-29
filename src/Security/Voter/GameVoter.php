<?php
/**
 * Created by PhpStorm.
 * User: amaury.beauchamp
 * Date: 29/03/19
 * Time: 15:53
 */

namespace App\Security\Voter;
use App\Entity\Game;
use App\Entity\User;
use App\Entity\UserCharacters;
use App\Security\AppAccess;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class GameVoter extends Voter
{
    private $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [AppAccess::GAME_SHOW, AppAccess::GAME_EDIT])){
            return false;
        }
        if (!$subject instanceof Game) {
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
            case AppAccess::GAME_SHOW:
            case AppAccess::GAME_EDIT:
                return $subject->getUserCharacters()->getUser() === $user;
                break;
        }
    }
}