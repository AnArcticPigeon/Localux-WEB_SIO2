<?php

namespace App\Repository;

use App\Entity\TypeDegat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeDegat>
 *
 * @method TypeDegat|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeDegat|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeDegat[]    findAll()
 * @method TypeDegat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeDegatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeDegat::class);
    }

    //    /**
    //     * @return TypeDegat[] Returns an array of TypeDegat objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TypeDegat
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
