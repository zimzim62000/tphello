<?php
/**
 * Created by PhpStorm.
 * User: alexandrehembert
 * Date: 29/03/2019
 * Time: 15:54
 */

namespace App\Security\Voter;



namespace App\Security\Voter;
use App\Security\AppAccess;
use App\Entity\User;
use App\Entity\Game;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
class UserGameVoter extends Voter
{
    private $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [AppAccess::USER_GAME_SHOW, AppAccess::USER_GAME_EDIT])){
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
            case AppAccess::USER_GAME_EDIT:
            case AppAccess::USER_GAME_SHOW:
                return $subject->getId() !== $user->getId();
                break;
        }
    }
}