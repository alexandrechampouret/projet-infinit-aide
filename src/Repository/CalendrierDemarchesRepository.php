<?php

namespace App\Repository;

use App\Entity\CalendrierDemarches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CalendrierDemarches|null find($id, $lockMode = null, $lockVersion = null)
 * @method CalendrierDemarches|null findOneBy(array $criteria, array $orderBy = null)
 * @method CalendrierDemarches[]    findAll()
 * @method CalendrierDemarches[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendrierDemarchesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CalendrierDemarches::class);
    }

    // /**
    //  * @return CalendrierDemarches[] Returns an array of CalendrierDemarches objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CalendrierDemarches
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
