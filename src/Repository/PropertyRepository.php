<?php

namespace App\Repository;

use App\Entity\Picture;
use Doctrine\ORM\Query;
use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Property>
 *
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Property::class);
        $this->paginator = $paginator;
    }

    public function add(Property $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Property $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return SlidingPagination
     */
    public function PaginateAllVisible(PropertySearch $search, int $page) : SlidingPagination
    {
        $query = $this->findVisibleQuery();
        if ($search->getMaxPrice())
        {
            $query = $query
                ->andwhere('p.price <= :maxPrice ')
                ->setParameter('maxPrice', $search->getMaxPrice());
        }

        if ($search->getMinSurface())
        {
            $query = $query
                ->andwhere('p.surface >= :minSurface ')
                ->setParameter('minSurface', $search->getMinSurface());
        }

        if($search->getOptions()->count() > 0)
        {
            $k = 0;
            foreach ($search->getOptions() as $option)
            {
                $k++;
                $query = $query
                    ->andwhere(":option$k MEMBER OF p.options")
                    ->setParameter("option$k", $option)
                    ;
            }
        }

        if($search->getLat() && $search->getLng() && $search->getDistance() > 0)
        {
            $query = $query
                ->select('p')
                ->andWhere('(6371 * 2 * ASIN(SQRT(
                    POWER(SIN((p.lat - abs(:lat)) * pi()/180 / 2),
                    2) + COS(p.lat * pi()/180 ) * COS(abs(:lat) *
                    pi()/180) * POWER(SIN((p.lng - :lng) *
                    pi()/180 / 2), 2) ))) <= :distance')
                ->setParameter('lat', $search->getLat())
                ->setParameter('lng', $search->getLng())
                ->setParameter('distance', $search->getDistance())
                ;
        }

        $properties = $this->paginator->paginate(
            $query->getQuery(),
            $page, /*page number*/
            12 /*limit per page*/
        );

        $this->hydratePicture($properties);

        return $properties;

    }

    /**
     * @return Property[]
     */
    public function findLatest() : array
    {
        $properties =  $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
        $this->hydratePicture($properties);
        return $properties;

    }

    private function findVisibleQuery() : QueryBuilder
    {
        return $this->createQueryBuilder('p')
        ->where('p.sold = false');
    }

    private function hydratePicture($properties)
    {
        if($properties InstanceOf SlidingPagination)
        {
            $properties = $properties->getItems();
        }
        $pictures = $this->getEntityManager()->getRepository(Picture::class)->findForProperties($properties);

        foreach ($properties as $property)
        {
            /**
             * @var Property $property
             */
            if ($pictures->containsKey($property->getId()))
            {
                $property->setPicture($pictures->get($property->getId()));
            }
        }
    }

//    /**
//     * @return Property[] Returns an array of Property objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Property
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}