<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Project>
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function findProjectUser(Project $project)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.user = :user')
            ->andWhere('p.project = :project')
            ->setParameter('project', $project)
            ->getQuery()
            ->getResult();
    }

}
