<?php

namespace App\Repository;

use App\Entity\ApiEntity;
use App\Entity\Coach;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Coach|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coach|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coach[]    findAll()
 * @method Coach[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoachRepository extends ServiceEntityRepository implements IRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Coach::class);
    }

    // /**
    //  * @return Coach[] Returns an array of Coach objects
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
    public function findOneBySomeField($value): ?Coach
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function create(ApiEntity $entity): ApiEntity
    {
        try {
            $this->getEntityManager()->persist($entity);
            $this->getEntityManager()->flush();

            return $entity;
        } catch (ORMException $e) {
            return null;
        }
    }

    public function update(ApiEntity $entity): ?ApiEntity
    {
        try {
            $entity = $this->getEntityManager()->merge($entity);
            $this->getEntityManager()->flush();

            return $entity;
        } catch (ORMException $e) {
            return null;
        }
    }
}
