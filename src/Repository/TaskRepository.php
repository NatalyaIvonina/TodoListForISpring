<?php

namespace App\Repository;

use App\Entity\Task;
use App\Infrastructure\Exception\NotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function getTaskById(int $id): ?Task
    {
        /** @var Task|null $result */
        $result = $this->findOneBy([
            'id' => $id,
            'isDeleted' => false
        ]);

        return $result;
    }

    public function getTaskList(bool $isCompleted, int $limit, int $offset)
    {
        return  $this->createQueryBuilder('t')
            ->where('t.isCompleted = :isCompleted')
            ->andWhere('t.isDeleted = 0')
            ->setParameter('isCompleted', $isCompleted)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}