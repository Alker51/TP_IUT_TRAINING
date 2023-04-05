<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @extends ServiceEntityRepository<Contact>
 *
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    public function save(Contact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Contact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Contact[] $contacts
     */
    public function search(string $search = ''): array
    {
        $qb = $this->createQueryBuilder('c');

        if (!empty($search)) {
            $qb->where('c.firstname LIKE :search')
                ->orWhere('c.lastname LIKE :search')
                ->orWhere('c.email LIKE :search')
                ->setParameter('search', '%'.$search.'%');
        }

        $query = $qb->getQuery();

        return $query->execute();
    }

    public function findWithCategory(int $id) : ?Contact
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c AS contact')
            ->leftJoin('App:Category', 'cat', Join::WITH, 'c.category = cat.id')
            ->addSelect('cat AS category')
            ->where('c.id LIKE :search')
            ->setParameter('search', $id);

        $query = $qb->getQuery();

        $res = $query->execute();

        return $res[0]['contact'];
    }

//    /**
//     * @return Contact[] Returns an array of Contact objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Contact
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
