<?php declare(strict_types=1);

namespace App\Components\Task;

use App\Componets\Task\Exception\TaskNotFoundException;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;

class DeleteTaskHandler
{
    /** @var TaskRepository */
    private $repository;

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        TaskRepository $repository,
        EntityManagerInterface $entityManager
    )
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    public function handle(int $taskId): void
    {
        /** @var Task $task */
        $task = $this->repository->getTaskById($taskId);
        TaskNotFoundException::throwIf(!$task);

        $task->setIsDeleted(true);
        $this->entityManager->flush();
    }
}