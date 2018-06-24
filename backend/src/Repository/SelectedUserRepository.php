<?php

namespace App\Repository;

use App\Entity\SelectedUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SelectedUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method SelectedUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method SelectedUser[]    findAll()
 * @method SelectedUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SelectedUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SelectedUser::class);
    }

//    /**
//     * @return SelectedUser[] Returns an array of SelectedUser objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SelectedUser
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
