<?php

namespace App\Repository;

use App\Entity\AnnonceMoto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AnnonceMoto>
 */
class AnnonceMotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnnonceMoto::class);
    }
    
    public function findLatest(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.dateCreation', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findAllMarques(): array
    {
        $result = $this->createQueryBuilder('a')
            ->select('DISTINCT a.marque')
            ->orderBy('a.marque', 'ASC')
            ->getQuery()
            ->getScalarResult();

        return array_column($result, 'marque');
    }

    public function search(?string $search, ?string $marque, ?int $prixMax, ?string $tri): array
    {
        $qb = $this->createQueryBuilder('a');

        if ($search !== null && $search !== '') {
            $qb->andWhere('a.titre LIKE :search OR a.modele LIKE :search')
            ->setParameter('search', '%' . $search . '%');
        }

        if ($marque !== null && $marque !== '') {
            $qb->andWhere('a.marque = :marque')
            ->setParameter('marque', $marque);
        }

        if ($prixMax !== null) {
            $qb->andWhere('a.prix <= :prixMax')
            ->setParameter('prixMax', $prixMax);
        }

        switch ($tri) {
            case 'prix_asc':
                $qb->orderBy('a.prix', 'ASC');
                break;

            case 'prix_desc':
                $qb->orderBy('a.prix', 'DESC');
                break;

            case 'annee_desc':
                $qb->orderBy('a.annee', 'DESC');
                break;

            default:
                $qb->orderBy('a.dateCreation', 'DESC');
        }

        return $qb->getQuery()->getResult();
    }


//    /**
//     * @return AnnonceMoto[] Returns an array of AnnonceMoto objects
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

//    public function findOneBySomeField($value): ?AnnonceMoto
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
