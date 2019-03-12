<?php

namespace App\Repository;

use App\Entity\ApiEntity;
use App\Entity\Athlete;
use App\Entity\CrossfitClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Athlete|null find($id, $lockMode = null, $lockVersion = null)
 * @method Athlete|null findOneBy(array $criteria, array $orderBy = null)
 * @method Athlete[]    findAll()
 * @method Athlete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AthleteRepository extends ServiceEntityRepository implements IRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Athlete::class);
    }

    public function findByClass(CrossfitClass $class)
    {
        $qb = $this->createQueryBuilder('a');
        $results = $qb->join('a.classes', 'c')
            ->where($qb->expr()->eq('c.id', $class->getId()))
            ->getQuery()
            ->getResult();
        return $results;
    }

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

    // /**
    //  * @return Athlete[] Returns an array of Athlete objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Athlete
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
