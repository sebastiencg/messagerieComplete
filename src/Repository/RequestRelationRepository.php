<?php

namespace App\Repository;

use App\Entity\RequestRelation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RequestRelation>
 *
 * @method RequestRelation|null find($id, $lockMode = null, $lockVersion = null)
 * @method RequestRelation|null findOneBy(array $criteria, array $orderBy = null)
 * @method RequestRelation[]    findAll()
 * @method RequestRelation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequestRelationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RequestRelation::class);
    }
    public function requestRelationCustom1($value1, $value2): array
    {
        return $this->createQueryBuilder('request_relation')
            ->andWhere('request_relation.host = :key1 AND request_relation.guests = :key2  OR request_relation.guests = :key1 AND request_relation.host = :key2 ')
            ->setParameter('key1', $value1)
            ->setParameter('key2', $value2)
            ->orderBy('request_relation.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
//    /**
//     * @return RequestRelation[] Returns an array of RequestRelation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RequestRelation
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
