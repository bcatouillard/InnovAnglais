<?php

namespace App\Repository;

use App\Entity\Realiser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Realiser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Realiser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Realiser[]    findAll()
 * @method Realiser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RealiserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Realiser::class);
    }

    // /**
    //  * @return Realiser[] Returns an array of Realiser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Realiser
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
