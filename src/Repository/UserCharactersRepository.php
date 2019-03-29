<?php

namespace App\Repository;

use App\Entity\UserCharacters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCharacters|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCharacters|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCharacters[]    findAll()
 * @method UserCharacters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCharactersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCharacters::class);
    }

    // /**
    //  * @return UserCharacters[] Returns an array of UserCharacters objects
    //  */

    public function findByPlayedByUser($user)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.user = :val')
            ->setParameter('val', $user)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return UserCharacters[] Returns an array of UserCharacters objects
    //  */

    public function findByActive()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.defeult = :val')
            ->setParameter('val', true)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(2)
            ->getQuery()
            ->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?UserCharacters
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
