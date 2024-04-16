<?php

namespace App\Repository;

use App\Entity\ReservationForfait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationForfait>
 *
 * @method ReservationForfait|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationForfait|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationForfait[]    findAll()
 * @method ReservationForfait[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationForfaitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationForfait::class);
    }

    //    /**
    //     * @return ReservationForfait[] Returns an array of ReservationForfait objects
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

    //    public function findOneBySomeField($value): ?ReservationForfait
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
