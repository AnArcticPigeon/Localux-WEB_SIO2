<?php

namespace App\Repository;

use App\Entity\AncienMdp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AncienMdp>
 *
 * @method AncienMdp|null find($id, $lockMode = null, $lockVersion = null)
 * @method AncienMdp|null findOneBy(array $criteria, array $orderBy = null)
 * @method AncienMdp[]    findAll()
 * @method AncienMdp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AncienMdpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AncienMdp::class);
    }

    //    /**
    //     * @return AncienMdp[] Returns an array of AncienMdp objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?AncienMdp
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
