<?php
/**
 * Created by PhpStorm.
 * User: Travail
 * Date: 29/03/2019
 * Time: 14:12
 */

namespace App\Security\Voter;


use App\Entity\User;
use App\Security\AppAccess;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class GameVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, [AppAccess::GAME_EDIT, AppAccess::GAME_SHOW]);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if(!$user instanceof User){
            return false;
        }

        if($subject->getUserCharacter()->getUser === $user){
            return true;
        }

        if(in_array('ROLE_ADMIN',$user->getRoles()) === true){
            return true;
        }
        return false;

    }
}