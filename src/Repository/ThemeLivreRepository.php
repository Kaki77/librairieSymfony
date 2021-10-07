<?php

namespace App\Repository;

use App\Entity\ThemeLivre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ThemeLivre|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThemeLivre|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThemeLivre[]    findAll()
 * @method ThemeLivre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemeLivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThemeLivre::class);
    }

    // /**
    //  * @return ThemeLivre[] Returns an array of ThemeLivre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ThemeLivre
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
