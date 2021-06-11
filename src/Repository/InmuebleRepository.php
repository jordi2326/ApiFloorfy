<?php

namespace App\Repository;

use App\Entity\Inmueble;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @method Inmueble|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inmueble|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inmueble[]    findAll()
 * @method Inmueble[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InmuebleRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Inmueble::class);
        $this->manager = $manager;
    }

    public function save($var) # Como guardar elementos nuevos a la bd
    {

        $this->manager->persist($var); # Se incorpora en la bd
        $this->manager->flush(); # Se actualiza la bd y ya es visible
    }

    // /**
    //  * @return Inmueble[] Returns an array of Inmueble objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Inmueble
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
