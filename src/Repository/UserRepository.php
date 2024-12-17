<?php

namespace App\Repository;

use App\Entity\Project;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findUsersByProject(Project $project): array
    {

        return $this->createQueryBuilder('u')
            ->select('u')
            ->join('u.userProjects', 'up')
            ->where('up.project = :project')
            ->setParameter('project', $project)
            ->getQuery()
            ->getResult();
    }


}
