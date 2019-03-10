<?php

namespace App\Repository;

use App\Entity\ApiEntity;
use App\Entity\ApiToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ApiToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApiToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApiToken[]    findAll()
 * @method ApiToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApiTokenRepository extends ServiceEntityRepository implements IRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ApiToken::class);
    }

    public function create(ApiEntity $entity): ?ApiEntity
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
    //  * @return ApiToken[] Returns an array of ApiToken objects
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
    public function findOneBySomeField($value): ?ApiToken
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
