<?php

namespace App\Repository;

use App\Entity\StockInput;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StockInput|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockInput|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockInput[]    findAll()
 * @method StockInput[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockInputRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StockInput::class);
    }

    // /**
    //  * @return StockInput[] Returns an array of StockInput objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StockInput
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
