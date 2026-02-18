<?php

namespace App\Repository;

use App\Entity\Moto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Moto>
 */
class MotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Moto::class);
    }

    public function findAllCategories(): array
    {
        $result = $this->createQueryBuilder('m')
            ->select('DISTINCT m.category')
            ->orderBy('m.category', 'ASC')
            ->getQuery()
            ->getScalarResult();

        return array_column($result, 'category');
    }

    public function searchModels(?string $search, ?string $categorie, ?string $tri): array
    {
        $qb = $this->createQueryBuilder('m');

        if (!empty($search)) {
            $qb->andWhere('m.name LIKE :search OR m.brand LIKE :search')
            ->setParameter('search', '%' . $search . '%');
        }

        if (!empty($categorie)) {
            $qb->andWhere('m.category = :cat')
            ->setParameter('cat', $categorie);
        }

        switch ($tri) {
            case 'name_asc':
                $qb->orderBy('m.name', 'ASC');
                break;

            case 'name_desc':
                $qb->orderBy('m.name', 'DESC');
                break;

            case 'power_desc':
                $qb->orderBy('m.power', 'DESC');
                break;

            case 'year_desc':
                $qb->orderBy('m.year', 'DESC');
                break;

            default:
                $qb->orderBy('m.name', 'ASC');
        }

        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return Moto[] Returns an array of Moto objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Moto
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
