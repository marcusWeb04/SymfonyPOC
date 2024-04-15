<?php

namespace App\Repository;

use App\Entity\ProjectOwner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProjectOwner>
 *
 * @method ProjectOwner|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectOwner|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectOwner[]    findAll()
 * @method ProjectOwner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectOwnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectOwner::class);
    }

    public function getGenderRepartitionForChartJS(): array
    {
        $results = $this->createQueryBuilder('po')
            ->select('po.gender, COUNT(po.id) as count')
            ->groupBy('po.gender')
            ->getQuery()
            ->execute();

        $labels = [];
        $data = [];
        foreach ($results as $value) {
            $labels[] = $value['gender']->name;
            $data[] = $value['count'];
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Gender repartition',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)'
                    ],
                ]
            ]
        ];
    }

    public function search(array $data): array
    {
        return $this->createQueryBuilder('po')
            ->innerJoin('po.project', 'p')
            ->andWhere('po.firstName = :firstName')
            ->setParameter('firstName', $data['firstName'])
            ->getQuery()
            ->getResult();
    }
}
