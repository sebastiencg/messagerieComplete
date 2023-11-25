<?php

namespace App\Repository;

use App\Entity\MessageCommunity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MessageCommunity>
 *
 * @method MessageCommunity|null find($id, $lockMode = null, $lockVersion = null)
 * @method MessageCommunity|null findOneBy(array $criteria, array $orderBy = null)
 * @method MessageCommunity[]    findAll()
 * @method MessageCommunity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageCommunityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MessageCommunity::class);
    }

//    /**
//     * @return MessageCommunity[] Returns an array of MessageCommunity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MessageCommunity
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
