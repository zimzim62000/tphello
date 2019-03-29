<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 29/03/2019
 * Time: 16:06
 */

namespace App\Service;


use App\Entity\UserCharacters;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CheckUserCharacterDefault
{

    private $em;
    private $token;

    public function __construct(EntityManagerInterface $em, TokenStorageInterface $token)
    {
        $this->em = $em;
        $this->token = $token;
    }

    public function defaultCheck(){
        $isDefault = false;
        $user = $this->token->getToken()->getUser();
        $userCharacters = $this->em->getRepository(UserCharacters::class)->findBy(["user" => $user]);

        foreach ($userCharacters as $uC){
            if($uC->getDefaultCharacter() === true){
                $isDefault = true;
            }
        }

        return $isDefault;
    }

    public function removeDefault(){
        $user = $this->token->getToken()->getUser();
        $userCharacters = $this->em->getRepository(UserCharacters::class)->findBy(["user" => $user]);

        foreach ($userCharacters as $uC){
            if($uC->getDefaultCharacter() === true){
                $uC->setDefaultCharacter(false);
                $this->em->persist($uC);
                $this->em->flush();
            }
        }
    }
}