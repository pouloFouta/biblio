<?php

namespace App\Repository;

use App\Entity\Livre;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
    /**
     * @method getDoctrine()
     */class LivreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function afficheTous()// equivalent de findAll()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('Livre');



        $listLivres = $repository->findAll();

    }

    public function afficheLivresParGenre($genre)
    {

    }
    public function afficheLivresParAuteur($auteur)
    {

    }



        public function afficheLivresParBiblio()
    {
        $qb = $this
            ->createQueryBuilder('l')
            ->innerJoin('biblio', 'bib')
            ->addSelect('bib')
        ;

        return $qb
            ->getQuery()
            ->getResult();

    }

}
