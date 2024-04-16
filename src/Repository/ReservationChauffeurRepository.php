<?php

namespace App\Repository;

use App\Entity\ReservationChauffeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationChauffeur>
 *
 * @method ReservationChauffeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationChauffeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationChauffeur[]    findAll()
 * @method ReservationChauffeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationChauffeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationChauffeur::class);
    }

    //    /**
    //     * @return ReservationChauffeur[] Returns an array of ReservationChauffeur objects
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

    //    public function findOneBySomeField($value): ?ReservationChauffeur
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
