<?php

namespace App\Repository;

use App\Entity\CrossfitClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CrossfitClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrossfitClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrossfitClass[]    findAll()
 * @method CrossfitClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrossfitClassRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CrossfitClass::class);
    }

    // /**
    //  * @return CrossfitClass[] Returns an array of CrossfitClass objects
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
    public function findOneBySomeField($value): ?CrossfitClass
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
