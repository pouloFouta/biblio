<?php

namespace App\Repository;

use App\Entity\Biblio;
use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Biblio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Biblio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Biblio[]    findAll()
 * @method Biblio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiblioRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Biblio::class);
    }


    public function biblioEtLivres()
    {
        $qb = $this
            ->createQueryBuilder('b')
            ->leftJoin('b.listeslivres','liv')
            ->addSelect('liv')

        ;

        return $qb
            ->getQuery()
            ->getResult();

    }
    // /**
    //  * @return Biblio[] Returns an array of Biblio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Biblio
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
