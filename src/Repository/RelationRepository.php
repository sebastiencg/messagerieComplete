<?php

namespace App\Repository;

use App\Entity\Relation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Relation>
 *
 * @method Relation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Relation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Relation[]    findAll()
 * @method Relation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Relation::class);
    }
    public function relationCustom1($value1, $value2): array
    {
        return $this->createQueryBuilder('relation')
            ->andWhere('relation.profile1 = :key1 AND relation.profile2 = :key2  OR relation.profile2 = :key1 AND relation.profile1 = :key2 ')
            ->setParameter('key1', $value1)
            ->setParameter('key2', $value2)
            ->orderBy('relation.id', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function relationCustom2($value1): array
    {
        return $this->createQueryBuilder('relation')
            ->andWhere('relation.profile1 = :key1 OR relation.profile2 = :key1')
            ->setParameter('key1', $value1)
            ->orderBy('relation.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Relation[] Returns an array of Relation objects
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

//    public function findOneBySomeField($value): ?Relation
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
