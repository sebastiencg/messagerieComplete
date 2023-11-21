<?php

namespace App\Repository;

use App\Entity\ResponseMessageGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ResponseMessageGroup>
 *
 * @method ResponseMessageGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResponseMessageGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResponseMessageGroup[]    findAll()
 * @method ResponseMessageGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponseMessageGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponseMessageGroup::class);
    }

//    /**
//     * @return ResponseMessageGroup[] Returns an array of ResponseMessageGroup objects
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

//    public function findOneBySomeField($value): ?ResponseMessageGroup
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
