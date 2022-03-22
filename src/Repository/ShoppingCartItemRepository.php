<?php

namespace App\Repository;

use App\Entity\ShoppingCartItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShoppingCartItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoppingCartItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoppingCartItem[]    findAll()
 * @method ShoppingCartItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoppingCartItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingCartItem::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ShoppingCartItem $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(ShoppingCartItem $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ShoppingCartItem[] Returns an array of ShoppingCartItem objects
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
    public function findOneBySomeField($value): ?ShoppingCartItem
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
