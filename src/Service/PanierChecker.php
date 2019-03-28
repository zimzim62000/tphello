<?php
/**
 * Created by PhpStorm.
 * User: giovanniloope
 * Date: 28/03/2019
 * Time: 20:36
 */

namespace App\Service;


use App\Repository\UserProductRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PanierChecker
{
    private $userProductRepo;
    private $token;

    public function __construct(TokenStorageInterface $token, UserProductRepository $userProductRepository)
    {
        $this->token = $token;
        $this->userProductRepo = $userProductRepository;
    }

    public function userHavePanier(){
        $user = $this->token->getToken()->getUser();
        $panier = $this->userProductRepo->findBy(['user' => $user]);

        if($panier){
            return true;
        }
        return false;
    }
}