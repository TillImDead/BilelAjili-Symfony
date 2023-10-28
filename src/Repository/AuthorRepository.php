<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 *
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

//    /**
//     * @return Author[] Returns an array of Author objects
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

public function findAllAuthorsOrderedByEmail()
{
    return $this->createQueryBuilder('z')
        ->orderBy('z.email', 'ASC')
        ->getQuery()
        ->getResult();
}



public function findBooksRange($min, $max)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT author
            FROM App\Entity\Author author
        
            where author.nb_books between :min  and :max
            GROUP BY author.nb_books
        ');

$query->setParameter('min', $min);
$query ->setParameter('max', $max);
          return  $query->getResult();
    }
    



    public function DeleteAuthorwithNobooks(){
        $em=$this->getEntityManager();
        return $em
        ->createQuery(
            'DELETE App\Entity\Author a WHERE a.nb_books = 0')
        ->getResult();
    }
}