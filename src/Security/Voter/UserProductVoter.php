<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 28/03/2019
 * Time: 11:16
 */

namespace App\Security\Voter;


use App\Entity\User;
use App\Entity\UserProduct;
use App\Security\AppAccess;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class UserProductVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [AppAccess::USER_PRODUCT_SHOW, AppAccess::USER_PRODUCT_EDIT])){
            return false;
        }
        if (!$subject instanceof UserProduct) {
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
            case AppAccess::USER_PRODUCT_SHOW:
            case AppAccess::USER_PRODUCT_EDIT:
                return $subject->getUser()->getId() === $user->getId();
                break;
        }
    }

}