<?php

namespace App\Repository;

use App\Entity\WeaponUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WeaponUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeaponUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeaponUser[]    findAll()
 * @method WeaponUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeaponUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WeaponUser::class);
    }

    // /**
    //  * @return WeaponUser[] Returns an array of WeaponUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WeaponUser
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
